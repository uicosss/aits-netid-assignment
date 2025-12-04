<?php
/**
 * Created by PhpStorm.
 * User: Daniel-Paz-Horta
 * Date: 3/5/19
 * Time: 11:19 AM
 */

try {

    if(is_readable(__DIR__ . '/../.env')) {
        // Load from within this Package
        $dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
    }

    if (is_readable(__DIR__ . '/../../../../.env')) {
        // Try to load from the root of a project that is using this package
        $dotenv = Dotenv\Dotenv::create(__DIR__ . '/../../../../');
        $dotenv->overload();
    }

    if(!empty($dotenv)) {
        $dotenv->required(['AITS_NETID_ASSIGNMENT_DATA_LOG_RELATIVE_PATH', 'AITS_NETID_ASSIGNMENT_DATA_LOG_FILE_PREFIX', 'AITS_AZURE_NETID_ASSIGNMENT_API_URL', 'AITS_AZURE_NETID_ASSIGNMENT_PRIMARY_KEY', 'AITS_AZURE_NETID_ASSIGNMENT_SECONDARY_KEY'])->notEmpty();
    }

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo PHP_EOL;
    echo "</pre>";
}