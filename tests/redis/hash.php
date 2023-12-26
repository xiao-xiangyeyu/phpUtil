<?php

include '../../vendor/autoload.php';

use Yeyu\PhpUtil\FactoryUtil;

$redisConf = [
    'host' => '127.0.0.1',
    'port' => 6379,
    'password' => '',
    'timeout' => 5,
    'prefix' => '',
    'db' => 0
];
FactoryUtil::setOptions($redisConf, 'redis');
$rd = FactoryUtil::getRedisCli();
