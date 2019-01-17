<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2019/1/17
 * Time: 10:49
 */

namespace App\Supports\crypt;


class PasswordHelper
{
    /**
     * @description  对密码进行MD5加密,  加盐可以降低破解率
     * 1. md5(md5($passwd).$salt)
     * 2. md5(md5($passwd.$salt))
     * 3. md5(md5($passwd.$salt).$salt)
     *
     * @author       lujiang
     *
     * @param $password
     *
     * @return string
     *
     */
    public function getPasswordByMd5($password) {
        $salt = config('app.password_salt');
        return  md5(md5($password).$salt);
    }
}