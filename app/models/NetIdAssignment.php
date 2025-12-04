<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:45 PM
 */

namespace AitsNetidAssignment\Model;


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

    public function setFromJson($json)
    {

        $array = json_decode($json,TRUE);

        if(empty($array)) {
            throw new \Exception('Parsed JSON Object cannot be empty');
        }

        if(empty($array['list'])) {
            throw new \Exception('Parsed JSON Object list cannot be empty');
        }

        if (!empty($array['list'][0]['netId'])) {
            // NetId
            $NetId = new NetId();
            $NetId->setFromArray($array['list'][0]['netId']);
            $this->setNetId($NetId);
        }

        if (!empty($array['list'][0]['institutionalIdentity'])) {
            // InstitutionalIdentity
            $InstitutionalIdentity = new InstitutionalIdentity();
            $InstitutionalIdentity->setFromArray($array['list'][0]['institutionalIdentity']);
            $this->setInstitutionalIdentity($InstitutionalIdentity);
        }

        if (!empty($array['list'][0]['startDate'])) {
            // StartDate
            $StartDate = new StartDate();
            $StartDate->setFromString($array['list'][0]['startDate']);
            $this->setStartDate($StartDate);
        }

    }

}