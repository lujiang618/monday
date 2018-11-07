<?php
/**
 * Created by PhpStorm.
 * User: big fish
 * Date: 2018/9/15
 * Time: 11:46
 */

namespace App\Services;

use App\Contracts\CaptchaContract;
use Illuminate\Support\Facades\Redis;
use Mews\Captcha\Facades\Captcha;

class CaptchaService implements CaptchaContract
{
    /**
     * @deprecated 图片验证码使用样式，string型
     *
     */
    private $theme = 'default';

    /**
     * @deprecated 图片验证码在redis中的过期时间，int型
     *
     */
    private $expires = 300;

    /**
     * @deprecated   获取图片验证码
     * @author       lujiang
     *
     *
     * @return array
     */
    public function get() : array
    {
        $data = Captcha::create($this->theme, true);

        Redis::setex($data['key'], $this->expires, true);

        return $data;
    }

    /**
     * @deprecated   校验图片验证 (1. 先校验key在redis内是否有效，2.校验验证码）
     * @author       lujiang
     *
     * @param string $value
     * @param string $key
     *
     * @return bool
     *
     */
    public function check(string $value, string $key) :bool
    {
        if (Redis::get($key)) {
            return Captcha::check_api($value, $key);
        }

        return false;
    }
}
