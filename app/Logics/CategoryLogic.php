<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/24
 * Time: 下午5:56
 * Desc: 文章分类
 */

namespace App\Logics;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Tools\ToolArray;

class CategoryLogic extends BaseLogic{

    private $model = null;

    public function __construct()
    {

        $this->model = new CategoryModel();

    }

    /**
     * @return mixed
     * @desc 获取所有
     */
    public function getList(){

        $pidList = $this->model
            ->orderBy('id')
            ->get()
            ->toArray();

        $pidList = ToolArray::arrayToKey($pidList);

        return $this->generateTree($pidList);

    }

    /**
     * @param $items
     * @return array
     * @desc 生成目录树
     */
    public function generateTree($items){

        foreach($items as $item){

            $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']];

        }

        return isset($items[0]['son']) ? $items[0]['son'] : array();

    }

    /**
     * @param $tree
     * @desc 显示目录树
     */
    public static function getTreeData($tree, $str='', $catId =0){

        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;';

        $selected = '';

        foreach($tree as $t){

            if( $catId == $t['id'] ){

                $selected = "selected='selected'";

            }

            echo "<option value='{$t['id']}' {$selected}>{$str}|-{$t['name']}</option>";

            $selected = '';

            if(isset($t['son'])){

                self::getTreeData($t['son'], $str, $catId);

            }

        }

    }

    public static function getListStyleTreeData($tree, $isSon=false, $str=''){

        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;';

        foreach($tree as $t){

            if( $isSon ){

                echo "<tr class=\"hide parent-permission-{$t['pid']}\">
                                                        <td>
                                                            <div class=\"ckbox ckbox-default\">
                                                                <input type=\"checkbox\" name=\"id\" id=\"id-{$t['id']}\" value=\"{$t['id']}\" class=\"selectall-item\">
                                                                <label for=\"id-{$t['id']}\"></label>
                                                                $str<a href=\"javascript:;\" class=\"show-sub-permissions\" data-id=\"{$t['id']}\">
                                                                    <span class=\"glyphicon glyphicon-chevron-right\"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>$str|-- {$t['id']}</td>
                                                        <td>$str|-- {$t['name']}</td>
                                                        <td>{$t['alias']}</td>
                                                        <td>{$t['sort']}</td>
                                                        <td>{$t['created_at']}</td>
                                                        <td>
                                                            <a href=\"/admin/categoryEdit/{$t['id']}\" class=\"btn btn-white btn-sm\">
                                                                <i class=\"fa fa-pencil\"></i> 编辑
                                                            </a>
                                                            <a class=\"btn btn-danger btn-sm permission-delete\" data-href=\"/admin/categoryDel/{$t['id']}\">
                                                                <i class=\"fa fa-trash-o\"></i> 删除
                                                            </a>
                                                        </td>
                                                    </tr>";

            }else{

                echo "<tr>
                     <td>
                          <div class=\"ckbox ckbox-default\">
                              <input type=\"checkbox\" name=\"id\" id=\"id-{$t['id']}\" value=\"{$t['id']}\" class=\"selectall-item\">
                              <label for=\"id-{$t['id']}\"></label>
                              <a href=\"javascript:;\" class=\"show-sub-permissions\" data-id=\"{$t['id']}\">
                                  <span class=\"glyphicon glyphicon-chevron-right\"></span>
                              </a>
                          </div>
                      </td>
                      <td>{$t['id']}</td>
                      <td>
                          <a href=\"javascript:;\" class=\"show-sub-permissions\" data-id=\"{$t['id']}\">
                              <p class=\"text-info\">{$t['name']}</p>
                          </a>
                      </td>
                      <td>{$t['alias']}</td>
                      <td>{$t['sort']}</td>
                      <td>{$t['created_at']}</td>
                      <td><a href=\"/admin/categoryEdit/{$t['id']}\" class=\"btn btn-white btn-sm\"><i class=\"fa fa-pencil\"></i> 编辑</a>
                          <a class=\"btn btn-danger btn-sm permission-delete\" data-href=\"/admin/categoryDel/{$t['id']}\">
                          <i class=\"fa fa-trash-o\"></i> 删除</a>
                      </td>
                  </tr>";

            }

            if(isset($t['son'])){

                self::getListStyleTreeData($t['son'], true, $str);

            }

        }

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

        try{

            //添加
            $insertId = $this->model->doAddOrUpdate($data, $id);

            return self::callSuccess($insertId);

        }catch (\Exception $e){

            self::rollback();

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $id
     * @return array
     * @desc 通过id执行删除
     */
    public function deleteById($id){

        if( empty($id) ){

            return self::callError('参数有误');

        }

        try{

            //检测该分类是否有子分类
            $this->model->checkHasSonById($id);

            //检测该分类下是否有信息关联
            $articleModel = new ArticleModel();

            $articleModel->checkHasInfoById($id);

            $this->model->Id($id)->delete();

            return self::callSuccess();

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $id
     * @return mixed
     * @desc 通过id获取详情
     */
    public function getInfoById($id){

        return $this->model->Id($id)->first();

    }



}