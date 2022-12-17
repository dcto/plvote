<?php

namespace App\Controller;

use App\Model\Ballots;
use App\Model\Candidate;
use App\Model\Election;
use App\Model\User as ModelUser;
use ErrorException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use VM\Exception\NotFoundException;

class User extends Controller {


    /**
     * @var int $uid 鉴权后获得用户ID
     */
    private $uid = 0;
    
    /**
     * 管理员鉴权
     */
    public function admin()
    {
        //.......
    }
    
    /**
     * 用户鉴权
     */
    public function auth()
    {
        try {
            $jwt = JWT::decode(\Request::bearer(), new Key(config('app.key'), 'HS256'));
            $this->uid = $jwt->uid;
        } catch (\UnexpectedValueException $e) {
            return respond('你未登记，登记后获得授权后操作！');
        }
    }

    /**
     * 用户登记
     */
    public function signin()
    {
        $hkid = trim(input('hkid'));
        $email = trim(input('email'));
        if(!make('isbn')->validHongkongId($hkid)) return respond('非法身份证', 403);
        if(!is_email($email)) return respond('电子邮件错误', 403);

        try{

            $user = ModelUser::firstOrCreate(['hkid'=>$hkid, 'email'=>$email]);
            $payload = [
                'uid' => $user->id,
                'iat' => time(),
                'exp' => time() + 3600
            ];
            
            //生成用户token
            $jwt = JWT::encode($payload, config('app.key'), 'HS256');

            return \Response::json(['code'=>0, 'dataset'=>['token'=>$jwt], 'message'=>'登记成功']);
        }catch(\Exception $e){

            //记录错误日志
            \Log::dir('signin')->error($e);
            return respond('登记错误，请稍后再次尝试', 503);
        }
    }

    /**
     * 用户投票
     * @param int $cadidate_id 候选人ID
     */
    public function vote()
    {
        $election_id = intval(input('election_id'));
        $candidate_id = intval(input('candidate_id'));
        try{
            //投票逻辑事务开始
            \DB::beginTransaction();

            if(!$election_id || !$candidate_id) throw new \InvalidArgumentException("Invalid Vote Argument");
            
            if(!$election = Election::find($election_id)) throw new NotFoundException('此选举场次不存在');

            if(!$election->status) throw new ErrorException('此选举场次投票暂未开始！');

            //每個合法⽤⼾在每次選舉限投票⼀次
            if (Ballots::where('user_id', $this->uid)->where('election_id', $election_id)->exists())  throw new ErrorException("对不起！ 你已经投过票了。");
            
            //记录票数
            Ballots::create(['user_id'=>$this->uid, 'election_id'=>$election_id, 'candidate_id'=>$candidate_id, 'vote_ip'=>\Request::ip()]);

            //更新候选人票数Cache统计+1
            redis()->HINCRBY($election->id, $candidate_id, 1);

            //⽤⼾在投票之後可以⼀次性⾒到當時的選舉實時狀態
            $candidates = Candidate::where('election_id', $election_id)->get()->transform(function($item) use($election_id){
                $item->votes = redis()->hget($election_id, $item->id);
                return $item;
            })->toArray();

            //投票成功、事务提交
            \DB::commit();

            //返回成功结果，dataset展示⽤⼾在投票之後可以⼀次性⾒到當時的選舉實時狀態
            return \Response::json(['code'=>0, 'dataset'=>$candidates, 'message'=>'投票成功!']);

        }catch(\Exception $e){

            //投票失败、事务回滚
            \DB::rollBack();
            
            //记录异常handle日志
            \Log::file('vote')->error($e);

            //响应失败信息
            return respond('投票失败:'.$e->getMessage(), 504);
        }
    }
}