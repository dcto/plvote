<?php

namespace App\Controller;

use App\Model\Candidate;
use App\Model\Election as ModelElection;
use ErrorException;

/**
 * 投票场次管理
 */
class Election extends Controller {
    /**
     * 获取选举场次列表
     * @param int $id 当id = 0时列出所有场次
     * @return \Response::json
     */
    public function index($id = 0)
    {
        $election = ModelElection::where('status', 1)->with('candidate')->get()->keyBy('id');

        if($id){
            if (!$election = $election->get($id)){
                return respond('对不起！该场次暂未开始投票');
            }
        }

        return respond($election);
    }

    /**
     * 选举场次投票开关
     * 当前为开始状态则为停止
     * 当前为关闭状态则为开始
     * @param int $id 场次ID
     */
    public function switch($id)
    {
        try{
            //开始事务开始
            \DB::beginTransaction();

            $election = ModelElection::findOrFail($id);
            
            //状态取反
            $election->status = !$election->status;

            //当开始投票、判断候选人数是否满足要求
            if($election->status == 1){
                if (Candidate::where('election_id', $election->id)->count() < 2) {
                    throw new ErrorException(sprintf('《%s》候选人不足, 无法进行投票!', $election->name), 403);
                }
                
                //投票开始 候选人Cache到redis方便统计
                Candidate::where('election_id', $election->id)->get()->each(function($item) use($election){
                    redis()->hset($election->id, $item->id, 0);
                });
                
            }

            //满足条件，投票开关
            $election->save();
            $action = $election->status ? '开始' :'停止';
            $message = sprintf('《%s》投票已%s!', $election->name, $action);

            //提交事务
            \DB::commit();
            //响应结果
            return respond($message);

        }catch(\Exception $e){

            //事务回滚
            \DB::rollBack();

            //记录错误日志
            \Log::dir('election')->error($e);

            //返回错误信息
            return respond($e->getMessage(), $e->getCode());
        }
    }

}