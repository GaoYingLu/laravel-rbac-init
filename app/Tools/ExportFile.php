<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/9
 * Time: 下午7:22
 * Desc: 导出文件
 */

namespace App\Tools;

class ExportFile{
    
    /**
     * @param array $data
     * @param string $filename
     * @desc 执行csv导出
     */
    public static function csv($data=[], $filename='report'){

        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:text/csv;charset=gbk");
        header("Content-Disposition:attachment;filename=".$filename.".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Pragma:public');

        // 导出xls 开始
        if ( !empty($data) ){

            foreach($data as $key => $val){

                foreach ($val as $ck => $cv) {

                    if( strlen($cv) >10 ){

                        $data[$key][$ck]=iconv("UTF-8", "GBK", $cv)."\t";
                    }else{

                        $data[$key][$ck]=iconv("UTF-8", "GBK", $cv);
                    }

                    //$data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);

                }

                echo implode(",", $data[$key]). "\r\n";
            }

        }

    }

    /**
     * @param array $data
     * @param string $filename
     * @desc 导出为Excel 格式
     */
    public static function exportExcel($data=[], $filename='report'){

        header("Content-type:application/octet-stream");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=".$filename.".xls");
        header("Pragma: no-cache");
        header("Accept-Ranges:bytes");
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header("Expires: 0");
        header('Pragma:public');

        // 导出xls 开始
        if ( !empty($data) ){

            foreach($data as $key => $val){

                foreach ($val as $ck => $cv) {

                    if( strlen($cv) >10 ){

                        $data[$key][$ck]=iconv("UTF-8", "GBK", $cv)."\t";
                    }else{

                        $data[$key][$ck]=iconv("UTF-8", "GBK", $cv);
                    }
                }

                echo implode("\t", $data[$key]). "\r\n";
            }

        }

    }

}