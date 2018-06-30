<?php

namespace App\Models;


class Activity extends CommonScopeModel
{

    protected $fillable = [];

    protected $table = 'activity';

    const   STATUS_COMMON   = 200,
            STATUS_ERROR    = 500,

            END = '';

    public static function getStatusArr()
    {
        return [
            self::STATUS_COMMON => '正常',
            self::STATUS_ERROR  => '下线'
        ];
    }



    public function getList()
    {
        return self::paginate(15);
    }

    public function add($data)
    {
        $model                  = new Activity();

        $model->name            = $data['name'];
        $model->description     = json_encode($data['description']);
        $model->extends_info    = json_encode($data['extends_info']);
        $model->start_at        = $data['start_at'];
        $model->end_at          = $data['end_at'];

        return $model->save();
    }

    public function getById($id, $array=false)
    {
        $result = self::find($id);
        if ($array && $result) {
            $result = $result->toArray();
            $result['description'] = !empty($result['description']) ? explode("\n", json_decode($result['description'], true)) : '';
            $result['extends_info'] = !empty($result['extends_info']) ? explode("\n", json_decode($result['extends_info'], true)) : '';
        }
        return $result;
    }

    public function edit($data)
    {

        $model = $this->getById($data['id']);

        $model->name            = $data['name'];
        $model->status          = $data['status'];
        $model->description     = json_encode($data['description']);
        $model->extends_info    = json_encode($data['extends_info']);
        $model->start_at        = $data['start_at'];
        $model->end_at          = $data['end_at'];

        return $model->save();
    }

    public function deleteById($id)
    {
        $detail = $this->getById($id);
        return $detail->delete();
    }


}
