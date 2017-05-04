<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/4/15
 * Time: 下午4:37
 * Desc: Model 操作提示信息
 */

namespace App\Lang;

class LangModel
{

    const

        SUCCESS_COMMON                                          = '操作成功',
        ERROR_COMMON                                            = '操作失败',

        /******************************************这里是分割线************************************************/

        //添加文章
        ERROR_ADD_ARTICLE                                       = '添加文章失败',
        ERROR_UPDATE_ARTICLE                                    = '更新文章失败',

        //文章内容
        ERROR_ADD_ARTICLE_CONTENT                               = '添加文章内容失败',
        ERROR_UPDATE_ARTICLE_CONTENT                            = '更新文章内容失败',

        //文章扩展
        ERROR_ADD_ARTICLE_EXTEND                                = '添加文章扩展失败',
        ERROR_UPDATE_ARTICLE_EXTEND                             = '更新文章扩展失败',

        //分类
        ERROR_ADD_ARTICLE_CATEGORY                              = '添加分类失败',
        ERROR_EMPTY_CATEGORY                                    = '分类ID不能为空',


        
        ERROR_END                                             = null;


    /**
     * @param $name
     * @return string
     */
    public static function getLang($name)
    {

        $className = __CLASS__;

        $lang = defined("$className::$name") ? constant("$className::$name") : $name;

        return $lang;

    }

}