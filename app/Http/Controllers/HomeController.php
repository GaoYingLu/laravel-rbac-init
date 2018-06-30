<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Goods;
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

    private function lib_replace_end_tag($str)
    {
        if (empty($str)) return false;
        $str = htmlspecialchars($str);
        $str = str_replace( '/', "", $str);
        $str = str_replace("\\", "", $str);
        $str = str_replace(">", "", $str);
        $str = str_replace("<", "", $str);
        $str = str_replace("<SCRIPT>", "", $str);
        $str = str_replace("</SCRIPT>", "", $str);
        $str = str_replace("<script>", "", $str);
        $str = str_replace("</script>", "", $str);
        $str=str_replace("select","select",$str);
        $str=str_replace("join","join",$str);
        $str=str_replace("union","union",$str);
        $str=str_replace("where","where",$str);
        $str=str_replace("insert","insert",$str);
        $str=str_replace("delete","delete",$str);
        $str=str_replace("update","update",$str);
        $str=str_replace("like","like",$str);
        $str=str_replace("drop","drop",$str);
        $str=str_replace("create","create",$str);
        $str=str_replace("modify","modify",$str);
        $str=str_replace("rename","rename",$str);
        $str=str_replace("alter","alter",$str);
        $str=str_replace("cas","cast",$str);
        $str=str_replace("&","&",$str);
        $str=str_replace(">",">",$str);
        $str=str_replace("<","<",$str);
        $str=str_replace(" ",chr(32),$str);
        $str=str_replace(" ",chr(9),$str);
        $str=str_replace("    ",chr(9),$str);
        $str=str_replace("&",chr(34),$str);
        $str=str_replace("'",chr(39),$str);
        $str=str_replace("<br />",chr(13),$str);
        $str=str_replace("''","'",$str);
        $str=str_replace("css","'",$str);
        $str=str_replace("CSS","'",$str);
        return $str;
    }

    public function verify(Request $request)
    {
        $id = $request->input('id');

        if (strlen($id) != 32) {
            $data = [
                'code' => 5000,
                'msg'   => 'error id'
            ];
            echo json_encode($data);
            die;
        }

        $id = $this->lib_replace_end_tag($id);

        if (empty($id)) {
            $data = [
                'code' => 5000,
                'msg'   => 'error valid id'
            ];
            echo json_encode($data);
            die;
        }

        $object = Goods::where('good_num', $id)
            ->first();

        if (!$object) {
            $data = [
                'code' => 5000,
                'msg'   => 'empty info'
            ];
            echo json_encode($data);
            die;
        }

        $object->views = $object->views + 1;
        $content = $object->content;
        $views = $object->views;
        $object->save();

        $result = json_decode($content, true);
        $result['views'] = $views;

        if (isset($_GET['zsm']) && !empty($_GET['zsm'])) {
            $result['zsm'] = $_GET['zsm'];
        } elseif (!isset($result['zsm'])) {
            $result['zsm'] = '11416241000791675443274991';
        }
        if (!isset($result['dyxh'])) {
            $result['dyxh'] = '201805260010011694';
        }

        $data = $result;
        return view('verify', compact('data'));
    }

}
