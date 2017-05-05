<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tools\ToolTime;
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
        return view('home');
    }


    /**
     * @param Request $request
     * @desc 图片上传
     */
    public function uploadImg( Request $request ){

        $uploadPath = env('UPLOAD_PATH').'/'.ToolTime::dbDate().'/';

        $thumbImg = $request->file('upload')->getFilename().'.'.$request->file('upload')->getClientOriginalExtension();

        $thumbUpload = $request->file('upload')->move($uploadPath, $thumbImg);

        if( $thumbUpload ){

            echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("0", "/'.$uploadPath.$thumbImg.'", "");</script>';

        }else{

            echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("1", "", "上传失败");</script>';

        }

        die;

    }
}
