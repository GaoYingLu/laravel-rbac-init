<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2018/6/5
 * Time: 下午2:02
 */
namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Questions;
use App\Tools\ToolArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ActivityController extends BaseController{

    protected $modelActivity = '';

    public function __construct()
    {
        parent::__construct();
        $this->modelActivity = new Activity();
    }

    public function index(Request $request)
    {
        $activities = $this->modelActivity->getList();

        return view('admin.activity.index', compact('activities'));
    }

    public function create()
    {
        $statusArr = Activity::getStatusArr();

        return view('admin.activity.create', compact('statusArr'));
    }

    public function edit($id)
    {

        $detail = $this->modelActivity->getById($id, true);
//        var_dump($detail);die;
        $statusArr = Activity::getStatusArr();

        return view('admin.activity.create', compact('detail', 'statusArr'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->all();

        $result = $this->modelActivity->add($data);

        if ($result) {
            return redirect('/admin/activity/index')->with('success', ' 操作成功!');
        }
        return redirect('/admin/activity/index')->with('error', ' 操作失败!');
    }

    public function doEdit(Request $request)
    {
        $data = $request->all();

        $result = $this->modelActivity->edit($data);

        if ($result) {
            return redirect('/admin/activity/index')->with('success', ' 操作成功!');
        }
        return redirect('/admin/activity/index')->with('error', ' 操作失败!');
    }

    public function delete($id)
    {
        $result = $this->modelActivity->deleteById($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }


}