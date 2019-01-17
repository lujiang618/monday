<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2019/1/17
 * Time: 10:40
 */

namespace App\Supports\crypt;


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