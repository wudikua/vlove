<?php
class AttenAction extends UserLoginAction {


    /**
     * 我的粉丝
     */
    public function fans() {
        $this->display();
    }

    /**
     * 我关注的
     */
    public function atten() {
        $this->display();
    }

    /**
     * 新增关注
     */
    public function add() {
        $uid = $this->_post('touid');
        if(AttenModel::isAtten($this->userId, $uid)) {
            echo 2;exit;
        }

        $userInfo = UserModel::getUserById($uid, ['nickname']);
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
            'username' => $userInfo['nickname'],
            'type'     => 1,
            'create_time' => time(),
        ];
        AttenModel::add($data);
        AttenModel::add($data1);
        echo 1;exit;
    }

}