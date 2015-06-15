<?php
require_once "area.php";

function get_image_name(){
    static $imageCount = 0;
    $imageCount++;
    return time().rand(10000, 999999) . $imageCount;
}

class MongoUtil {

	public static function asList($result) {

	}
}

class MongoFactory {

	private static $db;

	/**
	 * @param $table
	 * @return MongoCollection
	 */
	public static function table($table) {
		if (isset($db[$table])) {
			return self::$db[$table];
		}
		self::$db[$table] = new MongoClient();
		return self::$db[$table]->vlove->$table;
	}
}