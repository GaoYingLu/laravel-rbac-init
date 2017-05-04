<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/28
 * Time: 上午11:16
 */

namespace App\Models;

use App\Lang\LangModel;

class MsgModel extends CommonScopeModel{

    protected $table = 'msg';

    public static $codeArr = [
        'doAddOrUpdate'             => 1,
        'checkHasSonById'           => 2
    ];


    public static $expNameSpace = ExceptionCodeModel::EXP_MODEL_ARTICLE_CATEGORY;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'msg', 'status'
    ];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     * */
     protected $guarded = ['created_at', 'updated_at'];


    /**
     * @param $data
     * @return mixed
     * @desc 执行添加获取更新
     */
    public function doAddOrUpdate($data, $id=0){

        if( $id ){

            $res = self::updateOrCreate(['id' => $id], $data);

        }else{

            $res = self::updateOrCreate(['id' => null], $data);

        }

        if( !$res->id ){

            throw new \Exception(LangModel::getLang('ERROR_ADD_ARTICLE_CATEGORY'), self::getFinalCode('doAddOrUpdate'));

        }

        return $res->id;

    }


}