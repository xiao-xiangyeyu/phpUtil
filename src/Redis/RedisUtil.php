<?php

namespace Yeyu\PhpUtil\Redis;

/**
 * Class RedisUtil
 * @package Yeyu\PhpUtil\Redis
 */
class RedisUtil
{
    private static $instance;

    private $redis;

    private function __construct($conf)
    {
        $db = isset($conf['db']) ? $conf['db'] : 0;
        $this->redis = new \Redis();
        $this->redis->connect($conf['host'], $conf['port']);
        if ($conf['password']) {
            $this->redis->auth($conf['password']);
        }
        $this->redis->setOption(\Redis::OPT_SCAN, \Redis::SCAN_RETRY);
        $this->redis->select($db);
    }

    public static function getInstance($conf)
    {
        try {
            if (!(self::$instance instanceof self)) {
                self::$instance = new self($conf);
            } else {
                if (!self::$instance->getRedis()->ping()) {
                    self::$instance = new self($conf);
                }
            }
        } catch (\exception $e) {
            self::$instance = new self($conf);
        }
        return self::$instance;
    }

    public function getRedis()
    {
        return $this->redis;
    }

    private function __clone()
    {
    }
}