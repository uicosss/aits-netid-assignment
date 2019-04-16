# AITS NetId Assignment

## Purpose
Package that parses an AITS XML NetId Assignment object into a PHP Object

## Requirements
- PHP 7+
- Composer

## Initial Set-up
1. Change into package's root directory.
1. Copy .env.example to .env and fill out the values accordingly.
1. Run composer setup `composer install`.

## Usage
1. Include composer's autoloader `include('vendor/autoload.php'')`
1. Call upon the static method `\App\Controllers\AITS_NetId_Assignment::getNetIdAssignment($netId, $domain);`
    1. First parameter is the NetId to be queried
    1. Second parameter is the Domain to be queried (uic.edu, uillinois.edu, or uis.edu). uic.edu is set by default.
1. If successful `getNetIdAssignment` will return a `App\Model\NetIdAssignment` object.