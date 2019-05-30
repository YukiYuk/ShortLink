<?php

require __DIR__.'/../vendor/autoload.php';

use App\Services\Config;
use Illuminate\Database\Capsule\Manager as CapsuleManager;

define('PUBLIC_PATH', __DIR__);   // 结尾不带斜杠
define('BASE_PATH', dirname(__DIR__));

/* 获取请求者真实IP地址 */
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $real_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $real_ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
} else {
    $real_ip = $_SERVER['REMOTE_ADDR'];
}
define('REAL_IP', $real_ip);

date_default_timezone_set('Asia/Shanghai');

// boot database
$db = new CapsuleManager();
$db->addConnection(Config::getDbInfo());
$db->bootEloquent();

require BASE_PATH.'/config/routes.php';
