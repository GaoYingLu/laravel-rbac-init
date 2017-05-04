<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/28
 * Time: 上午11:16
 */

namespace App\Models;

use App\Lang\LangModel;

class ArticleModel extends CommonScopeModel{


    protected $table = 'article';

    public static $codeArr = [
        'doAdd'             => 1,
        'checkHasInfoById'  => 2
    ];


    public static $expNameSpace = ExceptionCodeModel::EXP_MODEL_ARTICLE;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'title', 'thumb_img', 'attachment', 'intro', 'keywords', 'description', 'cat_id', 'hits', 'sort', 'admin_id', 'template'
    ];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     * */
     protected $guarded = ['id', 'created_at', 'updated_at'];


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

            throw new \Exception(LangModel::getLang('ERROR_ADD_ARTICLE'), self::getFinalCode('doAdd'));

        }

        return $res->id;

    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     * @desc 检测该分类是否有信息关联
     */
    public function checkHasInfoById($id){

        $result = self::where('cat_id', $id)
            ->first();

        if( !empty($result) ){

            throw new \Exception(LangModel::getLang('请先删除该分类下的文章!'), self::getFinalCode('checkHasSonById'));

        }

        return $result;

    }





}