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

    if(empty($argv[2])) {
        throw new Exception('Domain must be specified. Must be one of `uic.edu`, `uillinois.edu`, `uis.edu`');
    }

    print_r(
        \AitsNetidAssignment\Controllers\AITS_NetId_Assignment::getNetIdAssignment(
            $argv[1],
            $argv[2]
        )
    );

} catch (\Exception $e) {
    print_r($e->getMessage());
    echo PHP_EOL;
}