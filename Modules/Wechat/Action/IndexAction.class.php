<?php
class IndexAction extends WechatAction {

	/**
	 * @var Wechat
	 */
	public $wechat;

	public static $host = "http://wap.datougou.cn";

	public function _initialize() {
		parent::_initialize("vlove");
	}

	public function index() {
		$this->run();
	}

	/**
	 * 用户关注时触发，回复「欢迎关注」
	 *
	 * @return void
	 */
	protected function onSubscribe() {
		$this->responseText("欢迎关注单身吧，本吧定期组织交友活动，点击".self::$host."开始勾搭心仪的对象，和报名活动");
	}

	/**
	 * 收到文本消息时触发，回复收到的文本消息内容
	 *
	 * @return void
	 */
	protected function onText() {
		$this->responseText("欢迎关注单身吧，本吧定期组织交友活动，点击".self::$host."开始勾搭心仪的对象，和报名活动");
	}
}
