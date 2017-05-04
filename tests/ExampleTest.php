<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        
        
        //注册
        /*$register = \DB::connection('mysql_9douyu')
            ->table('core_user')
            ->select(\DB::raw('count(DISTINCT id) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as times'))
            ->groupBy('times')
            ->get();

        $this->doAdd('register', $register);

        //活期
        $currentInvest = \DB::connection('mysql_9douyu')
            ->table('module_current_invest')
            ->select(\DB::raw('count(DISTINCT user_id) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as times'))
            ->where('type', 400)
            ->groupBy('times')
            ->get();

        $this->doAdd('current', $currentInvest);

        //定期投资
        $investProject = \DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->select(\DB::raw('count(DISTINCT user_id) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as times'))
            ->groupBy('times')
            ->get();

        $this->doAdd('project', $investProject);

        //充值成功
        $recharge = \DB::connection('mysql_9douyu')
            ->table('core_order')
            ->select(\DB::raw('count(DISTINCT user_id) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as times'))
            ->where('type', 1)
            ->where('status', 200)
            ->groupBy('times')
            ->get();

        $this->doAdd('recharge', $recharge);

        //提现成功
        $withdraw = \DB::connection('mysql_9douyu')
            ->table('core_order')
            ->select(\DB::raw('count(DISTINCT user_id) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as times'))
            ->where('type', 2)
            ->where('status', 200)
            ->groupBy('times')
            ->get();

        $this->doAdd('withdraw', $withdraw);

        //回款金额
        $refund = \DB::connection('mysql_9douyu')
            ->table('core_refund_record')
            ->select(\DB::raw('count(DISTINCT user_id) as total, times'))
            ->where('status', 200)
            ->groupBy('times')
            ->get();

        $this->doAdd('refund', $refund);

        //1月期
        $projectOne = DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->join('core_project', 'core_invest.project_id', '=', 'core_project.id')
            ->select(\DB::raw('count(DISTINCT core_invest.user_id) as total, DATE_FORMAT(core_invest.created_at, "%Y-%m-%d") as times'))
            ->where('core_project.product_line', 100)
            ->where('core_project.type', 1)
            ->groupBy('times')
            ->get();

        $this->doAdd('project_one', $projectOne);

        //3月期
        $projectThree = DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->join('core_project', 'core_invest.project_id', '=', 'core_project.id')
            ->select(\DB::raw('count(DISTINCT core_invest.user_id) as total, DATE_FORMAT(core_invest.created_at, "%Y-%m-%d") as times'))
            ->where('core_project.product_line', 100)
            ->where('core_project.type', 3)
            ->groupBy('times')
            ->get();

        $this->doAdd('project_three', $projectThree);

        //6月期
        $projectSix = DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->join('core_project', 'core_invest.project_id', '=', 'core_project.id')
            ->select(\DB::raw('count(DISTINCT core_invest.user_id) as total, DATE_FORMAT(core_invest.created_at, "%Y-%m-%d") as times'))
            ->where('core_project.product_line', 100)
            ->where('core_project.type', 6)
            ->groupBy('times')
            ->get();

        $this->doAdd('project_six', $projectSix);

        //12月期
        $projectTwelve = DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->join('core_project', 'core_invest.project_id', '=', 'core_project.id')
            ->select(\DB::raw('count(DISTINCT core_invest.user_id) as total, DATE_FORMAT(core_invest.created_at, "%Y-%m-%d") as times'))
            ->where('core_project.product_line', 100)
            ->where('core_project.type', 12)
            ->groupBy('times')
            ->get();

        $this->doAdd('project_twelve', $projectTwelve);

        //jax
        $projectJax = DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->join('core_project', 'core_invest.project_id', '=', 'core_project.id')
            ->select(\DB::raw('count(DISTINCT core_invest.user_id) as total, DATE_FORMAT(core_invest.created_at, "%Y-%m-%d") as times'))
            ->where('core_project.product_line', 200)
            ->groupBy('times')
            ->get();

        $this->doAdd('project_jax', $projectJax);

        //sdf
        $projectSdf = DB::connection('mysql_9douyu')
            ->table('core_invest')
            ->join('core_project', 'core_invest.project_id', '=', 'core_project.id')
            ->select(\DB::raw('count(DISTINCT core_invest.user_id) as total, DATE_FORMAT(core_invest.created_at, "%Y-%m-%d") as times'))
            ->where('core_project.product_line', 300)
            ->groupBy('times')
            ->get();

        $this->doAdd('project_sdf', $projectSdf);*/


        /*$logic = new \App\Logics\Stats\UserLogic('2016-05-01', '2016-05-08');

        $res = $logic->getOperateGroupByTimes();

        var_dump($res);die;*/
    }


    /*public function doAdd($field, $data){

        foreach ( $data as $item ){

            $query = "INSERT INTO stat_user ({$field}, times) VALUES ('{$item->total}', '{$item->times}') ON DUPLICATE KEY UPDATE {$field}={$item->total}";

            $res = \DB::statement($query);

            if( !$res ){

                \Log::Error(__METHOD__.'Error', [$query]);

            }

        }

    }*/

}
