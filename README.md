# Plvote

The PL Vote  Test Project

<img src="https://img.shields.io/badge/License-MIT-brightgreen" /> <img src="https://img.shields.io/badge/php-%5E7.4-brightgreen" alt="PHP version" />  <img src="https://img.shields.io/badge/MYSQL-^5.7-brightgreen" /> <img src="https://img.shields.io/badge/Redis-^6.0-brightgreen" /> <img src="https://img.shields.io/badge/Restful-Yes-brightgreen" />

### The APIs Document Link 
[在线接口文档](https://console-docs.apipost.cn/preview/de992656cfc14ec1/d079d168502f68f4?target_id=27b7269c-8ac9-4bc0-8e9f-549d7e31d677)

### The APIs Markdown Document


[接口文档 APIs Document.md](https://github.com/dcto/plvote/blob/main/APIs%20Documents.md)


### Directory Preview

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
├── tests       //Unit Tests        
└── www        //入口目录
    └── index.php
```

### Docker 部署

Step 1. 

```
docker-compose up -d
```

Step 2. 

http://localhost:8080/index.php

### Linux 部署

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

Step 6.

```
设定nginx index = www/index.php
```

### About Hongkong ID ISBN-10 Valid Verify Service

in the provider/IsbnServiceProvier.php

```
    private function validHongkongId($id)
    {
        $id = preg_replace(['/[-\/\s]/', '/[\(\)]/'],'', strtoupper($id)); //ID正则替换
        if(!preg_match('/^[A-NP-Z]{1,2}[0-9]{6}[0-9A]$/', $id)) return false; //ID正则校对
		$weight = strlen($id);//HKID长度
		$weightedSum = $weight == 8 ? 324 : 0; //HKID权重
		$identifier = substr($id, 0, -1);
		$checkDigit = substr($id, -1) == 'A' ? 10 : substr($id, -1);

		foreach (str_split($identifier) as $char){
            $charValue = ctype_alpha($char) ? $this->charCodeAt($char, 0) - 55 : +$char; //HKID = { A: 10, B: 11... Z: 35 } so charcode - 55
            $weightedSum += $charValue * $weight;
            $weight--;
        }
        return ($weightedSum + $checkDigit) % 11 == 0;//判断algorithm算法布尔值
    }
```
此算法使用了国际ISBN-10算法
请在调用/signin用户登记接口时，请填写真实的ID否则无法通过验证


### 普通用户流程
```
登记(/signin)->获取选举场次(/election/:id)->选择候选人->点击投票(调用投票vote api)
```

### 系统管理流程

```
新建选举场次->添加候选人(/candidate/create)->选举开始(/election/switch/:id)->查看投票情况(/candidate/:election_id)
```