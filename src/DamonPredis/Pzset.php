<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

namespace DamonPredis;

class Pzset extends PredisClient
{

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    //expire($key, 20)

    private function kkey($key)
    {
        return parent::key_zset() . $key;
    }

    private function connect()
    {
        return parent::get_instance();
    }

    /**
     * 设置zset表有效期-zset类型
     *
     * @param string $table
     * @param int    $expire_time
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
     * 元素递增-zset类型
     *
     * @param string $table
     * @param string $member
     * @param int    $step
     * @param null   $db
     *
     * @return string
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function incr($table = '', $member = '', $step = 0, $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $result = $instance->zincrby($table, $step, $member);
        return $result;
    }

    /**
     * 元素递减-zset类型
     *
     * @param string $table
     * @param string $member
     * @param int    $step
     * @param null   $db
     *
     * @return string
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function decr($table = '', $member = '', $step = 0, $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $step   = -$step;
        $result = $instance->zincrby($table, $step, $member);
        return $result;
    }

    /**
     * 正序取出n个元素-zset类型
     *
     * @param string $table
     * @param int    $num
     * @param null   $db
     *
     * @return array
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function take($table = '', $num = 1, $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $table = self::kkey($table);

        $result = $instance->zrange($table, 0, $num - 1);
        return $result;
    }

    /**
     * 倒序取出n个元素-zset类型
     *
     * @param string $table
     * @param int    $num
     * @param null   $db
     *
     * @return array
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function take_desc($table = '', $num = 1, $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        //    $re = $redis->zRevRangeByScore($s_zset, 0, $num,['withscores' =>true, 'limit' => [1, 1]]);
        $table  = self::kkey($table);
        $result = $instance->zRevRange($table, 0, $num, true);
        return $result;
    }

    /**
     * 删除整个zset表-zset类型
     *
     * @param string $table
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function delall($table = '', $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $result = parent::redis_del($table, $db);
        return $result;
    }

    /**
     * 删除指定元素-zset类型
     *
     * @param string $table
     * @param string $member
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function del($table = '', $member = '', $db = null)
    {
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }

        $table  = self::kkey($table);
        $result = $instance->zrem($table, $member);
        return $result;
    }

}