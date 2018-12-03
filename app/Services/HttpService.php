<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/10/10
 * Time: 17:10
 */

namespace App\Services;

use App\Contracts\HttpContract;
use App\Supports\Heplers\LoggerService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Session;

class HttpService implements HttpContract
{
    private $timeout = '10';
    private $client;
    private $url;

    public function __construct(string $url) {
        $this->client = $this->getClient();
        $this->url    = $url;
    }

    /**
     * @deprecated   GET 方式请求
     * @author       lujiang
     *
     * @param array  $params
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $params) : array {
        $response = $this->request($params, 'GET');

        return $this->getData($response);
    }

    /**
     * @deprecated   POST 方式请求
     * @author       lujiang
     *
     * @param array $params
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(array $params) : array {
        $response = $this->request($params, 'post');

        return $this->getData($response);
    }

    /***
     * @deprecated   PUT 方式请求
     * @author       lujiang
     *
     * @param array  $params
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(array $params) : array {
        $response = $this->request($params, 'put');

        return $this->getData($response);
    }

    /**
     * @description
     * @author       lujiang
     *
     * @param array  $params
     * @param string $mode
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(array $params, string $mode = 'post') {
        try {
            $response = $this->getClient()->request($mode, $this->getUrl, $this->getOptions());

            $result = $this->getData($response);

            $logger = new LoggerService('third');
            $logger->write([
                'url'      => $this->getUrl(),
                'request'  => $params,
                'response' => $response,
            ]);

            return $result;
        } catch (\Exception $e) {

            $logger = new LoggerService('third');
            $logger->write([
                'url'      => $this->getUrl(),
                'request'  => $params,
                'response' => $e->getMessage(),
            ]);

            return ['erorrInfo' => $e->getMessage()];
        }
    }

    /**
     * @description
     * @author       lujiang
     *
     * @param array  $params
     * @param string $mode
     *
     * @return array
     *
     */
    public function getOptions(array $params, string $mode = 'post') {
        $options = [
            'headers' => $this->getHeader(),
        ];

        if (strtolower($mode) == 'get') {
            $options['query'] = $params;
        } else {
            $options['json'] = $params;
        }

        return $options;
    }

    /**
     * @description
     * @author       lujiang
     *
     *
     * @return string
     *
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @deprecated   获取请求头
     * @author       lujiang
     *
     *
     * @return array
     *
     */
    private function getHeader() : array {
        if (Session::get('token')) {
            return [
                'Authorization' => 'JWT '.Session::get('token'),
                'Content-Type'  => 'application/json',
            ];
        }

        return ['Content-Type' => 'application/json',];
    }

    /**
     * @deprecated   获取guzzle客户端
     * @author       lujiang
     *
     *
     * @return Client
     *
     */
    private function getClient() : Client {
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
    private function getData(Response $response) : array {
        $code   = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        $data = [];
        if ($code === 200) {
            $data = json_decode($response->getBody()->getContents(), true);
        } else {
            $data = ['reason' => $reason];
        }

        return (array) $data;
    }
}
