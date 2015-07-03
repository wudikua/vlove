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
//		$this->responseText("欢迎关注单身吧，本吧定期组织交友活动，点击".self::$host."开始勾搭心仪的对象，和报名活动");
		$this->responseText("<a href='http://wap.datougou.cn/gate.php'>欢迎关注单身吧，点击此处查看更多信息。本吧定期组织单身交友活动，编辑个人资料，可以搜索别的人，参加活动等</a>");
	}

	/**
	 * 收到文本消息时触发，回复收到的文本消息内容
	 *
	 * @return void
	 */
	protected function onText() {
//		$this->responseText("欢迎关注单身吧，本吧定期组织交友活动，点击".self::$host."开始勾搭心仪的对象，和报名活动");
		$this->responseText("<a href='http://wap.datougou.cn/gate.php'>点击此处，查看更多玩法</a>");
	}
}
