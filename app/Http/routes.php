<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::auth();

    // 后台角色、权限管理
    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('admin_user', 'AdminUserController');
    Route::post('admin_user/destroyall',['as'=>'admin.admin_user.destroy.all','uses'=>'AdminUserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'RoleController@destroyAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'PermissionController@destroyAll']);

    // 问题管理
    Route::any('questions/index', ['as' => 'admin.questions.index', 'uses' => 'QuestionsController@index']);
    Route::any('questions/create', ['as' => 'admin.questions.create', 'uses' => 'QuestionsController@create']);
    Route::any('questions/edit/{id}', ['as' => 'admin.questions.edit', 'uses' => 'QuestionsController@edit']);
    Route::any('questions/doCreate', ['as' => 'admin.questions.doCreate', 'uses' => 'QuestionsController@doCreate']);
    Route::any('questions/doEdit', ['as' => 'admin.questions.doEdit', 'uses' => 'QuestionsController@doEdit']);
    Route::any('questions/delete/{id}', ['as' => 'admin.questions.delete', 'uses' => 'QuestionsController@delete']);

    //文章
//    Route::any('addArticle', ['as'=>'admin.article.add','uses'=>'ArticleController@add']);
//    Route::any('doAddOrUpdateArticle', ['as'=>'admin.article.doAddOrUpdate','uses'=>'ArticleController@doAddOrUpdate']);
//    Route::any('articleList', ['as'=>'admin.article.index','uses'=>'ArticleController@index']);
//    Route::any('articleDel/{id}', ['as'=>'admin.article.del','uses'=>'ArticleController@deleteById']);
//    Route::any('articleEdit/{id}', ['as'=>'admin.article.edit','uses'=>'ArticleController@edit']);

    //分类
    Route::any('category/index', ['as'=>'admin.category.index','uses'=>'CategoryController@index']);
    Route::any('category/create', ['as'=>'admin.category.create','uses'=>'CategoryController@create']);
    Route::any('category/doCreate', ['as'=>'admin.category.doCreate','uses'=>'CategoryController@doCreate']);
    Route::any('category/edit/{id}', ['as'=>'admin.category.edit','uses'=>'CategoryController@edit']);
    Route::any('category/doEdit', ['as'=>'admin.category.doEdit','uses'=>'CategoryController@doEdit']);
    Route::any('category/delete/{id}', ['as'=>'admin.category.delete','uses'=>'CategoryController@delete']);

    //活动
    Route::any('activity/index', ['as' => 'admin.activity.index', 'uses' => 'ActivityController@index']);
    Route::any('activity/create', ['as' => 'admin.activity.create', 'uses' => 'ActivityController@create']);
    Route::any('activity/edit/{id}', ['as' => 'admin.activity.edit', 'uses' => 'ActivityController@edit']);
    Route::any('activity/doCreate', ['as' => 'admin.activity.doCreate', 'uses' => 'ActivityController@doCreate']);
    Route::any('activity/doEdit', ['as' => 'admin.activity.doEdit', 'uses' => 'ActivityController@doEdit']);
    Route::any('activity/delete/{id}', ['as' => 'admin.activity.delete', 'uses' => 'ActivityController@delete']);

});

Route::any('activity', ['uses'=>'HomeController@verify']);


Route::any('file/get/{file}', ['as'=>'file.get','uses'=>'FileController@show']);
Route::any('verify', ['uses'=>'HomeController@verify']);

