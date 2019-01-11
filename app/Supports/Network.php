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

    /**
     * @description  获取客户端请求的IP
     * @author       lujiang
     *
     *
     * @return array|false|string
     *
     */
    public static function getRequestIP()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            return getenv("HTTP_CLIENT_IP");
        }

        if(getenv("HTTP_X_FORWARDED_FOR")) {
            return getenv("HTTP_X_FORWARDED_FOR");
        }

        if(getenv("REMOTE_ADDR")) {
            return  getenv("REMOTE_ADDR");
        }

        return '';
    }
}