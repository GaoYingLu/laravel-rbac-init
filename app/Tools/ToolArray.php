<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/4/21
 * Time: 下午1:35
 */

namespace App\Tools;

class ToolArray{


    /**
     * 重新设置数组的key为自定义的key
     * @param  array $arr
     * @param  string $key
     * @return array
     */
    public static function arrayToKey($arr, $key = "id",$mul = 0) {

        $arr = self::objectToArray($arr);

        $out = array();

        foreach ((array)$arr as $value){
            if($mul){
                $out[$value[$key]][] = $value;
            }else{
                $out[$value[$key]] = $value;
            }
        }

        return $out;
    }

    /**
     * 得到数组所有的key数组
     * @param  array $arr
     * @param  string $key
     * @return array
     */
    public static function arrayToIds($arr, $key = "id" ,$unique = true) {

        $arr = self::objectToArray($arr);

        $ids    = array();

        foreach ((array)$arr as $value){
            $ids[] = $value[$key];
        }

        return $unique ? array_unique($ids) : $ids;
    }

    /**
     * @param $arr
     * @param $key
     * @return mixed
     * @desc 二维数组指定key去重
     */
    public static function arrayAssocUnique($arr, $key){
        $tmp_arr = array();
        foreach($arr as $k => $v){
            if(in_array($v[$key], $tmp_arr)){
                unset($arr[$k]);
            }else{
                $tmp_arr[] = $v[$key];
            }
        }
        return $arr;
    }

    /**
     * @param $obj
     * @return array
     * @desc 对象转换数组
     */
    public static function objectToArray($e){

        $e=(array)$e;

        foreach($e as $k=>$v){

            if( gettype($v) =='object' || gettype($v) == 'array' ){

                $e[$k] = (array)self::objectToArray($v);

            }

        }

        return $e;

    }

    /**
     * @param array $data
     * @return array|string
     * @desc 数组转化为字符串以逗号分割
     */
    public static function arrayToStr($data=[], $spilt=',')
    {

        if( empty($data) ){

            return '';

        }

        if( is_array($data) ){

            //去空
            $data = array_filter($data);

            //去重
            $data = array_unique($data);

            //转化为字符串
            $dataStr = implode($spilt, $data);

        }else{

            $dataStr = $data;

        }

        return $dataStr;

    }
    
}