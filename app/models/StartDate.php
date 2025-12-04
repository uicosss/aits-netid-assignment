<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:56 PM
 */

namespace AitsNetidAssignment\Model;


use Carbon\Carbon;

class StartDate
{
    /**
     * @var Carbon
     */
    public Carbon $Date;

    public function __construct()
    {
    }

    /**
     * @param $dateString
     * @return void
     */
    public function setDate($dateString)
    {
        $this->Date = Carbon::parse($dateString);
    }

    /**
     * @return Carbon
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Void method used to set the Object based on values passed in from an Array
     *
     * @param array $array
     */
    public function setFromString($string)
    {
        $this->setDate($string);
    }

}