<?php
/**
 * Created by PhpStorm.
 * User: big fish
 * Date: 2018/9/3
 * Time: 16:35
 */

namespace App\Services;


use App\Contracts\ResponseContract;
use Illuminate\Http\Response;

/**
 * @deprecated   通用响应类
 * @package      com.uuabc
 * @category
 * @author       lujiang
 * @version      1.0
 *
 */
class ResponseService implements ResponseContract
{
    const CONTENT_TYPE = 'application/json';

    private $response;

    /**
     * @deprecated   请求成功时的response格式
     * @author       lujiang
     *
     * @param string $msg
     * @param array  $data
     *
     * @return Response
     *
     */
    public function success(array $data = [], string $msg = "OK") :Response
    {
        $result = [
            "errcode" => 0,
            "msg"     => $msg,
            "data"    => $data,
        ];

        $this->generateResponse($result);

        return $this->response;
    }

    /**
     * @deprecated   请求失败时的response格式
     * @author       lujiang
     *
     * @param int $code
     * @param string $msg
     *
     * @return Response
     *
     */
    public function error(int $code, string $msg = '') : Response
    {
        $result = [
            "errcode" => $code,
            "msg"     => $msg ? $msg: $this->getMsgByCode($code),
            "data"    => [],
        ];

        $this->generateResponse($result);

        return $this->response;
    }

    /**
     * @deprecated   请求参数错误
     * @author       lujiang
     *
     *
     * @return Response
     *
     */
    public function inputError():Response
    {
        return $this->error(100500001);
    }

    /**
     * @deprecated   系统内部错误
     * @author       lujiang
     *
     * @param int    $code
     * @param string $msg
     *
     * @return Response
     *
     */
    public function internalError(int $code = 100500000, string $msg = '') : Response
    {
        return $this->error($code, $msg);
    }

    /**
     * @deprecated   通过errcode获取对应的提示
     * @author       lujiang
     *
     * @param $code
     *
     * @return \Illuminate\Config\Repository|mixed
     *
     */
    private function getMsgByCode($code) {
        return config('errorcode.'.$code);
    }

    /**
     * @deprecated   生成要响应的response
     * @author       lujiang
     *
     * @param array $result
     *
     *
     */
    private function generateResponse(array $result)
    {
        $this->setResponse($result);
        $this->setContentType();
    }

    /**
     * @deprecated   获取response
     * @author       lujiang
     *
     * @param array $result
     *
     *
     */
    private function setResponse(array $result)
    {
        $this->response = response($result);
    }

    /**
     * @deprecated   设置Content-Type为application/json
     * @author       lujiang
     *
     *
     */
    private function setContentType()
    {
        $this->response->header('Content-Type', self::CONTENT_TYPE);
    }

}