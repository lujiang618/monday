<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2019/1/17
 * Time: 10:44
 */

namespace App\Supports;


class IntegerHelper
{
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