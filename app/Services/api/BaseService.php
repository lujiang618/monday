<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/12/10
 * Time: 20:10
 */

namespace App\Services\api;


use App\Contracts\ApiContract;
use App\Contracts\HttpContract;

class BaseService implements ApiContract
{
    protected $baseUrl;
    protected $timeout    = 5;
    protected $defaultMsg = '';
    protected $name       = '';
    protected $httpClient = '';

    protected $method = [];

    /**
     * BaseService constructor.
     *
     * @param HttpContract $httpClient
     */
    public function __construct(HttpContract $httpClient) {
        $config = config('api.'.$this->name);

        $this->baseUrl = $config['baseUrl'];
        $this->method  = $config['method'];

        $this->httpClient = $httpClient;
    }

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
     */
    public function post(array $params, string $method) : array {
        $this->httpClient->init($this->getUrl($method), $this->getHeader());
        
        $result = $this->httpClient->post($params);

        return $result;
    }

    /**
     * @description  get
     * @author       lujiang
     *
     * @param array  $params
     * @param string $method
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $params, string $method) : array {
        $this->httpClient->init($this->getUrl($method), $this->getHeader());

        $result = $this->httpClient->get($params);

        return $result;
    }

    /**
     * @description  url
     * @author       lujiang
     *
     * @param $method
     *
     * @return string
     *
     */
    public function getUrl($method) {
        $url = $this->baseUrl.$this->method[$method];

        return $url;
    }

    /**
     * @description  header
     * @author       lujiang
     *
     *
     * @return array
     *
     */
    public function getHeader() {
        return [
            "Content-Type: application/json",
            "Accept: application/json",
        ];
    }
}