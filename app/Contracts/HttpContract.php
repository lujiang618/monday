<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/10/10
 * Time: 17:38
 */

namespace App\Contracts;

interface HttpContract
{
    /**
     * @description  设置请求的url
     * @author       lujiang
     *
     * @param string $url
     *
     * @return mixed
     *
     */
    public function setUrl(string $url);

    /**
     * @deprecated   GET 方式请求
     * @author       lujiang
     *
     * @param array  $queryParams
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $queryParams) :array;

    /**
     * @deprecated   POST 方式请求
     * @author       lujiang
     *
     * @param array  $params
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post( array $params) : array;

    /***
     * @deprecated   PUT 方式请求
     * @author       lujiang
     *
     * @param array  $prams
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(array $prams) : array;

    /**
     * @description  写日志
     * @author       lujiang
     *
     * @param array  $request
     * @param array  $response
     * @param string $type
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function writeLog(array $request, array $response,string $type = 'info');

    /**
     * @description  init
     * @author       lujiang
     *
     * @param string $url
     * @param array  $header
     * @param int    $timeout
     *
     * @return bool
     *
     */
    public function init(string $url, array $header, int $timeout) : bool;

    /**
     * @description
     * @author       lujiang
     *
     * @param int $timeout
     *
     * @return bool
     *
     */
    public function setTimeout(int $timeout) : bool;

    /**
     * @description
     * @author       lujiang
     *
     *
     * @return int
     *
     */
    public function getTimeout() : int;
}
