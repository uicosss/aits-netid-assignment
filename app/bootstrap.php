<?php
/**
 * Created by PhpStorm.
 * User: Daniel-Paz-Horta
 * Date: 3/5/19
 * Time: 11:19 AM
 */

// Load the contents of ../.env
try {

    $dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
    $dotenv->load();

} catch (\Exception $e) {

    return $e->getMessage();

}