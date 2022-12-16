<?php

Router::group(['id'=>'common','prefix'=>'/', 'namespace'=>'App\Controller'], function() {
    Router::get('/', function(){echo 'Plvote APIs';});
    //普通用户 登记(邮箱、Hongkong ID)
    Router::post('/signin')->call('User@signin');
});

//系统管理部份APIs
Router::group(['id'=>'admin','prefix'=>'/admin', 'call'=>'App\Controller\User@admin', 'namespace'=>'App\Controller'], function() {

    //投票选举项目列表
    Router::get('/election')->call('Election@index');

    //投票场次开关
    Router::patch('/election/switch/(id:\d+)')->call('Election@switch');

    //添加候选人
    Router::post('/candidate/create')->call('Candidate@create');

    //候选人详情列表
    Router::get('/candidate/(election_id:\d+)')->call('Candidate@index');

    //候选人选票列表
    Router::get('/candidate/voters/(candidate_id:\d+)')->call('Candidate@voters');
});



//普通用户部份APIs
Router::group(['id'=>'users','prefix'=>'/user', 'call'=>'App\Controller\User@auth', 'namespace'=>'App\Controller'], function() {
    //获取选择场次候选人列表
    Router::get('/election/(id:|\d+)')->call('Election@index');
    //投票操作
    Router::post('/vote')->call('User@vote');
});



