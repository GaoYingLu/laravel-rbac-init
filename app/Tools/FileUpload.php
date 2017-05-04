<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/6/29
 * Time: 下午3:01
 * Desc: 上传工具类
 */

namespace App\Tools;

use App\Http\Logics\Logic;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;


class FileUpload
{

    /**
     * @param $file
     * @param string $savePath
     * @param string $fileName
     * @return array
     * @desc 保存文件,返回文件名称 文件保存路径,文件的保存路径以斜线结尾
     */
    public function saveFile($file, $savePath='', $fileName='')
    {

        if( !$file ){

            return false;

        }

        $savePath = $savePath ? $savePath : '/uploads/'.\App\Tools\ToolTime::dbDate().'/';

        $storage = new FileSystem($savePath);

        $file = new File('foo', $storage);

        $fileName = $fileName ? $fileName : uniqid();

        $file->setName($fileName);

        $file->addValidations(array(
            // Ensure file is of type "image/png"
            new Mimetype(['image/png', 'image/jpeg', 'image/jpg', 'image/gif']),

            //You can also add multi mimetype validation
            //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
            new Size('5M')
        ));

        /*$data = array(
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            'md5'        => $file->getMd5(),
            'dimensions' => $file->getDimensions()
        );*/

        try {
            // Success!
            return $file->upload();
        } catch (\Exception $e) {
            // Fail!
            return $file->getErrors();
        }

    }

}