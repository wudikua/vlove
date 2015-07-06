<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/3
 * Time: 17:27
 */
class UserNotifyModel extends RedisModel{


    /**
     * @brief 用户收到新的消息
     * @param $uid
     */
    public static function addMsg($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['msg']['key'], $uid);
        $field = self::$KEY['notify']['msg']['field'];
        return self::hSet($key, $field, 1);
    }

    /**
     * @brief 用户是否有新消息
     * @param $uid
     * @return bool
     */
    public static function isNewMsg($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['msg']['key'], $uid);
        $field = self::$KEY['notify']['msg']['field'];
        if(self::hGet($key, $field)) return true;
        return false;
    }

    /**
     * @brief 标记为没有新msg
     * @param $uid
     * @return mixed
     */
    public static function delMsg($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['msg']['key'], $uid);
        $field = self::$KEY['notify']['msg']['field'];
        return self::hSet($key, $field, 0);
    }

    /**
     * @brief 用户收到新的关注
     * @param $uid
     */
    public static function addAtten($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['atten']['key'], $uid);
        $field = self::$KEY['notify']['atten']['field'];
        return self::hSet($key, $field, 1);
    }

    /**
     * @brief 用户是否有新关注
     * @param $uid
     * @return bool
     */
    public static function isNewAtten($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['atten']['key'], $uid);
        $field = self::$KEY['notify']['atten']['field'];
        if(self::hGet($key, $field)) return true;
        return false;
    }

    /**
     * @brief 标记为没有新关注
     * @param $uid
     * @return mixed
     */
    public static function delAtten($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['atten']['key'], $uid);
        $field = self::$KEY['notify']['atten']['field'];
        return self::hSet($key, $field, 0);
    }
}