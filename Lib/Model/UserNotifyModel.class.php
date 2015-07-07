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

    /**
     * @brief 添加访客标记为true
     * @param $uid
     * @param $fromUid
     * @return bool
     */
    public static function addVisitor($uid, $fromUid) {
        self::init();
        // 标记为true
        self::init();
        $key   = sprintf(self::$KEY['notify']['visitor']['key'], $uid);
        $field = self::$KEY['notify']['visitor']['field'];

        // 增加新访客 前10位访客
        $visitorKey = sprintf(self::$KEY['notify']['visitor']['recent'], $uid);
        $visitor    = (array)json_decode(self::get($visitorKey));
        if(!in_array($fromUid, $visitor)) {
            self::hSet($key, $field, 1);
        }
        array_unshift($visitor, $fromUid);
        $visitor = array_unique($visitor);
        $visitor = json_encode(array_slice($visitor, 0, 10));
        return self::set($visitorKey, $visitor);
    }
    /**
     * @brief 用户是否有新关注
     * @param $uid
     * @return bool
     */
    public static function isNewVisitor($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['visitor']['key'], $uid);
        $field = self::$KEY['notify']['visitor']['field'];
        if(self::hGet($key, $field)) return true;
        return false;
    }
    /**
     * @brief 新访客
     * @param $uid
     * @return bool
     */
    public static function getVisitor($uid) {
        self::init();
        $key = sprintf(self::$KEY['notify']['visitor']['recent'], $uid);
        return json_decode(self::get($key), true);
    }
    /**
     * @brief 标记为没有新关注
     * @param $uid
     * @return mixed
     */
    public static function delVisitor($uid) {
        self::init();
        $key   = sprintf(self::$KEY['notify']['visitor']['key'], $uid);
        $field = self::$KEY['notify']['visitor']['field'];
        return self::hSet($key, $field, 0);
    }
}