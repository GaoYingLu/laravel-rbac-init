<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2016/12/24
 * Time: 下午10:03
 */

namespace App\Http\Controllers\Admin;

use App\Logics\UserLogic;
use App\Models\FreeOrderModel;

class UserController extends BaseController{

    public function index(){

        $logic = new UserLogic();

        $data['data'] = $logic->getUserList();

        $data['title'] = '用户列表';
        //这里是用户列表
        return view('admin.user.index', $data);


    }

    public function freeOrder(){

        //这里是订单列表
        $logic = new UserLogic();

        $data['data'] = $logic->getFreeList();

        $data['title'] = '免费申请';

        return view('admin.user.freeOrder', $data);

    }

    public function dealFreeOrder( $id ){

        $logic = new UserLogic();

        $data['status'] = FreeOrderModel::STATUS_SUCCESS;

        $result = $logic->doFree($data, $id);

        if( $result['status'] ){

            return redirect()->back()->with('success', '操作成功!');

        }else{

            return redirect()->back()->with('error', $result['msg']);

        }

    }

    public function delFreeOrder( $id ){

        $logic = new UserLogic();

        $result = $logic->delInfoById($id);

        if( $result['status'] ){

            return redirect()->back()->with('success', '操作成功!');

        }else{

            return redirect()->back()->with('error', $result['msg']);

        }
    }

    public function doDelUser( $id ){

        $logic = new UserLogic();

        $result = $logic->doDelUserById($id);

        if( $result['status'] ){

            return redirect()->back()->with('success', '操作成功!');

        }else{

            return redirect()->back()->with('error', $result['msg']);

        }


    }

}