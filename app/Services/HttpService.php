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

class HttpService implements HttpContract
{
    private $timeout = '10';
    private $url;
    private $client;
    private $header;

    public function __construct() {
        $this->client = $this->getClient();
    }

    /**
     * @deprecated   GET 方式请求
     * @author       lujiang
     *
     * @param array $params
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
     * @param array $params
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
            $response = $this->getClient()->request($mode, $this->getUrl(), $this->getOptions());

            $result = $this->getData($response);

            $this->writeLog($params, $response);

            return $result;
        } catch (\Exception $e) {
            $this->writeLog($params, ['error-info' => $e->getMessage()], 'error');

            return ['erorrInfo' => $e->getMessage()];
        }
    }

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
    public function writeLog(array $request, array $response, string $type = 'info') {
        $logger = new LoggerService('third');
        $data   = [
            'url'      => $this->getUrl(),
            'request'  => $request,
            'response' => $response,
        ];

        $logger->write($data, $type);

        return true;
    }

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
    public function init(string $url, array $header, int $timeout = 0) : bool {
        $this->setUrl($url);
        $this->setHeader($header);

        $this->setTimeout($timeout);

        return true;
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
     * @description  设置接口要访问的url
     * @author       lujiang
     *
     * @param string $url
     *
     *
     */
    public function setUrl(string $url) {
        $this->url = $url;
    }

    /**
     * @deprecated   获取请求头
     * @author       lujiang
     *
     *
     * @return array
     *
     */
    public function getHeader() : array {
        return $this->header;
    }

    /**
     * @description  设置header
     * @author       lujiang
     *
     * @param array $header
     *
     * @return bool
     *
     */
    public function setHeader(array $header) : bool {
        $this->header = $header;

        return true;
    }

    /**
     * @description
     * @author       lujiang
     *
     * @param int $timeout
     *
     * @return bool
     *
     */
    public function setTimeout(int $timeout) : bool {
        if ($timeout > 0) {
            $this->timeout = $timeout;
        }

        return true;
    }

    /**
     * @description
     * @author       lujiang
     *
     *
     * @return int
     *
     */
    public function getTimeout() : int {
        return $this->timeout;
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
        $client = new Client(['timeout' => $this->getTimeout()]);

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
