<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/23
 * Time: 16:34
 */
class AttenModel extends  MongoFactory {


    public static $TABLE = 'attention';

    // type：1.我的关注,2.我的粉丝
    // from uid|name发送者
    public static $FIELD = ['uid', 'userid', 'username', 'type', 'create_time'];

    /**
     * @brief 保存数据
     * @param $data
     * @return array|bool
     */
    public static function add($data) {
        foreach(self::$FIELD as $field) {
            if(!isset($data[$field])) {
                return false;
            } else{
                $new[$field] = $data[$field];
            }
        }
        return self::table(self::$TABLE)->insert($new);
    }

    public static function getById($id) {
        return MongoFactory::table(self::$TABLE)->findOne(['_id' => new MongoId($id)]);
    }


    /**
     * @param $uid 用户id
     * @param $userid 我关注的id
     */
    public static function isAtten($uid, $userid) {
        return MongoFactory::table(self::$TABLE)->findOne(['uid' => $uid, 'userid' => $userid]);
    }

    /**
     * @brief 删除
     * @param $id
     * @return bool
     */
    public static function del($uid, $userid) {
        return self::table(self::$TABLE)->remove(
            ['$or' => [['uid' => $uid, 'userid' => $userid],['uid' => $userid, 'userid' => $uid]]]
        );
    }

    private static function _getList($where, $offset, $limit) {

        $result = MongoFactory::table(self::$TABLE)->find($where)->sort(['create_time' => -1])->skip(intval($offset))->limit(intval($limit));
        return MongoUtil::asList($result);
    }

    /**
     * @brief 我的关注
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getMyAttenByUid($uid, $offset, $limit) {
        return self::_getList(['uid' => $uid, 'type' => 1], $offset, $limit);
    }

    /**
     * @brief 我收到的所有已读信息
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getMyFansByUid($uid, $offset, $limit) {
        return self::_getList(['uid' => $uid, 'type' => 2], $offset, $limit);
    }
}