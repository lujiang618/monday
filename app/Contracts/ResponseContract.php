<?php
/**
 * Created by PhpStorm.
 * User: big fish
 * Date: 2018/9/3
 * Time: 16:31
 */

namespace App\Contracts;


use Illuminate\Http\Response;

interface ResponseContract
{
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
    public function success(array $data, string $msg = "OK") :Response;

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
    public function error(int $code, string $msg = ''):Response;

    /**
     * @deprecated   请求参数错误
     * @author       lujiang
     *
     *
     * @return Response
     *
     */
    public function inputError():Response;

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
    public function internalError(int $code = 100500000, string $msg = ''):Response;
}