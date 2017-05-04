<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/4/13
 * Time: 下午1:38
 * Desc: 错误码
 */

namespace App\Models;

class ExceptionCodeModel
{

    /**
     * 错误码切分：2_4_3
     */

    const
        //BASE 100
        EXP_MODEL_BASE                                      = 101001000,

        //文章
        EXP_MODEL_ARTICLE                                   = 101002000,
        EXP_MODEL_ARTICLE_CONTENT                           = 101003000,
        EXP_MODEL_ARTICLE_EXTEND                            = 101004000,
        EXP_MODEL_ARTICLE_CATEGORY                          = 101005000,
        EXP_MODEL_USER_FREE                                 = 101006000,
        EXP_MODEL_REPLY                                     = 101007000,


        //最后一个，新增请在这个上面添加
        EXP_LAST_ITEM                                       = 100000000;



}
