<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2018/8/29
 * Time: 下午3:32
 */

namespace App\Models;
use Cache;

class SystemConfig extends BaseModel{

    const
        STATUS_COMMON     = 20,
        STATUS_OFFLINE    = 10,


    END = 0;

    public static function getList($key='', $status='', $size = 10)
    {
        $model = new SystemConfig();
        if ($key) {
            $model = $model->where('config_key_md5', self::getSecurityKey($key));
        }
        if ($status) {
            $model = $model->where('status', $status);
        }
        return $model->orderBy('id', 'desc')->paginate($size);
    }

    public static function addInfo($key, $value, $status=self::STATUS_COMMON)
    {
        $data = [
            'config_key'        => $key,
            'config_key_md5'    => md5($key),
            'config_value'      => json_encode($value),
            'status'            => $status
        ];

        $result = self::create($data);
        if ($result) {
            self::setCache($data['config_key_md5'], $data['config_value']);
        }

        return $result;
    }

    public static function modifyInfo($id, $key, $value, $status)
    {
        $model = self::find($id);
        $model->config_key      = $key;
        $model->config_key_md5  = md5($key);
        $model->config_value    = json_encode($value);
        $model->status          = $status;

        $result = $model->save();
        if ($result) {
            self::setCache($model->config_key_md5, $model->config_value);
        }
        return $result;
    }

    public static function getInfoByKey($key)
    {
        $result = Cache::get(md5($key));
        if (!empty($result)) {
            return json_decode($result, true);
        }

        $data = self::where('config_key_md5', md5($key))
            ->first();
        if (empty($data)) {
            return false;
        }
        self::setCache($data['config_key_md5'], $data['config_value']);

        return json_decode($data['config_value'], true);
    }

    protected static function setCache($key, $value)
    {
        $check = Cache::has($key);
        if ($check) {
            Cache::forget($key);
        }
        return Cache::put($key, $value);
    }

    protected static function getSecurityKey($key)
    {
        if (empty($key)) {
            return false;
        }
        return md5($key);
    }



}