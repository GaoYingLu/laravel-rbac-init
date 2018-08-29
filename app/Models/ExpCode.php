<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/4/13
 * Time: 下午1:38
 * Desc: 错误码
 */

namespace App\Models;

class ExpCode
{

    /**
     * 错误码切分：2_4_3
     */

    const
        SUCCESS_DEFAULT                                     = 2000, // 成功
        ERROR_DEFAULT                                       = 5000, // 默认
        ERROR_PARAM_IS_EMPTY                                = 5001, // 参数为空
        ERROR_PARAM_INVALID_SIGN                            = 5002, // 签名错误
        ERROR_PARAM_INVALID_FORMAT                          = 5003, // 参数格式错误
        ERROR_IP_NOT_ALLOWED                                = 5004, // 请求 IP 限制
        ERROR_METHOD_NOT_ALLOWED                            = 5005, // 请求方法限制
        ERROR_SYS_DB_SQL                                    = 5006, // 数据库错误
        ERROR_SYS_CACHE                                     = 5007, // 缓存错误
        ERROR_SYS_UPLOAD_FAILED                             = 5008, // 上传失败
        ERROR_SYS_SEND_SMS_LIMIT                            = 5009, // 短信发送限制
        ERROR_SYS_SEND_WX_TEMPLATE_LIMIT                    = 5010, // 微信发送限制
        ERROR_SYS_SEND_SMS                                  = 5011, // 发送短信失败
        ERROR_SYS_GET_FILE_OSS_FAILED                       = 5012, // 获取文件的对象存储

        //最后一个，新增请在这个上面添加
        EXP_LAST_ITEM                                       = 100000000;

    public static function errorArr()
    {
        return [
            self::SUCCESS_DEFAULT                           => "success!",
            self::ERROR_DEFAULT                             => "failed!",
            self::ERROR_PARAM_IS_EMPTY                      => "param %s is empty!",
            self::ERROR_PARAM_INVALID_SIGN                  => "param sign is error!",
            self::ERROR_PARAM_INVALID_FORMAT                => "param %s is invalid format!",
            self::ERROR_IP_NOT_ALLOWED                      => "request ip %s is not allow!",
            self::ERROR_METHOD_NOT_ALLOWED                  => "request method %s is not allow!",
            self::ERROR_SYS_DB_SQL                          => "system db error!",
            self::ERROR_SYS_CACHE                           => "system cache error!",
            self::ERROR_SYS_UPLOAD_FAILED                   => "system upload failed!",
            self::ERROR_SYS_SEND_SMS_LIMIT                  => "system send phone %s sms limit!",
            self::ERROR_SYS_SEND_WX_TEMPLATE_LIMIT          => "system send wechat template %s limit!",
            self::ERROR_SYS_SEND_SMS                        => "send sms %s failed!",
            self::ERROR_SYS_GET_FILE_OSS_FAILED             => "get file %s failed!",
        ];
    }

    public static function getErrorMessage($code, $param=[])
    {
        $errorArr = self::errorArr();
        $msg = isset($errorArr[$code]) ? $errorArr[$code] : $errorArr[self::ERROR_DEFAULT];
        $param  = is_array($param) ? $param : [$param];

        return vsprintf($msg, $param);
    }


}
