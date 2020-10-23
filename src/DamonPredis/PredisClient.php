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

    private static $instance;

    //保存用户的自定义配置参数
    private static $setting = [];

    //构造器私有化:禁止从类外部实例化
    private function __construct() { }

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    //    /**
    //     * 实现静态调用非静态方法
    //     *
    //     * @param $method
    //     * @param $arguments
    //     *
    //     * @return mixed
    //     * @throws \Exception
    //     * @author wumengmeng <wu_mengmeng@foxmail.com>
    //     */
    //    public static function __callStatic($method, $arguments)
    //    {
    //        $obj = new self();
    //        if (method_exists($obj, $method)) {
    //            return call_user_func_array([$obj, $method], $arguments);
    //        }
    //        throw new \Exception('static is call failed');
    //    }

    private function setting()
    {
        return [
          'host'     => env('REDIS_HOST', '127.0.0.1'),
          'password' => env('REDIS_PASSWORD', null),
          'port'     => env('REDIS_PORT', 6379),
          'database' => env('REDIS_DB', 0),
          'str'      => env('REDIS_STRING', 'string_'),
          //          //          'str_prefix' =>env('REDIS_STRING_DB',''),
          'hash'     => env('REDIS_HASH', 'hash_'),
          //          //          'hash_prefix' =>env('REDIS_HASH_DB',''),
          'list'     => env('REDIS_LIST', 'list_'),
          //          //          'list_prefix' =>env('REDIS_LIST_DB',''),
          'set'      => env('REDIS_SET', 'set_'),
          //          //          'set_prefix' =>env('REDIS_SET_DB',''),
          'zset'     => env('REDIS_ZSET', 'zset_'),
          //          //          'zset_prefix' =>env('REDIS_ZSET_DB',''),
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

    /**
     * 连接上的redis的私有化方法
     */
    private function instance()
    {
        $setting = yoo_array_remain(self::setting(), ['host', 'password', 'port', 'database']);
        return new Client($setting);
    }

    //因为用静态属性返回类实例,而只能在静态方法使用静态属性
    //所以必须创建一个静态方法来生成当前类的唯一实例
    protected function get_instance()
    {
        return self::instance();
        //检测当前类属性$instance是否已经保存了当前类的实例
        if (!isset(self::$instance) || (self::$instance === null)) {
            //如果没有,则创建当前类的实例

            self::$instance = self::instance();
        }
        //如果已经有了当前类实例,就直接返回,不要重复创建类实例
        return self::$instance;
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

    /*
        //exists检测是否存在某值
    $redis->exists('foo');//true

        //del 删除
    $redis->del('foo');//true

    //type 类型检测,字符串返回string,列表返回 list,set表返回set/zset,hash表返回hash
    $redis->type('foo'); //不存在,返回none

    $redis->keys('foo*');  //返回foo1和foo2的array
    $redis->keys('f?o?');   //同上

    //dbsize 返回redis当前数据库的记录总数
    $redis->dbsize();

    */

}