<?php

namespace Tests\Unit;

use App\Services\CaptchaService;
use App\Services\MessageService;
use App\Services\WechatService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    private $service;
    public function __construct(string $name = null, array $data = [], string $dataName = '') {
        parent::__construct($name, $data, $dataName);

        $this->service = new MessageService(new CaptchaService(), new WechatService());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSendRegSuccess() {
        $mobile = '15000502790';
        $openId = '15000502790';
        $name   = 'gelu';

        $status = $this->service->sendRegSuccess($mobile,$openId,$name);

        $this->assertEquals(true,$status);
    }

    public function testSendRegCode() {
        $mobile   = '15000502790';
        $key      = '15000502790';
        $captcha  = 'gelu';
        $platform = 2;

        $result = $this->service->sendRegCode($mobile,$key,$captcha,$platform);

        $this->assertArrayHasKey('status',$result);
        $this->assertEquals(true,$result['status']);
    }

    /**
     * @deprecated   校验短信验证码的测试用例
     * @author       lujiang
     *
     * @param string $mobile
     * @param int    $code
     * @param bool   $expect
     *
     * @dataProvider checkProvider
     */
    public function testCheck(string $mobile,int $code, bool $expect) {

        $result = $this->service->check($mobile,$code);

        $this->assertEquals($expect, $result);
    }

    public function checkProvider () {
        return [
           'correct' => ['15000502790',123456,true],
           'error' => ['15000502790',111111,true],
        ];
    }
}
