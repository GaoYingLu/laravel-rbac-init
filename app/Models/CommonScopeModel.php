<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/2
 * Time: 下午12:02
 * Desc: 公共查询条件类
 */

namespace App\Models;

class CommonScopeModel extends BaseModel{

    public function scopeId($query, $id){
        if (!$id) {
            return $query;
        }
        return $query->where('id', $id);
    }

    public function scopeIds($query, $ids){
        if (!$ids) {
            return $query;
        }
        return $query->whereIn('id', $ids);
    }

    public function scopeCategoryId($query, $categoryId){
        if (!$categoryId) {
            return $query;
        }
        return $query->where('category_id', $categoryId);
    }


}