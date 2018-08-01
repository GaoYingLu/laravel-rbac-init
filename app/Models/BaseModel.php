<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/27
 * Time: 下午2:33
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

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