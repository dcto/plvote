<?php

namespace App\Model;

/**
 * 投票箱Model
 */
class Ballots extends Model
{
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 数据结构
     */
    static public function up()
    {
        \Schema::create(self::table(), function(\Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('投票人ID');
            $table->unsignedInteger('election_id')->comment('选举场ID');
            $table->unsignedInteger('candidate_id')->nullable()->comment('候选人ID');
            $table->string('vote_ip',15)->comment('投票IP');
            $table->timestamp('vote_time')->useCurrent()->comment('投票时间');
            $table->engine = 'InnoDB';

            $table->unique(['election_id', 'user_id']);
            $table->index('user_id');
            $table->index('candidate_id');
        });
    }
}