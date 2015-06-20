<?php
class EventBaseAction extends UserLoginAction {
	// 活动正常征集中
	public static $EVENT_STATUS_OPEN = 1;
	// 活动申请满了
	public static $EVENT_STATUS_FULL = 2;
	// 活动已经结束
	public static $EVENT_STATUS_CLOSE = 3;
	// 用户申请活动待审核
	public static $EVENT_APPLY_WAIT = 1;
	// 活动申请审核通过
	public static $EVENT_APPLY_PASS = 2;
	// 活动申请审核拒绝
	public static $EVENT_APPLY_REJECT = 3;
}