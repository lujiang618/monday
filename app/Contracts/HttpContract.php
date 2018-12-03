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
}
