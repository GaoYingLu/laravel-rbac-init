<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/1
 * Time: 下午9:21
 * Desc: 文章相关
 */

namespace App\Http\Controllers\Admin;

use App\Logics\ArticleLogic;
use App\Logics\CategoryLogic;
use App\Tools\ToolTime;
use Illuminate\Http\Request;

class ArticleController extends BaseController{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 首页
     */
    public function index( Request $request ){

        $logic = new ArticleLogic();

        $where = $request->all();

        $where['size'] = 15;

        $data['data'] = $logic->getListByWhere($where);

        $data['title'] = '信息列表';
        
        return view('admin.article.index', $data);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 添加
     */
    public function add(){

        $data['title'] = '添加信息';

        $cateLogic = new CategoryLogic();

        $data['category'] = $cateLogic->getList();

        return view('admin.article.add', $data);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @desc
     */
    public function edit( $id ){

        $logic = new ArticleLogic();

        $article = $logic->getDetailByWhere(['id' => $id]);

        if( empty($article->id) ){

            return redirect()->back()->with('error', '信息不存在');

        }

        $data['title'] = '编辑';

        $cateLogic = new CategoryLogic();

        $data['category'] = $cateLogic->getList();

        $data['article'] = $article;

        return view('admin.article.add', $data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @desc 执行添加
     */
    public function doAddOrUpdate(Request $request){

        $this->validate($request, [
            'title'     => 'required|max:255',
            'cat_id'    => 'required|numeric'
        ]);

        $data = $request->all();

        $uploadPath = env('UPLOAD_PATH').'/'.ToolTime::dbDate().'/';

        if( $request->hasFile('thumb') && $request->file('thumb')->isValid() ){

            $thumbImg = $request->file('thumb')->getFilename().'.'.$request->file('thumb')->getClientOriginalExtension();

            $thumbUpload = $request->file('thumb')->move($uploadPath, $thumbImg);

            if( $thumbUpload ){

                $data['thumb_img'] = '/'.$uploadPath.$thumbImg;

            }

        }

        if( $request->hasFile('attachment') && $request->file('attachment')->isValid() ){

            $attachment = $request->file('attachment')->getFilename().'.'.$request->file('attachment')->getClientOriginalExtension();

            $attachmentUpload = $request->file('attachment')->move($uploadPath, $attachment);

            if( $attachmentUpload ){

                $data['attachment'] = '/'.$uploadPath.$attachment;

            }

        }

        $logic = new ArticleLogic();

        $id = isset($data['id']) ? $data['id'] : 0;

        $result = $logic->doAddOrUpdate($data, $id);

        if( $result['status'] ){

            return redirect('/admin/articleList')->with('success', '操作成功');

        }else{

            return redirect()->back()->withInput($request->input())->with('error', $result['msg']);

        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @desc 执行删除
     */
    public function deleteById( $id ){

        $logic = new ArticleLogic();

        $res = $logic->doDelById($id);

        return response()->json($res['status'] ? ['status' => 1] : ['status' => 0, 'msg' => $res['msg']]);

    }

}