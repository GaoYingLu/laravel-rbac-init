<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/16
 * Time: 下午10:56
 * Desc: 分类
 */

namespace App\Http\Controllers\Admin;

use App\Logics\ArticleLogic;
use Illuminate\Http\Request;

class MsgController extends BaseController{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 留言列表
     */
    public function index(){

        $logic = new ArticleLogic();

        $data['data'] = $logic->getMsgListByWhere(['size' => 15]);

        $data['title'] = '留言列表';

        return view('admin.article.msg', $data);

    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 编辑
     */
    public function doMsg( $id ){

        $logic = new ArticleLogic();

        $res = $logic->doMsg($id);

        return response()->json($res['status'] ? ['status' => 1] : ['status' => 0, 'msg' => $res['msg']]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @desc 删除
     */
    public function delMsg( $id ){

        $categoryLogic = new ArticleLogic();

        $res = $categoryLogic->doDeleteMsg($id);

        return response()->json($res['status'] ? ['status' => 1] : ['status' => 0, 'msg' => $res['msg']]);

    }



}