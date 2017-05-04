<?php

namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Logics\ArticleLogic;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['title'] = '网站首页';

        $articleLogic = new ArticleLogic();

        //关于我们
        $data['aboutUs'] = $articleLogic->getDetailByWhere(['id' => 1]);

        //banner
        $data['banner'] = $articleLogic->getListByWhere(['cat_id' => 2]);

        //我们的服务介绍
        $data['service'] = $articleLogic->getDetailByWhere(['id' => 3]);

        //我们的服务列表
        $data['serviceList'] = $articleLogic->getListByWhere(['cat_id' => 5, 'size' => 4]);

        //选择我们的理由
        $data['chooseUs'] = $articleLogic->getDetailByWhere(['id' => 8]);

        //成功案例
        $data['successCase'] = $articleLogic->getListByWhere(['cat_id' => 7]);

        return view(env('SITE_TEMPLATE').'.index', $data);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 关于我们
     */
    public function aboutUs(){

        $data['title'] = '关于我们';

        $articleLogic = new ArticleLogic();

        $data['about'] = $articleLogic->getDetailByWhere(['id' => 1]);

        $data['aboutList'] = $articleLogic->getListByWhere(['cat_id' => 8]);

        $data['team'] = $articleLogic->getListByWhere(['cat_id' => 9]);

        return view(env('SITE_TEMPLATE').'.about', $data);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 致胜服务
     */
    public function service(){

        $data['title'] = '致胜服务';

        $articleLogic = new ArticleLogic();

        $data['data'] = $articleLogic->getListByWhere(['cat_id' => 10, 'size' => 6]);

        return view(env('SITE_TEMPLATE').'.service', $data);

    }

    public function contact(){

        $data['title'] = '联系我们';

        $articleLogic = new ArticleLogic();

        $data['info'] = $articleLogic->getDetailByWhere(['id' => 24]);

        return view(env('SITE_TEMPLATE').'.contact', $data);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 留学资讯
     */
    public function news(){
        
        $data['title'] = '留学资讯';

        $articleLogic = new ArticleLogic();

        $data['data'] = $articleLogic->getListByWhere(['cat_id' => 11, 'size' => 7]);

        return view(env('SITE_TEMPLATE').'.articleList', $data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @desc 留言
     */
    public function sendMsg(Request $request){

        $data = $request->all();

        $articleLogic = new ArticleLogic();

        $result = $articleLogic->doSendMsg($data);

        if( $result['status'] ){

            return redirect('/contact')->with('success', '操作成功,我们会尽快与您取得联系!');

        }else{

            return redirect()->back()->withInput($request->input())->with('error', $result['msg']);

        }

    }

    public function detail($id){

        $articleLogic = new ArticleLogic();

        $data['about'] = $articleLogic->getDetailByWhere(['id' => $id]);

        $data['title'] = $data['about']['title'];

        return view(env('SITE_TEMPLATE').'.about', $data);

    }
    
    

}
