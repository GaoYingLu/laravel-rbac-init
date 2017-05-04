<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/7/20
 * Time: 上午11:00
 * Desc: 二维码生成工具
 * Use: 调用方式:ToolQrCode::createCode($url);
 */

namespace App\Tools;

use Endroid\QrCode\QrCode;


class ToolQrCode{


    /**
     * @param $content
     * @param bool $getFilePath 默认直接输出二维码,如果需要返回二维码地址,参数为true
     * @param int $size
     * @param int $padding
     * @param string $imgType
     * @return bool|string
     * @desc 获取二维码
     */
    public static function createCode($content, $getFilePath=false, $size=300, $padding=0, $imgType=QrCode::IMAGE_TYPE_PNG)
    {

        $qrCode = new QrCode();

        $qrCode->setText($content)
            ->setSize($size)
            ->setPadding($padding)
            ->setImageType($imgType);

        if( $getFilePath ){

            $savePath = env('QR_CODE_SAVE_PATH', 'resources/qrcode/');

            $fileName = md5($content).'.'.$qrCode->getImageType();

            if( @file_exists($savePath.$fileName) ){

                return $savePath.$fileName;

            }

            $saveRs = @file_put_contents($savePath.$fileName, $qrCode->get());

            if( !$saveRs ){

                return false;

            }

            return $savePath.$fileName;

        }

        header('Content-Type: '.$qrCode->getContentType());

        $qrCode->render();

    }

}