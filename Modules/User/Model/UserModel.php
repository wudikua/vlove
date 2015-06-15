<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/15
 * Time: 12:59
 */
class UserModel extends MongoModel {

    protected $pk = '_id';


    public function addUser($data) {

        $this->add($data);
    }
}