<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/27
 * Time: 下午2:33
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

    public static $defaultNameSpace = ExceptionCodeModel::EXP_MODEL_BASE;

    public static $codeArr = [];
    
    protected static function getFinalCode($errorText='')
    {

        $codeExt = isset(static::$codeArr[$errorText]) ? static::$codeArr[$errorText] : 0;

        if( isset(static::$expNameSpace)  ){

            return static::$expNameSpace + $codeExt;

        }else{

            return self::$defaultNameSpace;

        }

    }
    
}