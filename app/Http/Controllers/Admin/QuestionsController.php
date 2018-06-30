<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2018/6/5
 * Time: 下午2:02
 */
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Questions;
use App\Tools\ToolArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends BaseController{

    protected $modelQuestions = null;
    protected $modelCategory = null;

    public function __construct()
    {
        parent::__construct();
        $this->modelQuestions = new Questions();
        $this->modelCategory = new Category();
    }

    public function index(Request $request)
    {
        $categoryId = $request->input('category_id', 0);

        $questions = $this->modelQuestions->getList($categoryId);
        $categorys = $this->modelCategory->getList();
        $categorys = ToolArray::arrayToKey($categorys);

        return view('admin.questions.index', compact('questions', 'categorys'));
    }

    public function create()
    {
        $categorys = $this->modelCategory->getList();
        $multiChoices = Questions::getMultiChoice();
        $categorys = $this->modelCategory->generateTree($categorys);

        return view('admin.questions.create', compact('categorys', 'multiChoices'));
    }

    public function edit($id)
    {
        $detail = $this->modelQuestions->getArrayById($id);
        $categorys = $this->modelCategory->getList();
        $categorys = $this->modelCategory->generateTree($categorys);

        $multiChoices = Questions::getMultiChoice();

        return view('admin.questions.create', compact('detail', 'categorys', 'multiChoices'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('file')){
            $validateRules = [
                'file' => 'required|image|max:2048',
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            $filePath = 'questions/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $data['file'] = str_replace("/","-",$filePath);
        }
        $result = $this->modelQuestions->add($data);

        if ($result) {
            return redirect('/admin/questions/index')->with('success', ' 操作成功!');
        }
        return redirect('/admin/questions/index')->with('error', ' 操作失败!');
    }

    public function doEdit(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('file')){
            $validateRules = [
                'file' => 'required|image|max:2048',
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filePath = 'questions/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $data['file'] = str_replace("/","-",$filePath);
        }

        $result = $this->modelQuestions->edit($data);

        if ($result) {
            return redirect('/admin/questions/index')->with('success', ' 操作成功!');
        }
        return redirect('/admin/questions/index')->with('error', ' 操作失败!');
    }

    public function delete($id)
    {
        $result = $this->modelQuestions->deleteById($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }


}