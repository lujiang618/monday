<?php

namespace Tests\Unit;

use App\Services\CaptchaService;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaptchaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * @deprecated   获取图片验证码测试用例
     * @author       lujiang
     *
     *
     *
     */
    public function testGet() {
        $captchaService = new CaptchaService();

        $capatch = $captchaService->get();

        $this->assertArrayHasKey('key',$capatch);
        $this->assertArrayHasKey('img',$capatch);
    }

    /**
     * @deprecated   校验图片验证码测试用例
     * @author       lujiang
     *
     * @param string $value
     * @param string $key
     * @param bool   $expect
     *
     * @dataProvider checkProvider()
     */
    public function testCheck(string $value, string $key, bool $expect)
    {
        $captchaService = new CaptchaService();

        $result = $captchaService->check($value,$key);

        $this->assertEquals($expect,$result);
    }

    public function checkProvider() {
        return [
            // 正确
            'correct' => ['9bgd','$2y$10$VGlQB810Iz3YZBgHuN0lmeauw.IXZT2UZJRUIU7ik35FFvjCCRjK.',true],
            //错误
            'error' => ['9999','$2y$10$VGlQB810Iz3YZBgHuN0lmeauw.IXZT2UZJRUIU7ik35FFvjCCRjK.',false],
        ];
    }
}
