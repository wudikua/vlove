<?php
// 本类由系统自动生成，仅供测试用途
class NewAction extends BaseAction {

    public function index(){

        // 最新注册的25个用户
        $new = UserModel::getNewUsers(25);
        $this->assign([
            "users"  => $new
        ]);
        $this->display();
    }


}