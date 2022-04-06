# 安装

Lookstar 是一个通用的 Composer 包，所以不需要对框架单独做修改，只要支持 Composer 就能直接使用。

## 环境要求

- PHP >= 7.4
- <a href='https://www.php.net/manual/en/book.curl.php'>PHP cURL 扩展</a>

## 安装

```sh
composer require bluedot/middle-platform-sdk -vvv
```

# 使用

## 实例化

```php
<?php

use Lookstar\ApiClient;

$clientId = ''; // 第三方用户唯一凭证
$clientSecret = ''; // 第三方用户唯一凭证密钥，即 appsecret
$domain = 'bluedot.lookstar.com.cn'; // 租户域名
$prefix = '/api'; // 生产{api}/测试{api-dev}环境

$apiClient = new ApiClient($clientId, $clientSecret, $domain, $prefix = '/api');
```

## API 调用

```php
<?php

// 调用获取用户信息示例
$result = $apiClient->get('/api/platform/user/row', ['unionid' => 'xxxxxxxxxxxxx']);

```

## 语法说明

```php
$apiClient->{get/post/put}($uri, $data)
```

参数说明：

- <code>$uri</code> 为需要请求的 path
- <code>$data</code> 为请求参数
