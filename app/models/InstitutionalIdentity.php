<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:51 PM
 */

namespace AitsNetidAssignment\Model;


class InstitutionalIdentity
{

    /**
     * @var String
     */
    public $InstitutionalId;

    /**
     * @var UnknownPerson
     */
    public $UnknownPerson;

    public function __construct()
    {
    }

    /**
     * @return String
     */
    public function getInstitutionalId()
    {
        return $this->InstitutionalId;
    }

    /**
     * @param String $InstitutionalId
     */
    public function setInstitutionalId($InstitutionalId)
    {
        $this->InstitutionalId = $InstitutionalId;
    }

    /**
     * @return UnknownPerson
     */
    public function getUnknownPerson()
    {
        return $this->UnknownPerson;
    }

    /**
     * @param UnknownPerson $UnknownPerson
     */
    public function setUnknownPerson($UnknownPerson)
    {
        $this->UnknownPerson = $UnknownPerson;
    }

    /**
     * Void method used to set the Object based on values passed in from an Array
     *
     * @param array $array
     */
    public function setFromArray(Array $array)
    {

        if(!empty($array['InstitutionalId'])) {

            $this->setInstitutionalId($array['InstitutionalId']);

        }

        if(!empty($array['UnknownPerson'])) {


            $UnknownPerson = new UnknownPerson();
            $UnknownPerson->setFromArray($array['UnknownPerson']);

            $this->setUnknownPerson($UnknownPerson);

        }

    }

}