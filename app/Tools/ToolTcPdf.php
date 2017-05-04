<?php
/**
 * Created by PhpStorm.
 * User: hexing
 * Date: 16/10/18
 * Time: 上午11:57
 */

namespace App\Tools;

use TCPDF;

class ToolTcPdf
{

    /**
     * @param $title
     * @param $data
     * @param bool $isShow
     * @desc 生成pdf,包含显示和下载
     */
    public static function createPdfFile($title, $data, $imgArr=[], $isShow=true)
    {
        
        //实例化
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        $pdf->SetMargins(15, 15, 15);

        //距底部
        $pdf->setFooterMargin(10);

        // 设置分页
        $pdf->SetAutoPageBreak(TRUE, 20);

        // set image scale factor
        $pdf->setImageScale(1.25);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        //设置字体
        $pdf->SetFont('stsongstdlight', '', 14);

        $pdf->AddPage();

        if( count($imgArr) > 1 && count(explode('分割线', $data)) > 1 ){

            $data = explode('分割线', $data);

            $pdf->writeHTML($data[0]);

            $pdf->Image(env('APP_URL_PC').'/static/img/'.$imgArr[0]['img'], $imgArr[0]['x'], $imgArr[0]['y']);

            $pdf->writeHTML($data[1]);

            $pdf->Image(env('APP_URL_PC').'/static/img/'.$imgArr[1]['img'], $imgArr[1]['x'], $imgArr[1]['y']);

        }else{

            //写入
            $pdf->writeHTML($data);

            //增加图片
            foreach ( $imgArr as $info ){

                $pdf->Image(env('APP_URL_PC').'/static/img/'.$info['img'], $info['x'], $info['y']);

            }
        }

        $pdf->SetTitle($title);

        //输出PDF
        if( $isShow ){

            $pdf->Output($title.'.pdf','D');

        }else{//下载

            $pdf->Output($title.'.pdf', 'D');

        }
    }

    /**
     * @return bool
     * @desc 这里是tcpdf参数示例
     */
    private function paramHelp()
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // 设置文档信息
        $pdf->SetCreator('Hello');
        $pdf->SetAuthor('demo');
        $pdf->SetTitle('Welcome to 9douyu.com!');
        $pdf->SetSubject('TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, PHP');

        // 设置页眉和页脚信息
        $pdf->SetHeaderData('', 30, '9douyu.com', '测试',
            array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // 设置页眉和页脚字体
        $pdf->setHeaderFont(Array('stsongstdlight', '', '10'));
        $pdf->setFooterFont(Array('helvetica', '', '8'));

        // 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

        // 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

        // set image scale factor
        $pdf->setImageScale(1.25);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        //设置字体
        $pdf->SetFont('stsongstdlight', '', 14);

        $pdf->AddPage();

        $str1 = '欢迎来到9douyu.com';

        $pdf->Write(0,$str1,'', 0, 'L', true, 0, false, false, 0);

        return false;

        //输出PDF
        $pdf->Output('demo.pdf', 'D');

    }

}