<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/27
 * Time: 下午2:33
 */

namespace App\Logics;

use Illuminate\Support\Facades\DB;

class BaseLogic{


    /**
     * @todo 不同的业务场景，可以定义不同code
     */
    const
        CODE_SUCCESS        = 200,  //成功
        CODE_ERROR          = 500;  //失败


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
            'status'    => true,
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
            'status'    => false,
            'code'      => $code,
            'msg'       => $msg,
            'data'      => empty($data) ? '' : $data
        ];

    }

    /**
     * @param int $page
     * @param int $size
     * @return mixed
     * @desc 生成offset值
     */
    public static function getOffset($page=1, $size=10){

        return max( ($page - 1), 1 ) * $size;

    }
    
}