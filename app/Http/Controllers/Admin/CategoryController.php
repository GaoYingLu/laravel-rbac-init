<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2018/6/5
 * Time: 下午2:02
 */
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController{

    protected $modelCategory = null;

    protected $validateRules = [
        'pid'           => 'required|numeric',
        'type'          => "required|Rule::in(['first-zone', 'second-zone'])",
        'content'       => 'required|min:50|max:16777215',
        'summary'       => 'sometimes|max:255',
        'tags'          => 'sometimes|max:128',
        'category_id'   => 'sometimes|numeric'
    ];


    public function __construct()
    {
        parent::__construct();
        $this->modelCategory = new Category();
    }

    public function index(Request $request)
    {
        $category = $this->modelCategory->getList();
        $category = $this->modelCategory->generateTree($category);

        return view('admin.category.index', compact('category'));
    }

    public function create(Request $request)
    {
        $category = $this->modelCategory->getList();
        $categorys = $this->modelCategory->generateTree($category);
        $templates = Category::getTemplate();
        $categoryType = Category::getType();

        return view('admin.category.create', compact('categorys', 'templates', 'categoryType'));
    }

    public function edit($id)
    {
        $detail = $this->modelCategory->getById($id, true);
        $category = $this->modelCategory->getList();
        $categorys = $this->modelCategory->generateTree($category);
        $templates = Category::getTemplate();
        $categoryType = Category::getType();

        return view('admin.category.create', compact('detail', 'categorys', 'templates', 'categoryType'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->all();
        $this->validate($request,$this->validateRules);

        $data = [
            'user_id'       => $loginUser->id,
            'category_id'   => intval($request->input('category_id',0)),
            'title'         => trim($request->input('title')),
            'content'       => clean($request->input('content')),
            'summary'       => $request->input('summary'),
            'device'        => $request->input('device', 1),
            'status'        => 1,
        ];

        if($request->hasFile('logo')){
            $validateRules = [
                'logo' => 'required|image|max:'.config('tipask.upload.image.max_size'),
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filePath = 'articles/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $data['logo'] = str_replace("/","-",$filePath);
        }

        $result = $this->modelCategory->add($data);

        if ($result) {
            return redirect('/admin/category/index')->with('success', ' 操作成功!');
        }
        return redirect('/admin/category/index')->with('error', ' 操作失败!');
    }

    public function doEdit(Request $request)
    {
        $data = $request->all();
        $result = $this->modelCategory->edit($data);

        if ($result) {
            return redirect('/admin/category/index')->with('success', ' 操作成功!');
        }
        return redirect('/admin/category/index')->with('error', ' 操作失败!');
    }

    public function delete($id)
    {
        $result = $this->modelCategory->deleteById($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);

    }


}