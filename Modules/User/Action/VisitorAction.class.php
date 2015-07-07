<?php
class VisitorAction extends UserLoginAction {

    /**
     * 我的访客
     */
    public function index() {
        // 标记消息通知删除
        UserNotifyModel::delVisitor($this->userId);

        $uids = UserNotifyModel::getVisitor($this->userId);
        $list = UserModel::getUserByIds($uids);
        $data['list'] = $this->getUserInfo($list);
        $this->assign($data);
        $this->display();
    }



}