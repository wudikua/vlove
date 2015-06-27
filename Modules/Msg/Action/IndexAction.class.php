<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends UserLoginAction {

    private $offset = 0;
    private $limit  = 50;

    public function _initialize() {
        $this->offset = (int)$this->_get('offset');
        $this->limit  = (int)$this->_get('limit') > 0 ? (int)$this->_get('limit') : $this->limit;
        parent::_initialize();
    }

    /**
     * 收件箱
     */
    public function index(){

        // 收件箱
        $data['type'] = in_array((int)$_GET['type'], [0, 1, 2]) ? (int)$_GET['type'] : 0;
        if($data['type'] == 0){
            $data['list'] = MsgModel::getReceiveMsgByUid($this->userId, 0, 50);
        } elseif($data['type'] == 1) {
            $data['list'] = MsgModel::getReceiveReadMsgByUid($this->userId, 0, 50);
        }else{
            $data['list'] = MsgModel::getReceiveUnreadMsgByUid($this->userId, 0, 50);
        }

        $data['list'] = $this->_formatData($data['list']);
        $this->assign($data);
        $this->display();
    }


    /**
     * 发件箱
     */
    public function send() {
        // 发件箱
        $data['list'] = MsgModel::getSendMsgByUid($this->userId, 0, 50);
        $data['list'] = $this->_formatData($data['list']);
        $this->assign($data);
        $this->display();

    }

    public function senddetail() {
        $mid = $this->_get('mid');
        $result = MsgModel::getById($mid);
        MsgModel::read($mid);
        $result = $this->_formatData([$result]);
        $this->assign('nickname',$this->nickName);
        $this->assign('result',$result[0]);
        $this->display();
    }

    private function _formatData($data) {
        $userIds = [];
        foreach($data as $value) {
            array_push($userIds, $value['userid']);
        }
        if($userIds) {
            $usersInfo = UserModel::getUserByIds($userIds, ['username', 'marrystatus' ,
                'birthday' , 'dist1' ,'dist2' ,'dist3', 'avatar', 'gender', 'education']);
            $usersInfo = MongoUtil::asMap($usersInfo, '_id');
            foreach($data as &$msg) {
                $info = $usersInfo[$msg['userid']];
                $msg['fromuser'] = $info;
                $msg['fromuser']['city'] = ProvinceData::$data[$info['dist1']]['city'][$info['dist2']]['city_name'];
                $msg['fromuser']['area'] = ProvinceData::$data[$info['dist1']]['city'][$info['dist2']]['area'][$info['dist3']];
            }
        }
        return $data;
    }
}