<?php
/**
 * Created by PhpStorm.
 * User: Daniel-Paz-Horta
 * Date: 11/22/16
 * Time: 3:27 PM
 */

namespace AitsNetidAssignment\utilities;


class config
{
    static $confArray;

    public static function read($name)
    {
        return self::$confArray[$name];
    }

    public static function write($name, $value)
    {
        self::$confArray[$name] = $value;
    }

}