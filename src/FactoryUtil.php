<?php

namespace Yeyu\PhpUtil;

use Yeyu\PhpUtil\Redis\RedisUtil;

/**
 * Class FactoryUtil
 * @package Yeyu\PhpUtil
 */
class FactoryUtil
{
    private static $instance;
    protected static $RedisUtil;

    private function __construct($config, $type)
    {
        if (strtolower($type) == 'redis') {
            self::$RedisUtil = RedisUtil::getInstance($config)->getRedis();
        } else {
            exit("未知");
        }

    }

    public static function setOptions($config, $type)
    {
        if (!(self::$instance instanceof self)) {

            self::$instance = new self($config, $type);
        }
        return self::$instance;
    }

    public static function getRedisCli()
    {
        return self::$RedisUtil;
    }
}

