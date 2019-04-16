<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:56 PM
 */

namespace App\Model;


class StartDate
{
    /**
     * @var Int
     */
    public $Month;

    /**
     * @var Int
     */
    public $Day;

    /**
     * @var Int
     */
    public $Year;

    public function __construct()
    {
    }

    /**
     * @return Int
     */
    public function getMonth()
    {
        return $this->Month;
    }

    /**
     * @param Int $Month
     */
    public function setMonth($Month)
    {
        $this->Month = $Month;
    }

    /**
     * @return Int
     */
    public function getDay()
    {
        return $this->Day;
    }

    /**
     * @param Int $Day
     */
    public function setDay($Day)
    {
        $this->Day = $Day;
    }

    /**
     * @return Int
     */
    public function getYear()
    {
        return $this->Year;
    }

    /**
     * @param Int $Year
     */
    public function setYear($Year)
    {
        $this->Year = $Year;
    }

    /**
     * Void method used to set the Object based on values passed in from an Array
     *
     * @param array $array
     */
    public function setFromArray(Array $array)
    {

        if(!empty($array['Month'])) {

            $this->setMonth($array['Month']);

        }

        if(!empty($array['Day'])) {

            $this->setDay($array['Day']);

        }

        if(!empty($array['Year'])) {

            $this->setYear($array['Year']);

        }

    }

}