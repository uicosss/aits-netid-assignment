<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:29 PM
 */

include('vendor/autoload.php');

try {

    if(empty($argv[1])) {

        throw new Exception('NetId must be specified');
    }

    print_r(
        \App\Controllers\AITS_NetId_Assignment::getNetIdAssignment(
            $argv[1],
            !empty($argv[2]) AND in_array($argv[2], ['uic.edu', 'uillinois.edu', 'uis.edu']) ? $argv[2] : 'uic.edu'
        )
    );

} catch (\Exception $e) {

    print_r($e->getMessage());
    echo PHP_EOL;

}