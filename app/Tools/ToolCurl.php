<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/6/3
 * Time: 上午9:53
 * Desc: Curl工具类
 */

namespace App\Tools;

use GuzzleHttp\Client;

class ToolCurl{

    /**
     * @param $url
     * @param array $params
     * @return string
     * @desc curlPost
     */
    public static function curlPost($url, $params = [], $headers = []) {

        $client = new Client();

        if(!empty($params)) {
            $params = ['form_params' => $params];
        }
        
        if(!empty($headers)) {
            $params['headers'] = $headers;
        }

        try {
            $response = $client->request('post', $url, $params);
        } catch(\Exception $e) {
            return json_encode(["status" => false, "code" => 500, "msg" => $e->getMessage(), "data" => []]);
        }

        return (string)$response->getBody();

    }

    /**
     * @param $url
     * @param array $params
     * @return string
     * @desc curlGet
     */
    public static function curlGet($url, $params = []) {

        $client = new Client();

        if(!empty($params)) {
            $params = ['form_params' => $params];
        }

        $response = $client->request('get', $url, $params);

        return (string)$response->getBody();

    }

}