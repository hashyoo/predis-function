<?php
/**
 * Created by PhpStorm.
 * User: wumengmeng <wu_mengmeng@foxmail.com>
 * Date: 2020/7/8 0008
 * Time: 18:02
 */

function dd($s){
    var_dump($s);
}

define('ROOT_PATH',__DIR__.'/');

require __DIR__.'/vendor/autoload.php';

$resoure = ROOT_PATH . '.env';
yoo_load_ini_file($resoure);

/*string*/
$result = \DamonPredis\Pstring::set('吴蒙蒙',['dd'=>'哈哈','hh'=>'lala'],null,10);
dd($result);
$result = \DamonPredis\Pstring::get('吴蒙蒙',10);
dd($result);
$result = \DamonPredis\Pstring::incr('吴蒙蒙66',50,10);
dd($result);
$result = \DamonPredis\Pstring::decr('吴蒙蒙66',12,10);
dd($result);
$result = \DamonPredis\Pstring::del('吴蒙蒙66',10);
yoo_dump($result);


/*hash*/

/*list*/

/*zset*/

/*set*/


