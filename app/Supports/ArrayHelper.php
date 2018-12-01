<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/12/1
 * Time: 12:19
 */

namespace App\Supports;


class ArrayHelper
{


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
}