<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/4/15
 * Time: 下午5:26
 * Desc: 时间工具类
 */

namespace App\Tools;

use Carbon\Carbon;


class ToolTime{


    /**
     * @return bool|string
     * @desc 获取时分秒时间
     */
    public static function dbNow()
    {

        return date('Y-m-d H:i:s',time());

    }

    /**
     * @return bool|string
     * @desc 获取日期时间
     */
    public static function dbDate()
    {

        return date('Y-m-d', time());

    }

    /**
     * @param int $day
     * @return bool|string
     * @desc 获取当前时间前几天，默认返回昨天
     */
    public static function getDateBeforeCurrent($day=1)
    {
        return date("Y-m-d",strtotime("-".$day." day"));
    }

    /**
     * @param int $day
     * @return bool|string
     * @desc 获取当前时间后几天,默认返回明天
     */
    public static function getDateAfterCurrent($day=1)
    {
        return date("Y-m-d",strtotime("+".$day." day"));
    }

    /**
     * @param $startTime
     * @param $endTime
     * @return float
     * @desc 比较2个时间相差天数
     */
    public static function getDayDiff($startTime, $endTime)
    {

        $startTime = date('Y-m-d',strtotime($startTime));

        $endTime = date('Y-m-d',strtotime($endTime));

        $startTime = Carbon::parse($startTime);

        $endTime = Carbon::parse($endTime);

        $diffRes = $startTime->diffInDays($endTime);

        return $diffRes;

    }

    /**
     * @param $dateTime
     * @return bool|string
     * @desc 获取某个时间的日期,返回无时间日期
     */
    public static function getDate( $dateTime ){

        return date("Y-m-d",strtotime($dateTime));

    }

    /**
     * @param $dateTime
     * @return bool|string
     * @desc 获取某个完整时间的小时:分钟,返回无日期时间
     */
    public static function getHourMinute($dateTime){
        return date("H:i",strtotime($dateTime));
    }

    /**
     * @param $startTime
     * @param $endTime
     * @return bool|string
     * @desc 下个月还款日跨月（如1.31 加上一个月会跨入到3月) 去掉跨出部分
     */
    public static function getNextMonthDate($startTime, $endTime){

        $startTime  = strtotime($startTime);
        $endTime    = strtotime($endTime);

        //月末可能导致跨月的处理
        if(date('d', $startTime) != date('d', $endTime)) {   //下个月还款日跨月（如1.31 加上一个月会跨入到3月）
            $endTime = strtoTime(sprintf('-%s day', date('d', $endTime)), $endTime);   //去掉跨出部分
        }

        return date('Y-m-d', $endTime);

    }


    /**
     * @param $days
     * @param $date
     * @return bool|string
     * @desc 获取某个时间的后几天
     */
    public static function getAddDateByDays( $days, $date){

        return date("Y-m-d", strtotime(" +$days days", strtotime($date)));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取月第一天
     */
    public static function getMonthFirstDay($date='')
    {

        $date = $date ? $date : self::dbDate();

        return date('Y-m-01', strtotime($date));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取月最后一天
     */
    public static function getMonthLastDay($date='')
    {

        $date = $date ? $date : self::dbDate();

        return date('Y-m-t', strtotime($date));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取年第一天
     */
    public static function getYearFirstDay($date=''){

        $date = $date ? $date : self::dbDate();

        return date('Y-01-01', strtotime($date));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取年最后一天
     */
    public static function getYearLastDay($date=''){

        $date = $date ? $date : self::dbDate();

        return date('Y-12-t', strtotime($date));

    }

    /**
     * @param int $num
     * @param string $date
     * @return bool|string
     * @desc 获取几年后的今天
     */
    public static function getAfterYearDay( $num=1, $date=''){

        $date = $date ? $date : self::dbDate();

        return date('Y-m-d', strtotime(" +$num year", strtotime($date)));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取年
     */
    public static function getYear( $date='' ){

        $date = $date ? $date : self::dbDate();

        return date('Y', strtotime($date));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取月
     */
    public static function getMonth( $date='' ){

        $date = $date ? $date : self::dbDate();

        return date('n', strtotime($date));

    }

    /**
     * @param string $date
     * @return bool|string
     * @desc 获取年月
     */
    public static function getYearMonth( $date = ''){

        $date = $date ? $date : self::dbDate();

        return date('Y-n', strtotime($date));

    }

    /**
     * 获取时间差
     * @param $end_date
     * @param bool|true $now
     * @return array
     */
    public static function getDateDiff($end_date,$now = true){

        if($now == true){

            $dateNow = new \DateTime('now');

        }else{

            $dateNow = new \DateTime($now);
        }

        $dateEnd = new \DateTime($end_date);

        $diff    = $dateNow->diff($dateEnd);

        return (array)$diff;

    }

    /**
     * 获取距离某一时间过去表达式
     * @param $end_date
     * @param bool|true $now
     * @return string
     */
    public static function intervalTime($end_date,$now = true){

        $diff = self::getDateDiff($end_date,$now);

        $interval = '';

        if($diff['y'] != 0){$interval .= $diff['y'].'年';}
        if($diff['m'] != 0){$interval .= $diff['m'].'月';}
        if($diff['d'] != 0){$interval .= $diff['d'].'天';}
        if($diff['h'] != 0){$interval .= $diff['h'].'小时';}
        if($diff['i'] != 0){$interval .= $diff['i'].'分钟';}
        if($diff['s'] != 0){$interval .= $diff['s'].'秒';}

        return $interval;
    }

    /*
     * 获取指定时间的时间戳
     * @param $date
     * @return int
     */
    public static function getUnixTime( $date ,$type='start')
    {

        switch ($type){
            case 'start':
                $date       =   date("Y-m-d",strtotime($date));
                $unixTime   =   strtotime($date." 00:00:00");
                break;
            case 'end':
                $date       =   date("Y-m-d",strtotime($date));
                $unixTime   =   strtotime($date." 23:59:59");
                break;
            default:
                $unixTime   =   strtotime($date);
                break;
        }
        return $unixTime;
    }
}