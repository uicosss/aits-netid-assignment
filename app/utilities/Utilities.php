<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 11/18/17
 * Time: 12:34 AM
 */

namespace App\Utilities;


use Carbon\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Utilities
{

    /**
     * Method used to save to the error log
     *
     * @param $exception
     * @param $methodName
     *
     */
    public static function SaveToErrorLog($message, $level = 'info', $name='Generic')
    {

        // create a log channel
        $errorLog = new Logger($name);

        // Parse the log level
        switch(strtolower($level)) {
            case 'debug':
                $level = 'debug';
                break;

            case 'notice':
                $level = 'notice';
                break;

            case 'warning':
                $level = 'warning';
                break;

            case 'error':
                $level = 'error';
                break;

            case 'critical':
                $level = 'critical';
                break;

            case 'alert':
                $level = 'alert';
                break;

            case 'emergency':
                $level = 'emergency';
                break;

            case 'info':
            default:
                $level = 'info';

        }

        $errorLog->pushHandler(new StreamHandler(__DIR__ . '/../../' . $_ENV['DATA_LOG_RELATIVE_PATH'] . '/' . $_ENV['DATA_LOG_FILE_PREFIX'] . 'error.log', constant('Monolog\Logger::' . strtoupper($level))));
        $errorLog->{$level}($message);

    }

}