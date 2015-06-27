<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/25
 * Time: 13:33
 */
class ArrayMap {
    /**
     * @desc 将子数组中的一个key 作为真个数组的key
     * @param $array     array
     * @param $indexKey  string
     * @demo
     *
     *      转换前:
     *       $data = array(
     *              array("id" => 1, "name" => "A"),
     *              array("id" => 2, "name" => "B" ),
     *          )
     *      执行 Cm_Array::index($data, 'id');
     *      转换后：
     *          array(
     *              "1"  => array("id" => 1, "name" => "A"),
     *              "2"  => array("id" => 2, "name" => "B"),
     *          )
     * @return array
     *
     */
    public static function index($array, $indexKey) {
        if (!is_array(reset($array))) {
            return $array;
        }
        if (empty($indexKey)) {
            return $array;
        }

        $dest = array();
        foreach ($array as $item) {
            if (array_key_exists($indexKey, $item)) {
                $dest[$item[$indexKey]] = $item;
            }
        }
        return $dest;
    }

    /**
     * @desc 提取数组中的列
     * @param $array     array
     * @param $columnKey string 需要提取出的列
     * @param $indexKey  string 索引key 此项可选
     * @return array
     * @demo
     *
     *      转换前:
     *       $data = array(
     *              array("id" => 1, "name" => "A"),
     *              array("id" => 2, "name" => "B" ),
     *          )
     *      执行 Cm_Array::column($data, "name") 后：
     *       array(
     *              "A",
     *              "B",
     *          )
     *      执行 Cm_Array::column($data, "name","id") 后：
     *          array(
     *              "1"  => "A",
     *              "2"  => "B",
     *          )
     *
     */
    public static function column($array, $columnKey, $indexKey = null) {
        $dest = array();

        if (!is_array(reset($array))) {
            return $dest;
        }

        foreach ($array as $item) {
            if ($indexKey && $item[$indexKey]) {
                $dest[$item[$indexKey]] = $item[$columnKey];
            } else {
                $dest[] = $item[$columnKey];
            }
        }

        return $dest;
    }

    public static function sort($array, $arrKey = array()) {
        $dest = array();
        if (!is_array(reset($array))) {
            return $dest;
        }
        if(empty($arrKey)) {
            return $array;
        }
        foreach($arrKey as $key) {
            if(!isset($array[0][$key])) {
                return $array;
            }
        }
        $sortArray = function ($a, $b) use ($arrKey) {
            foreach($arrKey as $key) {
                if($a[$key] != $b[$key]) {
                    return (intval($a[$key]) - intval($b[$key]));
                    break;
                }
            }
            return 0;
        };
        usort($array, $sortArray);
        return $array;
    }

    /**
     * @desc 将数组中的某个值删除
     * @param $array array
     * @param $value string
     * @return array
     * @demo
     *      $data = array('1' => 'A', '2' => 'B', '3' => 'B')
     *      执行 Cm_Array::delete($data, 'B') 后:
     *      array('1' => 'A')
     *
     */
    public static function delete($array, $value) {
        if (empty($array) || !is_array($array)) {
            return $array;
        }

        foreach ($array as $k => $v) {
            if ($v == $value) {
                unset($array[$k]);
            }
        }

        return $array;

    }
}