<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2019/1/17
 * Time: 10:40
 */

namespace App\Supports\crypt;

/**
 * @description
 * @package      com.uuabc
 * @category
 * @author       lujiang
 * @version      1.0
 *
 * laravel的加密解密：https://laravel-china.org/docs/laravel/5.5/encryption/1311
 *
 *
 * 加密思路：token=UrlSafeBase64(AES(data))
 * 1.采用UTF8编码
 * 2.data 为json字符串
 * 3.AES 目前采用的是aes-256-ecb， AES/ECB/PKCS5Padding
 * 4.URLSafeBase64：在base64的基础上进行如下替换
 * 5.原始数据（字符串）：{"id":"123","roles":["TEACHER"],"timestamp":1542426604219} 加密结果：TZ5S-tjemW--7T0_b0wKP5_ao94wCu5IngjoXbfTmOaxuvFDUWj_UoS-yEJd9LCnkoruH1FAgnlWewlvSePHhQ
 *
 */
class TokenHelper
{
    const TOKEN_KEY = '89732617593231204231412833213213';

    /**
     * @description  加密生成token
     * @author       lujiang
     *
     * @param string $data
     *
     * @return bool|string
     *
     */
    public function encryptToken(string $data) {
        // $data = utf8_encode('{"id":"123","roles":["TEACHER"],"timestamp":1542426604219}');

        $data = utf8_encode($data);

        $encrypt = openssl_encrypt($data, "aes-256-ecb",self::TOKEN_KEY, OPENSSL_RAW_DATA, '');

        if ($encrypt == false) {
            return false;
        }

        $token = $this->urlSafeB64encode($encrypt);

        return $token;
    }

    /**
     * @description  解密token
     * @author       lujiang
     *
     * @param string $token
     *
     * @return string
     *
     */
    public function decryptToken(string $token) : string
    {
        $data = $this->urlSafeB64decode($token);

        return openssl_decrypt($data, "aes-256-ecb",self::TOKEN_KEY, OPENSSL_RAW_DATA, '');
    }

    /**
     * @description  base64 编码
     * @author       lujiang
     *
     * @param string $string
     *
     * @return string
     *
     */
    public function urlSafeB64encode(string $string)
    {
        $string = base64_encode($string);
        $data   = str_replace(['+', '/', '='], ['-', '_', ''], $string);

        return $data;
    }

    /**
     * @description  base64 解码
     * @author       lujiang
     *
     * @param string $string
     *
     * @return bool|string
     *
     */
    public function urlSafeB64decode(string $string)
    {
        $data = str_replace(['-', '_'], ['+', '/'], $string);

        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        return base64_decode($data);
    }
}