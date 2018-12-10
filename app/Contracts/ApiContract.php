<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/12/10
 * Time: 20:12
 */

namespace App\Contracts;


interface ApiContract
{
    /**
     * @description  post
     * @author       lujiang
     *
     * @param array  $params
     * @param string $method
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function post(array $params, string $method);

    /**
     * @description  get
     * @author       lujiang
     *
     * @param array  $params
     * @param string $method
     *
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $params, string $method);

    /**
     * @description  url
     * @author       lujiang
     *
     * @param $method
     *
     * @return mixed
     *
     */
    public function getUrl($method);

    /**
     * @description  header
     * @author       lujiang
     *
     *
     * @return mixed
     *
     */
    public function getHeader();
}