<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:54 PM
 */

namespace App\Model;


class Name
{

    /**
     * @var String
     */
    public $FirstName;

    /**
     * @var String
     */
    public $LastName;

    public function __construct()
    {
    }

    /**
     * @return String
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param String $FirstName
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return String
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param String $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * Void method used to set the Object based on values passed in from an Array
     *
     * @param array $array
     */
    public function setFromArray(Array $array)
    {

        if(!empty($array['FirstName'])) {

            $this->setFirstName($array['FirstName']);

        }

        if(!empty($array['LastName'])) {

            $this->setLastName($array['LastName']);

        }

    }

}