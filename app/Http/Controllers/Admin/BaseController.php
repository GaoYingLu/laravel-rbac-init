<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Breadcrumbs;
use Auth;
class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');

        Breadcrumbs::register('dashboard', function ($breadcrumbs) {
            $breadcrumbs->push('Dashboard', route('admin.home'));
        });
    }

    /**
     * @return mixed
     * @desc 获取管理员id
     */
    public function getAdminId(){

        return Auth::guard('admin')->user()->id;

    }

}
