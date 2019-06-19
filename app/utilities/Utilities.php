<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 11/18/17
 * Time: 12:34 AM
 */

namespace AitsNetidAssignment\utilities;


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

        // todo - Reference the current Composer project installation instead, if available
        $errorLog->pushHandler(new StreamHandler(__DIR__ . '/../../' . $_ENV['AITS_NETID_ASSIGNMENT_DATA_LOG_RELATIVE_PATH'] . '/' . $_ENV['AITS_NETID_ASSIGNMENT_DATA_LOG_FILE_PREFIX'] . 'error.log', constant('Monolog\Logger::' . strtoupper($level))));
        $errorLog->{$level}($message);

    }

    /**
     * Method used to check if running in CLI
     * https://stackoverflow.com/questions/933367/php-how-to-best-determine-if-the-current-invocation-is-from-cli-or-web-server
     *
     * @return bool
     */
    public static function is_cli()
    {
        if ( defined('STDIN') )
        {
            return true;
        }

        if ( php_sapi_name() === 'cli' )
        {
            return true;
        }

        if ( array_key_exists('SHELL', $_ENV) ) {
            return true;
        }

        if ( empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0)
        {
            return true;
        }

        if ( !array_key_exists('REQUEST_METHOD', $_SERVER) )
        {
            return true;
        }

        return false;
    }

}