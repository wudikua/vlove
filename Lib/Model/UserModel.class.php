<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/23
 * Time: 22:10
 */
class UserModel extends MongoFactory{

    public static $TABLE = 'user';

    // type：1.我发送的msg,2.发送给我的msg。、
    // read:0.未读,1.阅读,
    // del 0正常，1删除
    // uid
    // from uid|name发送者
    public static $FIELD =  [
        'email', 'username', 'password', //登录信息
        'dist1', 'dist2', 'dist3',       //区域信息
        'gender', 'birthday','avatar',
        'marrystatus', 'education', 'height', 'weight',
        'lovesort', 'salary', 'mobile', 'qq', 'idnumber',
		'wgateid', 'wg_openid', 'wg_city', 'wg_province', 'wg_country',
		'create_time', 'login_time',
		'sid' //登录态
    ];

    /**
     * @brief 保存数据
     * @param $data
     * @return array|bool
     */
    public static function add($data) {
        foreach(self::$FIELD as $field) {
            if(isset($data[$field])) {
                $new[$field] = $data[$field];
            }
        }
        return self::table(self::$TABLE)->insert($new);
    }

    /**
     * @brief 查询多个用户
     * @param $ids
     * @param $fields
     * @return array
     */
    public static function getUserByIds($ids, $fields = []) {
        // 采用$in的方式
        $ids = array_unique($ids);
        $mongoIds = [];
        foreach($ids as $id) {
            $mongoIds[] = new MongoId($id);
        }
        if($fields) {
            foreach($fields as $field) {
                $f[$field] = true;
            }
            $result = self::table(self::$TABLE)->find(["_id" => ['$in' => $mongoIds]], $f);
        } else{
            $result = self::table(self::$TABLE)->find(["_id" => ['$in' => $mongoIds]]);
        }
        $result = MongoUtil::asList($result);

        return $result;
    }

    /**
     * @brief 查询用户
     * @param $ids
     * @param $fields
     * @return array
     */
    public static function getUserById($id, $fields = []) {
        if($fields) {
            $result = self::table(self::$TABLE)->findOne(["_id"=>new MongoId($id)], $fields);
        } else{
            $result = self::table(self::$TABLE)->findOne(["_id"=>new MongoId($id)]);
        }
        return $result;
    }


    /**
     * @brief 获取最新注册的用户
     */
    public static function getNewUsers($limit = 10) {
        $result = MongoFactory::table(self::$TABLE)->find()->sort(['create_time' => -1])->limit(intval($limit));
        return MongoUtil::asList($result);
    }

	/**
	 * 通过微信之门获取用户的OAuth信息 http://www.weixingate.com/index.php
	 */
	public static function getWeChatGateOAuthInfo() {
		$ret = json_decode(file_get_contents("http://www.weixingate.com/wgate_user.php?wgateid={$_REQUEST['wgateid']}"), true);
		return $ret;
	}
}