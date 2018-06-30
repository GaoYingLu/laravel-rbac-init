<?php

namespace App\Models;



use App\Tools\ToolArray;

class Category extends CommonScopeModel
{

    protected $fillable = [];

    protected $table = 'category';

    const
            TYPE_QUESTION       = 1,
            TYPE_ARTICLE        = 2,

            TEMPLATE_DEFAULT    = 'default',


        END = '';

    public static function getTemplate()
    {
        return [
            self::TEMPLATE_DEFAULT => self::TEMPLATE_DEFAULT,
        ];
    }

    public static function getType()
    {
        return [
            self::TYPE_QUESTION => '问题',
            self::TYPE_ARTICLE => '文章',
        ];
    }

    public static function getTypeStr($type='')
    {
        $arr = [
            self::TYPE_QUESTION     => '问题',
            self::TYPE_ARTICLE      => '文章'
        ];

        return isset($arr[$type]) ? $arr[$type] : '未知';
    }


    public function getList()
    {
        return $this->orderBy('sort')->get()->toArray();
    }

    public function generateTree($list=[])
    {
        if (empty($list)) {
            return false;
        }

        $list = ToolArray::arrayToKey($list);

        foreach ($list as $key => $value){
            if ($value['pid']) {
                $list[$value['pid']]['sub'][] = $value;
                unset($list[$key]);
            }
        }
        return $list;
    }

    public function add($data)
    {
        $model              = new Category();

        $model->pid         = $data['pid'];
        $model->type        = $data['type'];
        $model->name        = $data['name'];
        $model->alias       = $data['alias'];
        $model->sort        = $data['sort'];
        $model->intro       = $data['intro'];
        $model->template    = $data['template'];

        return $model->save();
    }

    public function getById($id, $array=false)
    {
        $result = self::find($id);
        if ($array && $result) {
            $result = $result->toArray();
        }
        return $result;
    }

    public function edit($data)
    {

        $model = $this->getById($data['id']);

        $model->pid         = $data['pid'];
        $model->type        = $data['type'];
        $model->name        = $data['name'];
        $model->alias       = $data['alias'];
        $model->sort        = $data['sort'];
        $model->intro       = $data['intro'];
        $model->template    = $data['template'];

        return $model->save();
    }

    public function deleteById($id)
    {
        $detail = $this->getById($id);
        return $detail->delete();
    }


}
