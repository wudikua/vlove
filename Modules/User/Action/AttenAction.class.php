<?php
class AttenAction extends UserLoginAction {



    /**
     * 我关注的
     */
    public function index() {
        $list = AttenModel::getMyAttenByUid($this->userId, 0 , 50);
        $data['list'] = $this->getUserInfo($list);
        $data['type'] = 1;
        $this->assign($data);
        $this->display();
    }

    /**
     * 我的粉丝
     */
    public function fans() {
        $list = AttenModel::getMyFansByUid($this->userId, 0 , 50);
        $data['list'] = $this->getUserInfo($list);
        $data['type'] = 2;
        $this->assign($data);
        $this->display('index');
    }


    /**
     * 新增关注
     */
    public function add() {
        $uid = $this->_post('touid');
        if(AttenModel::isAtten($this->userId, $uid)) {
            echo 2;exit;
        }

        $userInfo = UserModel::getUserById($uid, ['nickname', 'username']);
        $data = [
            'uid'      => $uid,
            'userid'   => $this->userId,
            'username' => $this->nickName,
            'type'     => 2,
            'create_time' => time(),
        ];
        $data1 = [
            'uid'      => $this->userId,
            'userid'   => $uid,
            'username' => $userInfo['nickname'] ? $userInfo['nickname'] : $userInfo['username'],
            'type'     => 1,
            'create_time' => time(),
        ];
        AttenModel::add($data);
        AttenModel::add($data1);
        // 消息通知
        UserNotifyModel::addAtten($uid);
        echo 1;exit;
    }

}