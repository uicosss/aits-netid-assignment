<?php

/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 8/11/2016
 * Time: 11:21 AM
 */

namespace AitsNetidAssignment\utilities;

class core
{
    /**
     * @var
     */
    public $db; // handle of the db connexion

    /**
     * @var
     */
    private static $instance;

    /**
     * core constructor.
     */
    private function __construct()
    {
        // building data source name from config
        $dsn = \AitsNetidAssignment\utilities\config::read('db.driver') .
            ':dbname=' . \AitsNetidAssignment\utilities\config::read('db.basename') .
            ';connect_timeout=15';
        // getting DB user from config
        $user = \AitsNetidAssignment\utilities\config::read('db.user');
        // getting DB password from config
        $password = \AitsNetidAssignment\utilities\config::read('db.password');

        $this->dbh = new \PDO($dsn, $user, $password);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    // others global functions
    /**
     * @param $needle
     * @param $haystack
     * @param bool $strict
     * @return bool
     */
    public static function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && core::in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used to dynamically render an output depending if the output is requested from the browser or from shell
     *
     * @param $array
     */
    public static function dynamicDisplay($array){

        if (!isset($_SERVER['SHELL'])) {
            echo "<pre>";
        }
        print_r($array);
        if (!isset($_SERVER['SHELL'])) {
            echo "</pre>";
        }

    }

    /**
     * Returns a 0 or 1 if $address is valid
     *
     * @param $address
     * @return bool
     */
    public static function isValidEmail($address) {
        if (filter_var($address,FILTER_VALIDATE_EMAIL)==FALSE) {
            return false;
        }
        /* explode out local and domain */
        list($local,$domain)=explode('@',$address);

        $localLength=strlen($local);
        $domainLength=strlen($domain);

        return (
            /* check for proper lengths */
            ($localLength>0 && $localLength<65) &&
            ($domainLength>3 && $domainLength<256) &&
            (
                checkdnsrr($domain,'MX') ||
                checkdnsrr($domain,'A')
            )
        );
    }
    
    public static function debugEmail($address, $message){

        // Headers
        $headers = "Reply-To: AES-IT<oarits@uic.edu>\r\n";
        $headers .= "Return-Path: AES-IT<oarits@uic.edu>\r\n";
        $headers .= "Organization: University of Illinois at Chicago\r\n";
        $headers .= "From: AES-IT<oarits@uic.edu>\r\n";

        mail($address, 'Debug Email', $message, $headers);
        
    }

    /**
     *  An example CORS-compliant method.  It will allow any GET, POST, or OPTIONS requests from any
     *  origin.
     *
     *  In a production environment, you probably want to be more restrictive, but this gives you
     *  the general idea of what is involved.  For the nitty-gritty low-down, read:
     *
     *  - https://developer.mozilla.org/en/HTTP_access_control
     *  - http://www.w3.org/TR/cors/
     *
     */
    //https://stackoverflow.com/questions/8719276/cors-with-php-headers
    public static function cors() {

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

        //echo "You have CORS!";
    }
}