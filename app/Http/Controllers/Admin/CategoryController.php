<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/16
 * Time: 下午10:56
 * Desc: 分类
 */

namespace App\Http\Controllers\Admin;

use App\Logics\CategoryLogic;
use Illuminate\Http\Request;

class CategoryController extends BaseController{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 分类列表
     */
    public function index(){

        $logic = new CategoryLogic();

        $data['category'] = $logic->getList();

        $data['title'] = '分类列表';

        return view('admin.article.category', $data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @desc 执行添加
     */
    public function doAddOrUpdate( Request $request ){

        $this->validate($request, [
            'name' => 'required|max:255',
            'pid' => 'required|max:11',
        ]);

        $data = $request->all();

        $data['id'] = (isset($data['id']) && $data['id']>0) ? (int)$data['id'] : 0;

        $data['admin_id'] = $this->getAdminId();

        $logic = new CategoryLogic();
        
        $result = $logic->doAddOrUpdate($data, $data['id']);

        if( $result['status'] ){

            return redirect('/admin/category')->with('success', '操作成功');

        }else{

            return redirect()->back()->withInput($request->input())->with('error', $result['msg']);

        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 编辑
     */
    public function edit( $id ){

        $logic = new CategoryLogic();

        $data['cateInfo'] = $logic->getInfoById($id);

        $data['category'] = $logic->getList();

        return view('admin.article.category', $data);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @desc 删除
     */
    public function deleteById( $id ){

        $categoryLogic = new CategoryLogic();

        $res = $categoryLogic->deleteById($id);

        return response()->json($res['status'] ? ['status' => 1] : ['status' => 0, 'msg' => $res['msg']]);

    }



}