<?php

namespace App\Models;


class Questions extends CommonScopeModel
{

    protected $fillable = [];

    protected $table = 'questions';

    const
        TYPE_MULTI_RADIO    = 1,
        TYPE_MULTI_SELECT   = 2,

        end = '';

    public static function getMultiChoice()
    {
        return [
            self::TYPE_MULTI_RADIO  => '单选',
            self::TYPE_MULTI_SELECT => '多选',
        ];
    }

    public function getList($categoryId=0)
    {
        return $this->CategoryId($categoryId)
            ->orderBy('id', 'desc')
            ->paginate(15);
    }

    public function add($data)
    {
        if (!empty($data['content'])) {
            $data['content'] = array_filter(explode("\n", $data['content']));
        }

        $model = new Questions();

        $model->category_id = $data['category_id'];
        $model->name        = $data['name'];
        $model->answer      = $data['answer'];
        $model->type        = $data['type'];
        $model->file        = $data['file'];
        $model->content     = json_encode($data['content']);

        return $model->save();
    }

    public function edit($data)
    {
        if (!empty($data['content'])) {
            $data['content'] = array_filter(explode("\n", $data['content']));
        }

        $detail = $this->getById($data['id']);

        $detail->category_id = $data['category_id'];
        $detail->name        = $data['name'];
        $detail->answer      = $data['answer'];
        $detail->type        = $data['type'];
        $detail->content     = json_encode($data['content']);
        if ($data['file']) {
            $detail->file = $data['file'];
        }

        return $detail->save();
    }

    public function deleteById($id)
    {
        $detail = $this->getById($id);
        return $detail->delete();
    }

    public function getById($id, $array=false)
    {
        $result = self::find($id);
        if ($array && $result) {
            $result = $result->toArray();
            $result['content'] = json_decode($result['content'], true);
        }
        return $result;
    }

    public function getArrayById($id)
    {
        return $this->getById($id, true);
    }


}
