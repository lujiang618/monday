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