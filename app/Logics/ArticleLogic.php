<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/31
 * Time: 下午5:47
 */

namespace App\Logics;

use App\Models\ArticleContentModel;
use App\Models\ArticleModel;
use App\Models\MsgModel;

class ArticleLogic extends BaseLogic{

    protected $model = '';

    public function __construct()
    {

        $this->model = new ArticleModel();

    }

    public function getListByWhere($where=[]){

        $model = $this->model;

        if( isset($where['id']) ){

            $model = $model->Id($where['id']);

        }

        if( isset($where['title']) ){

            $model = $model->Title($where['title']);

        }

        if( isset($where['cat_id']) ){

            $model = $model->CatId($where['cat_id']);

        }

        $where['size'] = isset($where['size']) ? $where['size'] : 30;

        return $model->select('article.*', 'category.name as cat_name')
            ->orderBy('article.sort')
            ->orderBy('article.id', 'desc')
            ->leftJoin('category', 'category.id', '=', 'article.cat_id')
            ->paginate($where['size']);

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取单个信息
     */
    public function getDetailByWhere($where=[]){

        $model = $this->model;

        if( isset($where['id']) ){

            $model = $model->Id($where['id']);

        }

        $info = $model->first();

        $contentModel = new ArticleContentModel();

        $content = $contentModel->articleId($where['id'])->first();

        $info['content'] = $content['content'];

        return $info;

    }

    /**
     * @param $data
     * @return array
     * @desc 执行添加或者更新
     */
    public function doAddOrUpdate($data, $id=0){

        if( empty($data) ){

            return self::callError('信息不能为空');

        }

        $articleContentModel = new ArticleContentModel();
        
        self::beginTransaction();

        try{
            
            //文章
            $insertId = $this->model->doAddOrUpdate($data, $id);

            $data['article_id'] = $insertId;

            //内容
            $articleContentModel->doAddOrUpdate($data, $insertId);

            self::commit();

            return self::callSuccess($insertId);

        }catch (\Exception $e){

            self::rollback();

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取详情
     */
    public function getContentByWhere($where=[]){

        $model = new ArticleContentModel();

        if( isset($where['id']) ){

            $model = $model->Id($where['id']);

        }

        if( isset($where['article_id']) ){

            $model = $model->ArticleId($where['article_id']);

        }

        return $model->first();

    }
    
    /**
     * @param $id
     * @return mixed
     * @desc 执行删除
     */
    public function doDelById($id){

        $contentModel = new ArticleContentModel();

        try{

            $this->model->Id($id)->delete();

            $contentModel->ArticleId($id)->delete();

            return self::callSuccess('');

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $data
     * @return array
     * @desc 插入留言
     */
    public function doSendMsg($data){

        $model = new MsgModel();

        try{

            $model->doAddOrUpdate($data);

            return self::callSuccess('');

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    public function getMsgListByWhere($where=[]){

        $model = new MsgModel();

        $where['size'] = isset($where['size']) ? $where['size'] : 30;

        return $model->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->paginate($where['size']);

    }

    public function doMsg($id){

        $model = new MsgModel();

        try{

            $data['status'] = 200;

            $model->doAddOrUpdate($data, $id);

            return self::callSuccess('');

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    public function doDeleteMsg($id){

        $model = new MsgModel();

        try{

            $model->where(['id' => $id])->delete();

            return self::callSuccess('');

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }


    




}