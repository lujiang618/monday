<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29
 * Time: 14:45
 */

namespace App\Contracts;


interface LoggerContract
{
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
    public function write(array $message, string $type = 'info') : bool;
}