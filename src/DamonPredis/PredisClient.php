<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

namespace DamonPredis;


use Predis\Client;

class PredisClient
{

    /**
     * 必须先声明一个静态私有属性:用来保存当前类的实例
     * 1. 为什么必须是静态的?因为静态成员属于类,并被类所有实例所共享
     * 2. 为什么必须是私有的?不允许外部直接访问,仅允许通过类方法控制方法
     * 3. 为什么要有初始值null,因为类内部访问接口需要检测实例的状态,判断是否需要实例化
     */


    //构造器私有化:禁止从类外部实例化
    private function __construct() { }

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    private function setting()
    {
        $redis_workname = env('REDIS_WORK','default');
        return [
          'host'     => env('REDIS_HOST', '127.0.0.1'),
          'password' => env('REDIS_PASSWORD', null),
          'port'     => env('REDIS_PORT', 6379),
          'database' => env('REDIS_DB', 0),
          'str'      => $redis_workname.':str:',
          'hash'     => $redis_workname.':hash:',
          'list'     => $redis_workname.':list:',
          'set'      => $redis_workname.':set:',
          'zset'     => $redis_workname.':zset:',
        ];
    }

    protected function key_str()
    {
        return self::setting()['str'];
    }

    protected function key_hash()
    {
        return self::setting()['hash'];
    }

    protected function key_list()
    {
        return self::setting()['list'];
    }

    protected function key_set()
    {
        return self::setting()['set'];
    }

    protected function key_zset()
    {
        return self::setting()['zset'];
    }

    protected function get_instance()
    {
        $setting = yoo_array_remain(self::setting(), ['host', 'password', 'port', 'database']);
        return new Client($setting);
    }

    /**
     * 删除数据
     *
     * @param $key
     *
     * @return int
     * @author wumengmeng <wu_mengmeng@foxmail.com>
     */
    public function redis_del($key, $db = null)
    {
        //del 删除
        $instance = self::get_instance();
        if ($db !== null) {
            $instance->select(intval($db));
        }
        $result = $instance->del($key);
        return $result;//true
    }



}