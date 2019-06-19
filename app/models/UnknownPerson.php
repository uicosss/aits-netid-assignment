<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:54 PM
 */

namespace AitsNetidAssignment\Model;


class UnknownPerson
{

    /**
     * @var Name
     */
    public $Name;

    /**
     * @var BirthDate
     */
    public $BirthDate;

    /**
     * @var String
     */
    public $Gender;

    public function __construct()
    {
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param Name $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return BirthDate
     */
    public function getBirthDate()
    {
        return $this->BirthDate;
    }

    /**
     * @param BirthDate $BirthDate
     */
    public function setBirthDate($BirthDate)
    {
        $this->BirthDate = $BirthDate;
    }

    /**
     * @return String
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @param String $Gender
     */
    public function setGender($Gender)
    {
        $this->Gender = $Gender;
    }

    /**
     * Void method used to set the Object based on values passed in from an Array
     *
     * @param array $array
     */
    public function setFromArray(Array $array)
    {

        if(!empty($array['Gender'])) {

            $this->setGender($array['Gender']);

        }

        if(!empty($array['Name'])) {


            $Name = new Name();
            $Name->setFromArray($array['Name']);

            $this->setName($Name);

        }

        if(!empty($array['BirthDate'])) {


            $BirthDate = new BirthDate();
            $BirthDate->setFromArray($array['BirthDate']);

            $this->setBirthDate($BirthDate);

        }

    }

}