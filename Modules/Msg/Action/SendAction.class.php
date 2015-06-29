<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/25
 * Time: 23:52
 */
class SendAction extends UserLoginAction {

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $uid = $this->_get('uid');
        $userInfo = UserModel::getUserById($uid,['nickname']);
        $this->assign('user', $userInfo);
        $this->assign('uid', $uid);
        $this->display();
    }

    public function send() {
        $uid = $this->_post('touid');
        $content = $this->_post('content');
        $userInfo = UserModel::getUserById($uid,['nickname' , 'username']);
        $data = [
            'uid'      => $uid,
            'userid'   => $this->userId,
            'username' => $this->nickName,
            'type'     => 2,
            'msg'      => $content,
            'read'     => 0,
            'del'      => 0,
            'create_time' => time(),
        ];
        $data1 = [
            'uid'      => $this->userId,
            'userid'   => $uid,
            'username' => $userInfo['nickname'] ? $userInfo['nickname'] : $userInfo['username'],
            'type'     => 1,
            'msg'      => $content,
            'read'     => 0,
            'del'      => 0,
            'create_time' => time(),
        ];
        MsgModel::add($data);
        MsgModel::add($data1);
        echo 1;exit;
    }
}