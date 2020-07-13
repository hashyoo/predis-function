<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

namespace DamonPredis;

class Phash extends PredisClient
{

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    //expire($key, 20)

    private function kkey($key){
        return parent::key_hash().$key;
    }

    private function connect(){
        return parent::get_instance();
    }

    /**
     * 设置hash表有效期-hash类型
     *
     * @param string $table
     * @param int    $expire_time
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function expire($table = '', $expire_time = 0,$db = null){
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $table = self::kkey($table);
        $result = $instance->expire($table, intval($expire_time));
        return $result;
    }

    /**
     * 存储单个元素-hash类型
     *
     * @param string $table
     * @param string $key
     * @param string $value
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function set($table = '',$key = '',$value = '', $db = null)
    {
        $table = self::kkey($table);
//        $value    = json_encode($value);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result = $instance->hset($table,$key,$value);
        return $result;
    }


    /**
     * 获取单个元素-hash类型
     *
     * @param string $table
     * @param string $key
     * @param null   $db
     *
     * @return string
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function get($table = '',$key = '',$db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result   = $instance->hget($table,$key);
        return $result;
    }

    /**
     * 删除单个元素-hash类型
     *
     * @param string $table
     * @param string $key
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function del($table = '', $key = '',$db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result   = $instance->hdel($table,$key); //true or false
        return $result;
    }

    /**
     * 存储多个元素-hash类型
     *
     * @param string $table
     * @param array  $arr_data
     * @param null   $db
     *
     * @return mixed
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function mset($table = '',$arr_data = [],$db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result = $instance->hmset($table,$arr_data)->getPayload();
        return $result;
    }

    /**
     * 获取多个元素-hash类型
     *
     * @param       $table
     * @param array $arr_key
     * @param null  $db
     *
     * @return mixed
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function mget($table,$arr_key = [],$db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result = $instance->hmget($table,$arr_key);
        return $result;
    }

    /**
     * 获取全部元素-hash类型
     *
     * @param      $table
     * @param null $db
     *
     * @return array
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function getall($table,$db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result = $instance->hgetall($table);
        return $result;
    }


    /**
     * 删除整个hash表-hash类型
     *
     * @param string $table
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function delall($table = '',$db = null){
        $table = self::kkey($table);
        $result = parent::redis_del($table,$db);
        return $result;
    }


    /**
     * 元素值递增-hash类型
     *
     * @param string $table
     * @param string $key
     * @param int    $step
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function incr($table = '',$key = '',$step = 1, $db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result   = $instance->hincrby($table,$key,$step);
        return $result;
    }

    /**
     * 元素值递减-hash类型
     *
     * @param string $table
     * @param string $key
     * @param int    $step
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function decr($table = '',$key = '',$step = 1, $db = null)
    {
        $table = self::kkey($table);
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $result   = $instance->hincrby($table,$key,-$step);
        return $result;
    }




}