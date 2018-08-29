<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2018/8/29
 * Time: 下午3:51
 */
namespace App\Logics;

use Mockery\Exception;

class SystemConfig extends BaseLogic{

    public static function getList($key='', $status='', $size = 20)
    {
        return \App\Models\SystemConfig::getList($key, $status, $size);
    }

    public static function addInfo($key, $value, $status)
    {
        try{

        }catch (Exception $exception){

        }
    }

}