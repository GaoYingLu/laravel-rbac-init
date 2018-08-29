<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/27
 * Time: 下午2:33
 */

namespace App\Logics;

use App\Models\ExpCode;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class BaseLogic{


    /**
     * @todo 不同的业务场景，可以定义不同code
     */
    const
        CODE_SUCCESS        = 2000,  //成功
        CODE_ERROR          = 5000;  //失败


    public static function beginTransaction()
    {
        DB::beginTransaction();
    }

    public static function rollback()
    {
        DB::rollback();
    }

    public static function commit()
    {
        DB::commit();
    }

    /**
     * @param array $data
     * @param string $msg
     * @return array
     * @desc 统一返回成功数据
     */
    public static function callSuccess($data = [], $msg = '成功')
    {

        return [
            'code'      => self::CODE_SUCCESS,
            'msg'       => $msg,
            'data'      => empty($data) ? '' : $data
        ];

    }

    /**
     * @param string $msg
     * @param int $code
     * @param array $data
     * @return array
     * @desc 统一返回失败数据
     */
    public static function callError($msg = '', $code = self::CODE_ERROR, $data = [])
    {

        return [
            'code'      => $code,
            'msg'       => $msg,
            'data'      => empty($data) ? '' : $data
        ];

    }

    public static function ensureNull($result, $errno, $args = array())
    {
        if (! is_null($result)) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureNotNull($result, $errno, $args = array())
    {
        if (is_null($result)) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureNotEmpty($result, $errno, $args = array())
    {
        if (empty($result)) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureEmpty($result, $errno, $args = array())
    {
        if (! empty($result)) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureArray($result, $errno, $args = array())
    {
        if (! is_array($result)) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureNotFalse($result, $errno, $args = array())
    {
        if ($result === false) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureFalse($result, $errno, $args = array())
    {
        if ($result !== false) {
            self::throwBaseException($errno, $args);
        }

        return $result;
    }

    public static function ensureJson($string, $errno, $args = array())
    {
        json_decode($string, true);
        if (!json_last_error() == JSON_ERROR_NONE) {
            self::throwBaseException($errno, $args);
        }
        return $string;
    }

    public static function ensureIsPhone($phone, $errno, $args = array()){

        $pattern    = '/^(13\d|14[57]|15[012356789]|18\d|17[0135678])\d{8}$/';
        if(!preg_match($pattern, $phone)) {
            self::throwBaseException($errno, $args);
        }
        return $phone;
    }

    public static function ensureIsSetAndNotEmpty($arr, $k, $errno, $args = array())
    {
        if (isset($arr[$k]) && !empty($arr[$k])) {
            return $arr[$k];
        } else {
            self::throwBaseException($errno, $args);
        }
    }

    public static function throwBaseException($errno, $args)
    {
        throw new Exception(ExpCode::getErrorMessage($errno, $args), $errno);
    }



    
}