<?php

namespace App\Model;

/**
 * 候选人Model
 */
class Candidate extends Model
{
    protected $hidden = ['created_at', 'updated_at'];


    public function votes()
    {
        return $this->hasMany(Ballots::class);
    }

    static public function up()
    {
        \Schema::create(self::table(), function(\Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id')->comment('候选人ID');
            $table->unsignedInteger('election_id')->default(0)->comment('选举场次ID');
            $table->string('name',32)->nullable()->comment('候选人名称');
            $table->timestamp('created_at')->useCurrent()->comment('添加时间');
            $table->timestamp('updated_at')->useCurrent()->comment('更新时间');
            $table->engine = 'InnoDB';

            $table->index('election_id');
        });
    }
}