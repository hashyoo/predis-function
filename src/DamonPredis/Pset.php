<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/6/30 0030
 * Time: 18:00
 */

namespace DamonPredis;

class Pset extends PredisClient
{

    //克隆方法私有化:禁止从外部克隆对象
    private function __clone() { }

    //expire($key, 20)

    private function kkey($key){
        return parent::key_set().$key;
    }

    private function connect(){
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
    public function expire($table = '', $expire_time = 0,$db = null){
        $instance = self::connect();
        if($db !== null){
            $instance->select(intval($db));
        }
        $table = self::kkey($table);
        $result = $instance->expire($table, intval($expire_time));
        return $result;
    }


}