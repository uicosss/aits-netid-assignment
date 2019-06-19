<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 12:46 PM
 */

namespace AitsNetidAssignment\Model;


class NetId
{

    /**
     * @var String
     */
    public $Principal;

    /**
     * @var String
     */
    public $Domain;

    /**
     * NetId constructor.
     */
    public  function __construct(){

    }

    /**
     * @return String
     */
    public function getPrincipal()
    {
        return $this->Principal;
    }

    /**
     * @param String $Principal
     */
    public function setPrincipal($Principal)
    {
        $this->Principal = $Principal;
    }

    /**
     * @return String
     */
    public function getDomain()
    {
        return $this->Domain;
    }

    /**
     * @param String $Domain
     */
    public function setDomain($Domain)
    {
        $this->Domain = $Domain;
    }

    /**
     * Void method used to set the Object based on values passed in from an Array
     *
     * @param array $array
     */
    public function setFromArray(Array $array)
    {

        if(!empty($array['Principal'])) {

            $this->setPrincipal($array['Principal']);

        }

        if(!empty($array['Domain'])) {

            $this->setDomain($array['Domain']);

        }

    }

}