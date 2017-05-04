<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/28
 * Time: 上午11:16
 */

namespace App\Models;

use App\Lang\LangModel;

class ArticleContentModel extends CommonScopeModel{


    protected $table = 'article_content';

    public static $codeArr = [
        'doAddOrUpdate'             => 1,
    ];


    public static $expNameSpace = ExceptionCodeModel::EXP_MODEL_ARTICLE_CONTENT;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'article_id', 'content'
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
    public function doAddOrUpdate($data, $articleId=0){
        
        if( $articleId ){

            $res = self::updateOrCreate(['article_id' => $articleId], $data);

        }else{

            $res = self::updateOrCreate(['article_id' => null], $data);

        }

        if( !$res->id ){

            throw new \Exception(LangModel::getLang('ERROR_ADD_ARTICLE'), self::getFinalCode('doAdd'));

        }

        return $res->id;

    }



}