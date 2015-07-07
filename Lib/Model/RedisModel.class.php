<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/3
 * Time: 17:29
 */
class RedisModel {

    private static $_REDIS = null;

    public static $KEY = [
        'notify' => [
            //是否有新消息 USER_NOTIFY:uid:msg:true|false
            'msg'     => ['key' => 'USER_NOTIFY:%s:', 'field' => 'msg'],
            //是否有新的关注 USER_NOTIFY:uid:atten:true|false
            'atten'   => ['key' => 'USER_NOTIFY:%s:', 'field' => 'atten'],
            //是否有新的访客 USER_NOTIFY:uid:visitor:true|false，recent 存储用户最新访客 string json
            'visitor' => ['key' => 'USER_NOTIFY:%s:', 'field' => 'visitor', 'recent' => 'USER_VISITOR:%s'],
        ]
    ];

    public static function init() {
        self::$_REDIS = new Redis();
        self::$_REDIS->connect('localhost');
    }

    public static function hGet($key, $field) {
        return self::$_REDIS->hGet($key, $field);
    }
    public static function hSet($key, $field, $value) {
        return self::$_REDIS->hSet($key, $field, $value);
    }
    public static function set($key, $value) {
        return self::$_REDIS->set($key, $value);
    }
    public static function get($key) {
        return self::$_REDIS->get($key);
    }
}