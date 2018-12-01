<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/11/14
 * Time: 10:25
 */

namespace helper;


class Utils
{
    /**
     * @description  调试
     * @author       lujiang
     *
     * @param $data
     *
     *
     */
    public static function dd($data) {
        var_dump($data);
        die(1);
    }


    /**
     * @deprecated   重新定义数组索引
     * @author       lujiang
     *
     * @param $rows
     * @param $key
     *
     * @return array
     *
     */
    public static function reIndex($rows, $key) {
        $data = [];

        foreach ($rows as $row) {
            if (empty($row[$key])) {
                continue;
            }
            $data[$row[$key]] = $row;
        }

        return $data;
    }

    /**
     * @description   获取当前时间一周的开启
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
     * @description  本周最后1天
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

    /**
     * @deprecated
     * @author       lujiang
     *
     * @param int $length
     *
     * @return string
     *
     */
    public static function getRandStr($length = 8) {
        $str        = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        $len        = strlen($str) - 1;
        for ($i = 0 ; $i < $length ; $i++) {
            $num        = mt_rand(0, $len);
            $randString .= $str[$num];
        }

        return $randString;
    }

    /**
     * @deprecated
     * @author       lujiang
     *
     * @param int $length
     *
     * @return string
     *
     */
    public static function getRandInt($length = 8) {
        $str        = '123456789';
        $randString = '';
        $len        = strlen($str) - 1;
        for ($i = 0 ; $i < $length ; $i++) {
            $num        = mt_rand(0, $len);
            $randString .= $str[$num];
        }

        return $randString;
    }
}