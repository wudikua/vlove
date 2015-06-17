<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/15
 * Time: 12:59
 */
class UserModel extends MongoModel {

	/**
	 * @var string 用户名
	 */
	public $username;

	/**
	 * @var string 邮箱
	 */
	public $email;

	/**
	 * @var string 密码
	 */
	public $password;

}