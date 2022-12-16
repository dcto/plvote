<?php

namespace App\Model;

/**
 * 用户Model
 */
class User extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * 数据结构
     */
    static public function up()
    {
        \Schema::create(self::table(), function(\Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id')->comment('投票人ID');
            $table->string('hkid', 12)->nullable()->comment('香港身份证ID');
            $table->string('email', 32)->nullable()->comment('Email');
            $table->timestamp('created_at')->useCurrent()->comment('登记时间');
            $table->timestamp('updated_at')->useCurrent()->comment('更新时间');
            $table->engine = 'InnoDB';
        });
    }
}