<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/1
 * Time: 12:10
 */

namespace helper;


class Network
{

    /**
     * @deprecated   生成一个url
     * @author       lujiang
     *
     * @param $url
     * @param $data
     *
     * @return string
     *
     */
    public static function generateUrl($url,$data) {
        if (empty($url)) {
            return $url;
        }

        if (empty($url) || empty($data) || !is_array()) {
            return $url;
        }

        $args = url_encode(http_build_query($data));

        return $url.'?'.$args;
    }
}