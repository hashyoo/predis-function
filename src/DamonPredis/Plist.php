<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

namespace DamonPredis;

class Plist extends PredisClient
{

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    //expire($key, 20)

    private function kkey($key)
    {
        return parent::key_list() . $key;
    }

    private function connect()
    {
        return parent::get_instance();
    }


    /**
     * 设置list表有效期-list类型
     *
     * @param string $table
     * @param        $expire_time
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function expire($table = '', $expire_time = 0, $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $table  = self::kkey($table);
        $result = $instance->expire($table, intval($expire_time));
        return $result;
    }


    /**
     * 左侧插入一条数据-list类型
     *
     * @param string $table
     * @param string $value
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function lpush($table = '', $value = '', $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $value  = json_encode($value);
        $result = $instance->lpush($table, $value);
        return $result;
    }

    /**
     * 左侧取出一条数据并删除-list类型
     *
     * @param string $table
     * @param null   $db
     *
     * @return mixed|string
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function lpop($table = '', $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $result = $instance->lpop($table);
        $result = json_decode($result, true);
        return $result;
    }


    /**
     * 右侧插入一条数据-list类型
     *
     * @param string $table
     * @param string $value
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function rpush($table = '', $value = '', $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $value  = json_encode($value);
        $result = $instance->rpush($table, $value);
        return $result;
    }

    /**
     * 右侧取出一条数据并删除-list类型
     *
     * @param string $table
     * @param null   $db
     *
     * @return mixed|string
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function rpop($table = '', $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $result = $instance->rpop($table);
        $result = json_decode($result, true);
        return $result;
    }

    /**
     * 队列插入一条数据[默认右进左出]-list类型
     *
     * @param string $table
     * @param string $value
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function queue_in($table = '', $value = '', $db = null)
    {
        $result = self::rpush($table, $value, $db);
        return $result;
    }

    /**
     * 队列取出多条数据[默认右进左出]-list类型
     *
     * @param string $table
     * @param int    $num
     * @param null   $db
     *
     * @return array
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function queue_mout($table = '', $num = 10, $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table    = self::kkey($table);
        $num      = $num - 1;
        $result   = $instance->lrange($table, 0, $num);
        $arr_data = [];
        foreach ($result as $value) {
            $arr_data[] = json_decode($value, true);
        }
        //        $arr_data = [];
        //        for ($i = 0;$i < $num;$i++){
        //            $result = self::lpop($table);
        //            if(!is_null($result)){
        //                $arr_data[] = json_decode($result,true);
        //            }
        //        }
        return $arr_data;
    }


}