<?php
// 本类由系统自动生成，仅供测试用途
class RegAction extends UserBaseAction {


    /**
     * 初始化方法
     */
    public function _initialize() {
        parent::_initialize();
    }

    public function index(){

        //
        if($this->ispost()) {
            $data['username'] = $this->_post('username');
            $data['password'] = $this->_post('password');
            D('User')->add($data);
        }


        $data= array(

        );

        $this->assign($data);
        $this->display();

    }
}