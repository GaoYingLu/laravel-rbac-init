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

Route::group(['middleware' => 'web', 'namespace' => 'Pc'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/about', 'HomeController@aboutUs');
    Route::get('/service', 'HomeController@service');
    Route::get('/contact', 'HomeController@contact');
    Route::get('/news', 'HomeController@news');
    Route::post('/sendMsg', 'HomeController@sendMsg');
    Route::get('/detail/{id}', 'HomeController@detail');



    Route::get('userRegister', 'RegisterController@index');
    Route::post('doUserRegister', 'RegisterController@doRegister');
    Route::get('userLogin', 'LoginController@index');
    Route::post('doUserLogin', 'LoginController@doLogin');
    Route::get('userLogout', function (){
        \Session::forget(env('_USER_SESSION_'));
        return redirect('/');
    });

    Route::get('free', 'UserController@free');
    Route::post('doFree', 'UserController@doFree');

    Route::get('/article/detail/{id}', 'ArticleController@detailById');
    Route::get('/article/list', 'ArticleController@getList');
    Route::get('/product', 'ArticleController@getAllProduct');

});



Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::auth();

    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('admin_user', 'AdminUserController');
    Route::post('admin_user/destroyall',['as'=>'admin.admin_user.destroy.all','uses'=>'AdminUserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'RoleController@destroyAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'PermissionController@destroyAll']);
    Route::resource('blog', 'BlogController');

    //文章
    Route::get('addArticle', ['as'=>'admin.article.add','uses'=>'ArticleController@add']);
    Route::post('doAddOrUpdateArticle', ['as'=>'admin.article.doAddOrUpdate','uses'=>'ArticleController@doAddOrUpdate']);
    Route::get('articleList', ['as'=>'admin.article.index','uses'=>'ArticleController@index']);
    Route::any('articleDel/{id}', ['as'=>'admin.article.del','uses'=>'ArticleController@deleteById']);
    Route::get('articleEdit/{id}', ['as'=>'admin.article.edit','uses'=>'ArticleController@edit']);

    //分类
    Route::get('category', ['as'=>'admin.category.index','uses'=>'CategoryController@index']);
    Route::post('doAddOrUpdateCategory', ['as'=>'admin.category.doAddOrUpdate','uses'=>'CategoryController@doAddOrUpdate']);
    Route::any('categoryDel/{id}', ['as'=>'admin.category.del','uses'=>'CategoryController@deleteById']);
    Route::get('categoryEdit/{id}', ['as'=>'admin.category.edit','uses'=>'CategoryController@edit']);

    //env配置
    Route::any('envConfig', ['as'=>'admin.envConfig.index','uses'=>'EnvConfigController@index']);
    Route::post('doModifyEnvConfig', ['as'=>'admin.envConfig.doAddOrUpdate','uses'=>'EnvConfigController@modifyEnv']);

    //留言
    Route::get('msg', ['as'=>'admin.msg','uses'=>'MsgController@index']);
    Route::any('doMsg/{id}', ['as'=>'admin.doMsg','uses'=>'MsgController@doMsg']);
    Route::any('delMsg/{id}', ['as'=>'admin.delMsg','uses'=>'MsgController@delMsg']);



});
