<?php
/**
 * Created by PhpStorm.
 * User: lujiang
 * Date: 2018/9/27
 * Time: 19:05
 */

namespace App\Supports\Heplers;


use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerService
{
    private $dateFormat = 'Y-m-d H:i:s';
    private $logger;
    private $path;

    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        //'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        //'notice'    => Logger::NOTICE,
        //'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        //'critical'  => Logger::CRITICAL,
        //'alert'     => Logger::ALERT,
        //'emergency' => Logger::EMERGENCY,
    ];

    /**
     * LoggerService constructor.
     *
     * @param string $name
     * @param string $path
     *
     * @throws \Exception
     */
    public function __construct(string $name, string $path='third') {
        $this->logger = new Logger($name);
        $fileName     = date('Ymd').'.log';
        $this->path   = storage_path($path.DIRECTORY_SEPARATOR.$fileName);

        $output    = "[%datetime%]  %channel%.%level_name% : %message%\n";
        $formatter = new LineFormatter($output, $this->dateFormat, true, true);
        $stream    = new StreamHandler($this->path, Logger::DEBUG);

        $stream->setFormatter($formatter);

        $this->logger->pushHandler($stream);
    }

    /**
     * @deprecated   写日志
     * @author       lujiang
     *
     * @param array  $message
     * @param string $type
     *
     * @return bool
     *
     */
    public function write(array $message, string $type = 'info') : bool
    {

        if (!in_array($type, array_keys($this->levels))) {
            return false;
        }

        $message = json_encode($message, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

        $status  = $this->$type($message);

        return $status;
    }

    /**
     * @deprecated   info level的log
     * @author       lujiang
     *
     * @param string $message
     *
     * @return bool
     *
     */
    public function info(string $message) : bool
    {
        $status = $this->logger->info($message);

        return $status;
    }

    /**
     * @deprecated   error level的log
     * @author       lujiang
     *
     * @param string $message
     *
     * @return bool
     *
     */
    public function error(string $message) : bool
    {
        $status = $this->logger->error($message);

        return $status;
    }

}