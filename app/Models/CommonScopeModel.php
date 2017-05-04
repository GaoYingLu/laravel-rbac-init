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

        return $query->where('id', $id);

    }

    public function scopeIds($query, $ids){

        return $query->whereIn('id', $ids);

    }

    public function scopeArticleId($query, $articleId){
        
        return $query->where('article_id', $articleId);

    }

    public function scopeArticleIds($query, $articleIds){

        return $query->whereIn('article_id', $articleIds);

    }

    public function scopeTitle($query, $title){

        return $query->where('title', 'like', '%'.$title.'%');

    }

    public function scopeCatId($query, $catId){

        return $query->where('cat_id', $catId);

    }

    public function scopeCatIds($query, $catIds){

        return $query->whereIn('cat_id', $catIds);

    }

    public function scopePids($query, $pids){

        return $query->whereIn('pid', $pids);

    }

    public function scopePid($query, $pid){

        return $query->where('pid', $pid);

    }

}