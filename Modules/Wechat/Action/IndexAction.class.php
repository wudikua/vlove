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
		$this->responseText("欢迎关注单身吧，本吧定期组织单身交友活动。本号汇聚海量单身资源，如果想找男女朋友可以直接回复微信，格式：姓名-性别-年龄-身高-体重-职业-坐标-照片 择偶要求");
	}

	/**
	 * 收到文本消息时触发，回复收到的文本消息内容
	 *
	 * @return void
	 */
	protected function onText() {
//		$this->responseText("欢迎关注单身吧，本吧定期组织交友活动，点击".self::$host."开始勾搭心仪的对象，和报名活动");
//		$this->responseText("您的资料已经收到，请持续关注本微信");
	}
}
