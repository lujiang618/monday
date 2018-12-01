<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/12/1
 * Time: 12:19
 */

namespace App\Supports;


class DateHelper
{
    /**
     * @description   本周开始
     * @author        lujiang
     *
     *
     * @return false|float|int
     *
     */
    public static function getWeekStartTime() {
        $currentTime = strtotime(date('Y-m-d'));
        $nowDay      = date('w', $currentTime);
        $weekStart   = $currentTime - ($nowDay - 1) * 60 * 60 * 24;

        return $weekStart;
    }

    /**
     * @description  本周最后
     * @author       lujiang
     *
     *
     * @return false|float|int
     *
     */
    public static function getWeekEndTime() {
        $currentTime = strtotime(date('Y-m-d').' 23:59:59');
        $nowDay      = date('w', $currentTime) == 0 ? 7 : date('w', $currentTime);
        $weekEnd     = $currentTime + (7 - $nowDay) * 24 * 3600;

        return $weekEnd;
    }

    private function todo() {
        //本周一
        echo date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)); //w为星期几的数字形式,这里0为周日

        //本周日
        echo date('Y-m-d', (time() + (7 - (date('w') == 0 ? 7 : date('w'))) * 24 * 3600)); //同样使用w,以现在与周日相关天数算

        //上周一
        echo date('Y-m-d', strtotime('-1 monday', time())); //无论今天几号,-1 monday为上一个有效周未

        //上周日
        echo date('Y-m-d', strtotime('-1 sunday', time())); //上一个有效周日,同样适用于其它星期

        //本月一日
        echo date('Y-m-d', strtotime(date('Y-m', time()).'-01 00:00:00')); //直接以strtotime生成

        //本月最后一日
        echo date('Y-m-d', strtotime(date('Y-m', time()).'-'.date('t', time()).' 00:00:00')); //t为当月天数,28至31天

        //上月一日
        echo date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m', time()).'-01 00:00:00'))); //本月一日直接strtotime上减一个月

        //上月最后一日
        echo date('Y-m-d', strtotime(date('Y-m', time()).'-01 00:00:00') - 86400); //本月一日减一天即是上月最后一日
    }
}