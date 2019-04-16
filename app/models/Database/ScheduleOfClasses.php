<?php
/**
 * Created by PhpStorm.
 * User: Daniel-Paz-Horta
 * Date: 12/11/18
 * Time: 10:54 AM
 */

namespace App\models\Database;
use App\utilities\core;

class ScheduleOfClasses
{


    /**
     * Method used to Get Student Term Status Data from database
     *
     * @return mixed
     */
    public static function GetScheduleData() //
    {

        // Get an instance of the database connection
        $database = core::getInstance();

        $sql = file_get_contents(__DIR__ . '/../../source/sql/schedule-of-classes-query.sql');
        $stmt = $database->dbh->prepare($sql);
        $stmt->execute([
            ':banner_term_code' => $_ENV['APP_TERM_CD']
        ]);

        return $stmt->fetchALL(\PDO::FETCH_ASSOC);

    }

}