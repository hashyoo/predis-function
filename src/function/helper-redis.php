<?php
/**
 * Created  by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

use \DamonPredis\Pstring;
use \DamonPredis\Phash;
use \DamonPredis\Plist;
use \DamonPredis\Pzset;

/**
 * 存储数据-string类型
 *
 * @param string $key
 * @param string $value
 * @param null   $time
 * @param null   $db
 *
 * @return int
 * @author wumengmeng <wu_mengmeng@foxmail.com>
 */
function predis_str_set($key = '', $value = '', $time = null, $db = null)
{
    $result = Pstring::set($key, $value, $time, $db);
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
function predis_str_get($key = '', $db = null)
{
    $result = Pstring::get($key, $db);
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
function predis_str_del($key = '', $db = null)
{
    $result = Pstring::del($key, $db);
    return $result;
}


/************* redis-Hash表操作 *************/

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
function predis_hash_mset($table = '', $arr_data = [], $db = null)
{
    $result = Phash::mset($table, $arr_data, $db);
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
function predis_hash_set($table = '', $key = '', $value = '', $db = null)
{
    $result = Phash::set($table, $key, $value, $db);
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
function predis_hash_incr($table = '', $key = '', $step = 1, $db = null)
{
    $result = Phash::incr($table, $key, $step, $db);
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
function predis_hash_decr($table = '', $key = '', $step = 1, $db = null)
{
    $result = Phash::decr($table, $key, $step, $db);
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
function predis_hash_get($table = '', $key = '', $db = null)
{
    $result = Phash::get($table, $key, $db);
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
function predis_hash_del($table = '', $key = '', $db = null)
{
    $result = Phash::del($table, $key, $db);
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
function predis_hash_del_all($table = '', $db = null)
{
    $result = Phash::delall($table, $db);
    return $result;
}

/**
 * 设置hash表过期时间-hash类型
 *
 * @param string $table
 * @param int    $expire_time
 * @param null   $db
 *
 * @return int
 * @author wumengmeng <wu_mengmeng@foxmail.com>
 */
function predis_hash_expire($table = '', $expire_time = 0, $db = null)
{
    $result = Phash::expire($table, $expire_time, $db);
    return $result;
}


/************* redis-队列操作 *************/

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
function predis_queue_lpush($table = '', $value = '', $db = null)
{
    $result = Plist::lpush($table, $value, $db);
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
function predis_queue_lpop($table = '', $db = null)
{
    $result = Plist::lpop($table, $db);
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
function predis_queue_rpush($table = '', $value = '', $db = null)
{
    $result = Plist::rpush($table, $value, $db);
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
function predis_queue_rpop($table = '', $db = null)
{
    $result = Plist::rpop($table, $db);
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
function queue_in($table = '', $value = '', $db = null)
{
    $result = Plist::queue_in($table, $value, $db);
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
function queue_mout($table = '', $num = 10, $db = null)
{
    $result = Plist::queue_mout($table, $num, $db);
    return $result;
}

/**
 * 设置list表过期时间-list类型
 *
 * @param string $table
 * @param int    $expire_time
 * @param null   $db
 *
 * @return int
 * @author wumengmeng <wu_mengmeng@foxmail.com>
 */
function predis_list_expire($table = '', $expire_time = 0, $db = null)
{
    $result = Plist::expire($table, $expire_time, $db);
    return $result;
}

/************* redis-set操作 *************/


/************* redis-zset操作 *************/

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
function predis_zset_incr($table = '', $member = '', $step = 0, $db = null)
{
    $result = Pzset::incr($table, $member, $step, $db);
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
function predis_zset_decr($table = '', $member = '', $step = 0, $db = null)
{
    $result = Pzset::decr($table, $member, $step, $db);
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
function predis_zset_take($table = '', $num = 1, $db = null)
{
    $result = Pzset::take($table, $num, $db);
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
function predis_zset_take_desc($table = '', $num = 1, $db = null)
{
    $result = Pzset::take_desc($table, $num, $db);
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
function predis_zset_del($table = '', $db = null)
{
    $result = Pzset::delall($table, $db);
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
function predis_zset_rem($table = '', $member = '', $db = null)
{
    $result = Pzset::del($table, $member, $db);
    return $result;
}


/**
 * 设置zset表过期时间-zset类型
 *
 * @param      $table
 * @param int  $expire_time
 * @param null $db
 *
 * @return int
 * @author wumengmeng <wu_mengmeng@foxmail.com>
 */
function predis_zset_expire($table, $expire_time = 0, $db = null)
{
    $result = Pzset::expire($table, $expire_time, $db);
    return $result;
}
