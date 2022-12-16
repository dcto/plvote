<?php

namespace App\Model;

/**
 * 用户Model
 */
class Election extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function candidate()
    {
        return $this->hasMany(Candidate::class);
    }


    /**
     * 数据结构
     */
    static public function up()
    {
        \Schema::create(self::table(), function(\Illuminate\Database\Schema\Blueprint $table){
            $table->unsignedInteger('id')->primary()->comment('选举场次ID');
            $table->string('name', 32)->nullable()->comment('投票选举名称');
            $table->boolean('status')->default(1)->comment('状态: 1=投票开始; 0=投票停止');
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->index('status');
        });
    }
}