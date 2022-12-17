# Plvote

The PL Vote  Test Project

The Environment  Require PHP7.4、Mysql5.7+, Redis6+

The Documents Of APIs Link https://console-docs.apipost.cn/preview/de992656cfc14ec1/d079d168502f68f4?target_id=27b7269c-8ac9-4bc0-8e9f-549d7e31d677

 <a href="https://packagist.org/packages/varimax/varimax"><img src="https://img.shields.io/packagist/l/varimax/varimax" alt="License"></a> <img src="https://img.shields.io/packagist/php-v/varimax/varimax" alt="PHP version"> <a href="https://packagist.org/packages/varimax/varimax"><img src="https://img.shields.io/github/v/release/dcto/varimax" alt="Latest Stable Version"></a>  <a href="https://packagist.org/packages/varimax/varimax"><img src="https://img.shields.io/packagist/dt/varimax/varimax" alt="Total Downloads"></a>

### Directory Structure

```
├── Dockerfile  //docker php脚本
├── LICENSE
├── README.md
├── app
│   ├── Controller   //逻辑控制器
│   ├── helper.php    //全局调用function
│   └── routes.php    //路由器
├── composer.json
├── composer.lock
├── config            //配置文件
│   └── config.php    //docker部署脚本
├── docker-compose.yml
├── model            //数据库model
│   ├── Ballots.php    
│   ├── Candidate.php
│   ├── Election.php
│   ├── Model.php
│   └── User.php
├── plvote.sql    //数据库结构
├── runtime       //运行日志缓存cache
│   └── logs
├── test        
└── www        //入口目录
    └── index.php
```

### Docker Deployment

Step 1. 

```
docker-compose up -d
```

Step 2. 

http://localhost:8080

### PHP Deployment

Step 1.

```
git clone https://github.com/dcto/plvote.git
```

Step 2.

```
composer install
```

Step 3.

```
修改config/config.php配置文件中，database地址、数据库名称、 resdis服务器地址
```

Step 4.

```
导入plvote.sql数据库文件
```

Step 5.

```
chmod 777 -R ./runtime  目录权限
```
