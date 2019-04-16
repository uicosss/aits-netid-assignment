<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:45 PM
 */

namespace App\Model;


class NetIdAssignment
{

    /**
     * @var NetId
     */
    public $NetId;

    /**
     * @var InstitutionalIdentity
     */
    public $InstitutionalIdentity;

    /**
     * @var StartDate
     */
    public $StartDate;

    public function __construct()
    {

    }

    /**
     * @return NetId
     */
    public function getNetId()
    {
        return $this->NetId;
    }

    /**
     * @param NetId $NetId
     */
    public function setNetId($NetId)
    {
        $this->NetId = $NetId;
    }

    /**
     * @return InstitutionalIdentity
     */
    public function getInstitutionalIdentity()
    {
        return $this->InstitutionalIdentity;
    }

    /**
     * @param InstitutionalIdentity $InstitutionalIdentity
     */
    public function setInstitutionalIdentity($InstitutionalIdentity)
    {
        $this->InstitutionalIdentity = $InstitutionalIdentity;
    }

    /**
     * @return StartDate
     */
    public function getStartDate()
    {
        return $this->StartDate;
    }

    /**
     * @param StartDate $StartDate
     */
    public function setStartDate($StartDate)
    {
        $this->StartDate = $StartDate;
    }

    /**
     * Void method used to set the object from a NetIdAssignment XML string
     *
     * @param String $xml
     */
    public function setFromXML(String $xml)
    {

        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        // NetId
        $NetId = new NetId();
        $NetId->setFromArray($array['NetIdAssignment']['NetId']);
        $this->setNetId($NetId);

        // InstitutionalIdentity
        $InstitutionalIdentity = new InstitutionalIdentity();
        $InstitutionalIdentity->setFromArray($array['NetIdAssignment']['InstitutionalIdentity']);
        $this->setInstitutionalIdentity($InstitutionalIdentity);

        // StartDate
        $StartDate = new StartDate();
        $StartDate->setFromArray($array['NetIdAssignment']['StartDate']);
        $this->setStartDate($StartDate);

    }

}