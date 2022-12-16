<?php

namespace App\Model;

/**
 * The Common Class App\Model
 * Only Provider Dc.To Test Project
 * 
 * @package App\Model
 *
 */
abstract class Model extends \VM\Model
{
    protected $hidden = ['deleted_at'];
    /**
     * 分页数
     * @var int
     */
    public $perPage = 20;

    /**
     * Automatically maintained
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var bool
     * The Database SoftDelete Attribute
     */
    public $softDelete = true;

    /**
     * common down table
     */
    static public function down()
    {
        if(!getenv('ENV')) return false;

        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        return \Schema::dropIfExists(static::table());
    }
    
}