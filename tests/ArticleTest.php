<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/11/15
 * Time: 下午3:55
 * Desc: 文章相关测试用例
 */

class ArticleTest extends TestCase{


    public function additionProvider()
    {

        $str = 'CBM5314A-LF|2.7to5.5V,2,10kHz,750uA,250,105,100,LFCSP-10
CBM5314A-M|2.7to5.5V,2,10kHz,750uA,250,105,100,MSOP-10
CBM5314B-LF|2.7to5.5V,2,10kHz,750uA,250,105,100,LFCSP-10
CBM5314B-M|2.7to5.5V,2,10kHz,750uA,250,105,100,MSOP-10
CBM5324A-LF|2.7to5.5V,2,10kHz,750uA,250,105,100,LFCSP-10
CBM5324A-M|2.7to5.5V,2,10kHz,750uA,250,105,100,MSOP-10
CBM5324B-LF|2.7to5.5V,2,10kHz,750uA,250,105,100,LFCSP-10
CBM5324B-M|2.7to5.5V,2,10kHz,750uA,250,105,100,MSOP-10
CBM5324S-M|2.7to5.5V,2,10kHz,750uA,250,105,100,MSOP-10
CBM108S085CT-TS|2.7to5.5V,2,10kHz,750uA,250,105,100,TSSOP-16
CBM108S085CQ-QF|2.7to5.5V,2,10kHz,750uA,250,105,100,WQFN-16
CBM128S085CT-TS|2.7to5.5V,2,10kHz,750uA,250,105,100,TSSOP-16
CBM128S085CQ-QF|2.7to5.5V,2,10kHz,750uA,250,105,100,WQFN-16';

        return $str;


        /*return [
            [
                'title'     => '标题-',
                'content'   => '内容',
                'json_value'=> json_encode([str_random(3), str_random(5), str_random(2)])
            ]
        ];
        /**
     * @dataProvider additionProvider
     */

    }


    public function testAdd()
    {

        $str = 'QLM811H-Q|2.7to5.5V,2,10kHz,750uA,250,105,100,LQFP-48';

        $arr = explode("\n", $str);


        $logic = new \App\Logics\ArticleLogic();

        foreach ( $arr as $value ){

            $c = explode('|', $value);

            $data = [
                'title'         => $c[0],
                'content'       => $c[0],
                'cat_id'        => 14,
                'json_value'    => json_encode(explode(',', $c[1]))
            ];

            $result = $logic->doAddOrUpdate($data);


            $this->assertEquals(200, $result['code']);

        }


    }

    /*public function testGetList(){

        $logic = new \App\Logics\ArticleLogic();

        $res['data'] = $logic->getListByWhere(['cat_id' => 1, 'size'=> 1]);

        print_r($res['data']);

    }*/



}