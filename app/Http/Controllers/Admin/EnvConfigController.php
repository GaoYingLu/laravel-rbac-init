<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/1
 * Time: 下午9:21
 * Desc: 文章相关
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class EnvConfigController extends BaseController{


    public function modifyEnv(Request $request)
    {

        $config = $request->input('value');

        print_r(explode($config, "\r\n"));

        var_dump($config);die;

        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

        $contentArray->transform(function ($item) use ($config){
            foreach ($config as $key => $value){
                if(str_contains($item, $key)){
                    return $key . '=' . $value;
                }
            }

            return $item;
        });

        $content = implode($contentArray->toArray(), "\n");

        var_dump($content);die;

        //return File::put($envPath, $content);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 查看配置信息
     */
    public function index(){

        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

        $data = [];

        $contentArray->transform(function ($item) use ($data){
            foreach ($data as $key => $value){
                if(str_contains($item, $key)){
                    return $key . '=' . $value;
                }
            }
            return $item;
        });

        $data['config'] = implode($contentArray->toArray(), "\n");

        $data['title'] = 'ENV-配置';

        return view('admin.env_config', $data);

    }


}