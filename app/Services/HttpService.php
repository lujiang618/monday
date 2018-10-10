<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/10/10
 * Time: 17:10
 */

namespace App\Services;


use App\Contracts\HttpContract;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Session;

class HttpService implements HttpContract
{
    private $timeout = '10';
    private $client;

    public function __construct() {
        $this->client = $this->getClient();
    }

    /**
     * @deprecated   GET 方式请求
     * @author       lujiang
     *
     * @param string $url
     * @param array  $queryParams
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $url, array $queryParams) :array
    {
        $response = $this->getClient()->request('GET', $url, [
            'query'   => $queryParams,
            'headers' => $this->getHeader(),
        ]);

        return $this->getData($response);
    }

    /**
     * @deprecated   POST 方式请求
     * @author       lujiang
     *
     * @param string $url
     * @param array  $params
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $url, array $params) : array
    {
        try {
            $response = $this->client->request('post', $url, [
                'json' => $params,
                'headers' => $this->getHeader(),
            ]);

            return $this->getData($response);
        } catch (\Exception $e) {
            return ['erorrInfo'=>$e->getMessage()];
        }

    }

    /***
     * @deprecated   PUT 方式请求
     * @author       lujiang
     *
     * @param string $url
     * @param array  $prams
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(string $url, array $prams) : array
    {
        $response = $this->getClient()->request('put', $url, [
            'json' => $prams,
            'headers' => $this->getHeader(),
        ]);

        return $this->getData($response);
    }

    /**
     * @deprecated   获取请求头
     * @author       lujiang
     *
     *
     * @return array
     *
     */
    private function getHeader() :array
    {
        if (Session::get('token')) {
            return [
                'Authorization' => 'JWT '.Session::get('token'),
                'Content-Type'  => 'application/json',
            ];
        }

        return ['Content-Type'  => 'application/json',];
    }

    /**
     * @deprecated   获取guzzle客户端
     * @author       lujiang
     *
     *
     * @return Client
     *
     */
    private function getClient() : Client
    {
        $client = new Client(['timeout' => $this->timeout]);

        return $client;
    }

    /**
     * @deprecated   获取请求数据
     * @author       lujiang
     *
     * @param $response
     *
     * @return array
     *
     */
    private function getData(Response $response) : array
    {
        $code   = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        $data = [];
        if ($code === 200) {
            $data = json_decode($response->getBody()->getContents(), true);
        } else {
            $data = ['reason' => $reason];
        }

        return (array)$data;
    }
}