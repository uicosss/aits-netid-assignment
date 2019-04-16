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

// Prepare Database Instance
\App\utilities\config::write('db.driver', $_ENV['DATABASE_DRIVER']);
\App\utilities\config::write('db.basename', $_ENV['DATABASE_BASENAME']);
\App\utilities\config::write('db.user', $_ENV['DATABASE_USER']);
\App\utilities\config::write('db.password', $_ENV['DATABASE_PASSWORD']);