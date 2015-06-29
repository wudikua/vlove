<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/23
 * Time: 16:34
 */
class MsgModel extends  MongoFactory {


    public static $TABLE = 'message';

    // type：1.我发送的msg,2.发送给我的msg。、
    // read:0.未读,1.阅读,
    // del 0正常，1删除
    // uid 用户所有msg
    // from uid|name发送者
    public static $FIELD = ['uid', 'userid', 'username', 'type', 'msg', 'read', 'del', 'create_time'];

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
        return MongoFactory::table(self::$TABLE)->findOne(['_id' => new MongoId($id), 'del' => 0]);
    }

    /**
     * @brief 标记为阅读
     * @param $id
     * @return bool
     */
    public static function read($id) {
        return self::table(self::$TABLE)->update(
            ["_id"  => new MongoId($id)],
            ['$set' => ['read' => 1]]
        );
    }

    /**
     * @brief 删除
     * @param $id
     * @return bool
     */
    public static function del($id) {
        return self::table(self::$TABLE)->update(
            ["_id"  => new MongoId($id), "type" => 1],
            ['$set' => ['del' => 1]]
        );
    }

    private static function _getMsg($where, $offset, $limit) {

        $result = MongoFactory::table(self::$TABLE)->find($where)->sort(['create_time' => -1])->skip(intval($offset))->limit(intval($limit));
        return MongoUtil::asList($result);
    }

    /**
     * @brief 所有信息
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getAllMsgByUid($uid, $offset, $limit) {
        return self::_getMsg(['uid' => $uid, 'del' => 0], $offset, $limit);
    }

    /**
     * @brief 我发送的所有信息
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getSendMsgByUid($uid, $offset, $limit) {
        return self::_getMsg(['uid' => $uid, 'type' => 1,'del' => 0], $offset, $limit);
    }

    /**
     * @brief 我收到的所有信息
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getReceiveMsgByUid($uid, $offset, $limit) {
        return self::_getMsg(['uid' => $uid, 'type' => 2,'del' => 0], $offset, $limit);
    }

    /**
     * @brief 我收到的所有未读信息
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getReceiveUnreadMsgByUid($uid, $offset, $limit) {
        return self::_getMsg(['uid' => $uid, 'type' => 2, 'read' => 0, 'del' => 0], $offset, $limit);
    }

    /**
     * @brief 我收到的所有已读信息
     * @param $uid
     * @param $offset
     * @param $limit
     * @return MongoCursor
     */
    public static function getReceiveReadMsgByUid($uid, $offset, $limit) {
        return self::_getMsg(['uid' => $uid, 'type' => 2, 'read' => 1,'del' => 0], $offset, $limit);
    }
}