## 全局公共参数
#### 全局Header参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### 全局Query参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### 全局Body参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### 全局认证方式
```text
noauth
```
#### 全局预执行脚本
```javascript
暂无预执行脚本
```
#### 全局后执行脚本
```javascript
暂无后执行脚本
```
## /系统管理
```text
The Administrator Apis Docments
```
#### Header参数
参数名 | 示例值 | 参数描述x
--- | --- | ---
暂无参数
#### Query参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### Body参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
## /系统管理/选举场次列表
```text
暂无描述
```
#### 接口状态
> 已完成

#### 接口URL
> http://localhost:8080/index.phpadmin/election

#### 请求方式
> GET

#### Content-Type
> none

#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 0,
	"dataset": {
		"1": {
			"id": 1,
			"name": "立法會選舉",
			"status": 1,
			"candidate": [
				{
					"id": 1,
					"election_id": 1,
					"name": "陶先生"
				}
			]
		},
		"2": {
			"id": 2,
			"name": "鄉郊代表選舉",
			"status": 1,
			"candidate": []
		}
	},
	"message": null
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 0 | Integer | 错误代码
dataset | - | Object | 数据返回
dataset.1 | - | Object | 
dataset.1.id | 1 | Integer | 选举场次ID
dataset.1.name | 立法會選舉 | String | 投票项目名称
dataset.1.status | 1 | Integer | 状态：1=投票进行中，0=投票已停止
dataset.1.candidate | - | Array | 候选人列表
dataset.1.candidate.id | 1 | Integer | 候选人ID
dataset.1.candidate.election_id | 1 | Integer | 选举项目id
dataset.1.candidate.name | 陶先生 | String | 候选人姓名
dataset.2 | - | Object | 
dataset.2.id | 2 | Integer | 选举场次ID
dataset.2.name | 鄉郊代表選舉 | String | 投票项目名称
dataset.2.status | 1 | Integer | 状态：1=投票进行中，0=投票已停止
dataset.2.candidate | - | Array | 
message | null | Null | 错误信息
## /系统管理/添加候选人
```text
暂无描述
```
#### 接口状态
> 开发中

#### 接口URL
> http://localhost:8080/index.php/admin/candidate/create

#### 请求方式
> POST

#### Content-Type
> form-data

#### 请求Body参数
参数名 | 示例值 | 参数类型 | 是否必填 | 参数描述
--- | --- | --- | --- | ---
election_id | 1 | String | 是 | 选举项目id
name | 叶先生 | String | 是 | 候选人名称
#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 0,
	"dataset": null,
	"message": "添加候选人成功"
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 0 | Integer | 错误代码
dataset | null | Null | 数据返回
message | 添加候选人成功 | String | 错误信息
## /系统管理/选举场次开关
```text
暂无描述
```
#### 接口状态
> 已完成

#### 接口URL
> http://localhost:8080/index.php/admin/election/switch/1

#### 请求方式
> PATCH

#### Content-Type
> none

#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 403,
	"dataset": null,
	"message": "《立法會選舉》候选人不足, 无法进行投票!"
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 403 | Integer | 错误代码
dataset | null | Null | 数据返回
message | 《立法會選舉》候选人不足, 无法进行投票! | String | 错误信息
## /系统管理/获取候选人详情列表
```text
暂无描述
```
#### 接口状态
> 已完成

#### 接口URL
> http://localhost:8080/index.php/admin/candidate/1

#### 请求方式
> GET

#### Content-Type
> none

#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 0,
	"dataset": [
		{
			"id": 1,
			"election_id": 1,
			"name": "陶先生",
			"votes_count": 1
		},
		{
			"id": 3,
			"election_id": 1,
			"name": "叶先生",
			"votes_count": 0
		}
	],
	"message": null
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 0 | Integer | 错误代码
dataset | - | Array | 数据返回
dataset.id | 1 | Integer | 候选人ID
dataset.election_id | 1 | Integer | 选举项目id
dataset.name | 陶先生 | String | 候选人姓名
dataset.votes_count | 1 | Integer | 获得票数
message | null | Null | 错误信息
## /系统管理/获取候选人选民列表
```text
暂无描述
```
#### 接口状态
> 开发中

#### 接口URL
> http://localhost:8080/index.php/admin/candidate/voters/1?limit=10

#### 请求方式
> GET

#### Content-Type
> none

