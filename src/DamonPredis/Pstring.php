<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

namespace DamonPredis;

class Pstring extends PredisClient
{

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    //expire($key, 20)

    private function kkey($key)
    {
        return parent::key_str() . $key;
    }

    private function connect()
    {
        return parent::get_instance();
    }

    /**
     * 存储数据-string类型
     *
     * @param string $key
     * @param string $value
     * @param null   $expire_time
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function set($key = '', $value = '', $expire_time = null, $db = null)
    {
        $key      = self::kkey($key);
        $value    = json_encode($value);
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $result = $instance->set($key, $value)
                           ->getPayload();
        if ($expire_time !== null) {
            $result = $instance->expire($key, intval($expire_time));
        }

        return $result;
    }

    /**
     * 获取数据-string类型
     *
     * @param string $key
     * @param null   $db
     *
     * @return mixed
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function get($key = '', $db = null)
    {
        $key      = self::kkey($key);
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $result = json_decode($instance->get($key), true);
        return $result;
    }

    /**
     * 元素递增-string类型
     *
     * @param string $key
     * @param int    $step
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function incr($key = '', $step = 1, $db = null)
    {
        $key      = self::kkey($key);
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $result = $instance->incrby($key, $step);
        return $result;
    }

    /**
     * 元素递减-string类型
     *
     * @param string $key
     * @param int    $step
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function decr($key = '', $step = 1, $db = null)
    {
        $key      = self::kkey($key);
        $instance = self::connect();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $result = $instance->decrby($key, $step);
        return $result;
    }

    /**
     * 删除元素-string类型
     *
     * @param string $key
     * @param null   $db
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function del($key = '', $db = null)
    {
        $key    = self::kkey($key);
        $result = parent::redis_del($key, $db);
        return $result;
    }


}