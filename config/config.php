<?php return [
##########################################
#应用配置
##########################################
'app'=>[
    //APP标识
    'key'=>'plvote',
    //日志等级 (0=关闭, 1=普通日志, 2=数据日志)
    'log' => 1,
    //系统编码
    'charset'  => 'utf-8',
    //默认语言
    'language' => 'zh_HK',
    //系统时区
    'timezone' => 'PRC',
    //版本信息
    'version' => '20221214',
],

##########################################
#目录配置
##########################################
'dir'=>[
    //应用目录
    'app'     => _DIR_,
    //发布目录
    'www'     => _WWW_,

],

'id'=>[
    'key'=>'plvote',
    'len'=>6,
    'bet'=>join('',range(0,9)).join('', range('a', 'z'))
],

##########################################
#数据库连接, default代表默认连接库
##########################################
'database'=>[
    //默认数据库连接
    'default'=>'mysql',
    'timeout'=>200,

    //数据库连接池
    'connections'=>[
        //MYSQL类型
        'mysql'=>[
            #数据库类型( MySQL = mysql | SQL Server = sqlsrv | SQLite = sqlite | pgSql = pgsql)
            'driver'  =>  'mysql',
            #读写分离
            #write.host  =   192.168.1.100
            #read.host[]   =   192.168.1.101
            #read.host[]   =   192.168.1.102
            #连接地址
            'host'      =>   'mysql',
            #连接端口
            'port'      =>   '3306',
            #数据库名称
            'database'  =>   'plvote',
            #连接帐号
            'username'  =>   'root',
            #连接密码
            'password'  =>   'root',
            #所有表前缀
            'prefix'    =>   'pl_',
            #字符集
            'charset'   =>   'utf8mb4',
            #排序规则
            'collation' =>   'utf8mb4_unicode_ci',
        ],

        'sqlite'=>[
            'driver'    => 'sqlite',
            'prefix'    => 'pl_',
            'passowrd'  => '',
            'database'  => runtime('varimax')
        ],

    ]
],




##########################################
#缓存配置
##########################################
'cache'=>[
    //缓存引擎 可选null,apc,files,redis
    'default' => 'redis',

    'driver'=>[
            //APC缓存
            'apc'   =>  [
                'prefix'=>'vm:',
            ],

            //文件缓存
            'files' =>  [
                'dir' => runtime('cache'),
                'prefix'=>'vm_',
                'append'=>'.bin'
            ],

            //Redis缓存
            'redis' =>  [
                'default'   =>  [
                    'host'=> 'redis',
                    'port'=>'6379',
                    'prefix'=>'vm:',
                    'timeout'=>'5',
                    'database'=>'0',
                    'password' => '',
                    'persistent'=>'0',
                    'options'=>[]

                ]
            ],

    ],
],

##########################################
#session设置
##########################################
'session'=>[
    //自动开启true|false
    'start'=>true,
    //存储引擎
    'driver'=>'redis',
    //前缀标识
    'prefix'=>'ADM:',
    //是否加密
    'encrypt'=>false,
    //存储路径
    // 'save_path'=>runtime('session'),
    'save_path'=> 'tcp://127.0.0.1:6379?persistent=5&timeout=5&database=1&auth=14779023',
    //其他配置
    //the options configure @see http://php.net/session.configuration
    'options'=>[
        //SESSION NAME 
        'name'=>'VMID',
        //持续时间秒
        'gc_maxlifetime' => 86400,

        //SESSION作用域
        'cookie_domain' => '',

        'use_cookies' => 0,

        'gc_probability'=>1,

        'gc_divisor'=>1,
    ]
],

##########################################
#Cookie设置
##########################################
'cookie'=>[
    //路径
    'path'=>'/',

    //前缀
    'prefix'=>'',

    //作用域
    'domain'=>'.',

    //过期时间
    'expire'=>86400,

    //SSL协议
    'secure'=>true,

    //cookie编码
    'raw' => false,

    //cookie加密
    'encrypt'=>false,

    //如果 Cookie 具有 HttpOnly 特性且不能通过客户端脚本访问，则为 true；否则为 false。默认值为 false。
    'httpOnly'=>true,

    //站点跨域none|lax|strict 保证secure=true时有效
    'sameSite'=>null,
],

##########################################
#服务提供者
##########################################

'providers' => [
    \Illuminate\Events\EventServiceProvider::class,
    'isbn'=>\App\Provider\IsbnServiceProvider::class
]
];