#### 请求Query参数
参数名 | 示例值 | 参数类型 | 是否必填 | 参数描述
--- | --- | --- | --- | ---
limit | 10 | String | 是 | 每页数量
#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 0,
	"dataset": {
		"current_page": 1,
		"data": [
			{
				"id": 4,
				"user_id": 1,
				"election_id": 1,
				"candidate_id": 1,
				"vote_ip": "127.0.0.1",
				"vote_time": "2022-12-16 15:14:20",
				"user": {
					"id": 1,
					"hkid": "Z780608(7)",
					"email": "test@plvote.com"
				}
			}
		],
		"first_page_url": "http://plvote/index.php/admin/candidate/voters/1?page=1",
		"from": 1,
		"last_page": 1,
		"last_page_url": "http://plvote/index.php/admin/candidate/voters/1?page=1",
		"next_page_url": null,
		"path": "http://plvote/index.php/admin/candidate/voters/1",
		"per_page": "10",
		"prev_page_url": null,
		"to": 1,
		"total": 1
	},
	"message": null
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 0 | Integer | 错误代码
dataset | - | Object | 数据返回
dataset.current_page | 1 | Integer | 当前页
dataset.data | - | Array | 数据列表
dataset.data.id | 4 | Integer | 投票号
dataset.data.user_id | 1 | Integer | 投票者ID
dataset.data.election_id | 1 | Integer | 选举项目id
dataset.data.candidate_id | 1 | Integer | 候选人ID
dataset.data.vote_ip | 127.0.0.1 | String | 投票人IP
dataset.data.vote_time | 2022-12-16 15:14:20 | String | 投票时间
dataset.data.user | - | Object | 投票者信息
dataset.data.user.id | 1 | Integer | 投票者ID
dataset.data.user.hkid | Z780608(7) | String | 香港身份证号
dataset.data.user.email | test@plvote.com | String | 电邮Email
dataset.first_page_url | http://plvote/index.php/admin/candidate/voters/1?page=1 | String | 首页链接
dataset.from | 1 | Integer | 上一页数
dataset.last_page | 1 | Integer | 最后一页
dataset.last_page_url | http://plvote/index.php/admin/candidate/voters/1?page=1 | String | 最后一页链接
dataset.next_page_url | null | Null | 下一页链接
dataset.path | http://plvote/index.php/admin/candidate/voters/1 | String | 链接地址
dataset.per_page | 10 | String | 每页条数
dataset.prev_page_url | null | Null | 上一页链接
dataset.to | 1 | Integer | 当前数量
dataset.total | 1 | Integer | 总数统计
message | null | Null | 错误信息
## /普通用户
```text
The Vote User Apis Docments
```
#### Header参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### Query参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### Body参数
参数名 | 示例值 | 参数描述
--- | --- | ---
暂无参数
#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
## /普通用户/获取选举场次及候选人
```text
暂无描述
```
#### 接口状态
> 开发中

#### 接口URL
> http://localhost:8080/index.php/user/election/1

#### 请求方式
> GET

#### Content-Type
> none

#### 认证方式
```text
bearer
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 0,
	"dataset": {
		"id": 1,
		"name": "立法會選舉",
		"status": 1,
		"candidate": [
			{
				"id": 1,
				"election_id": 1,
				"name": "陶先生"
			},
			{
				"id": 3,
				"election_id": 1,
				"name": "叶先生"
			}
		]
	},
	"message": null
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 0 | Integer | 错误代码
dataset | - | Object | 数据返回
dataset.id | 1 | Integer | 选举场次ID
dataset.name | 立法會選舉 | String | 投票项目名称
dataset.status | 1 | Integer | 状态：1=投票进行中，0=投票已停止
dataset.candidate | - | Array | 候选人列表
dataset.candidate.id | 1 | Integer | 候选人ID
dataset.candidate.election_id | 1 | Integer | 选举项目id
dataset.candidate.name | 陶先生 | String | 候选人名称
message | null | Null | 错误信息
## /普通用户/用户登记
```text
暂无描述
```
#### 接口状态
> 开发中

#### 接口URL
> http://localhost:8080/index.php/signin

#### 请求方式
> POST

#### Content-Type
> form-data

#### 请求Body参数
参数名 | 示例值 | 参数类型 | 是否必填 | 参数描述
--- | --- | --- | --- | ---
hkid | Z780608(7) | String | 是 | 香港身份证号
email | test@plvote.com | String | 是 | 电邮Email
#### 认证方式
```text
noauth
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
## /普通用户/用户投票
```text
暂无描述
```
#### 接口状态
> 开发中

#### 接口URL
> http://localhost:8080/index.php/user/vote

#### 请求方式
> POST

#### Content-Type
> form-data

#### 请求Body参数
参数名 | 示例值 | 参数类型 | 是否必填 | 参数描述
--- | --- | --- | --- | ---
election_id | 1 | String | 是 | 选举投票项目id
candidate_id | 1 | String | 是 | 候选人ID
#### 认证方式
```text
bearer
```
#### 预执行脚本
```javascript
暂无预执行脚本
```
#### 后执行脚本
```javascript
暂无后执行脚本
```
#### 成功响应示例
```javascript
{
	"code": 0,
	"dataset": [
		{
			"id": 1,
			"election_id": 1,
			"name": "陶先生",
			"votes": "3"
		},
		{
			"id": 3,
			"election_id": 1,
			"name": "叶先生",
			"votes": "0"
		}
	],
	"message": "投票成功!"
}
```
参数名 | 示例值 | 参数类型 | 参数描述
--- | --- | --- | ---
code | 0 | Integer | 错误代码
dataset | - | Array | 数据返回
dataset.id | 1 | Integer | 候选人ID
dataset.election_id | 1 | Integer | 选举项目id
dataset.name | 陶先生 | String | 候选人姓名
dataset.votes | 3 | String | 获得票数
message | 投票成功! | String | 响应信息