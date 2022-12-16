<?php

namespace App\Controller;

use App\Model\Ballots;
use App\Model\Candidate as ModelCandidate;
use App\Model\Election;

/**
 * 候选人
 */
class Candidate extends Controller {


    /**
     * 获取候选人列表
     * @return \Response
     */
    public function index($election_id)
    {
       $candidates = ModelCandidate::where('election_id', $election_id)->withCount('votes')->get();

       return respond($candidates);
    }

    /**
     * 添加候选人
     * @param \Request $election_id 投票项目ID
     * @param \Request $name 候选人姓名
     */
    public function create()
    {
        try{
            $election = Election::find(input('election_id'));
            if($election->status) return respond('添加候选人失败, 此选举投票已开始！', 403);

            ModelCandidate::create(['election_id'=>input('election_id'), 'name'=>input('name')]);
            return respond('添加候选人成功');

        }catch(\Exception $e){
            //错误日志记录
            \Log::dir('candidate')->error($e);
            return respond('添加候选人失败:'.$e->getMessage(), $e->getCode());
        }
    }


    /**
     * 获取选民列表
     * @param int $candidate_id 候选人ID
     * @return \Response
     */
    public function voters($candidate_id)
    {
        $voters = Ballots::where('candidate_id', $candidate_id)->with('user')->paginate(input('limit', 10));

        return respond($voters);
    }
}
