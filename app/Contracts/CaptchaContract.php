<?php
/**
 * Created by PhpStorm.
 * User: big fish
 * Date: 2018/9/15
 * Time: 11:46
 */

namespace App\Contracts;


interface CaptchaContract
{
    /**
     * @deprecated   获取图片验证码
     * @author       lujiang
     *
     *
     * @return array
     *
     */
    public function get(): array ;

    /**
     * @deprecated   校验图片验证
     * @author       lujiang
     *
     * @param string $value
     * @param string $key
     *
     * @return bool
     *
     */
    public function check(string $value, string $key) :bool;
}