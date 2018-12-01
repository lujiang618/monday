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
}