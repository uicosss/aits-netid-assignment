<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 1:12 PM
 */

namespace AitsNetidAssignment\Controllers;


use AitsNetidAssignment\Model\NetIdAssignment;
use AitsNetidAssignment\Utilities\Utilities;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class AITS_NetId_Assignment
{
    /**
    /**
     * Method used to Query a NetId from AITS Web Service
     *
     * @param $NetId
     * @param string $Domain
     * @return NetIdAssignment|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getNetIdAssignment($NetId, $Domain = 'uic.edu')
    {


        $netIdAssignment = new NetIdAssignment();

        try {

            if(empty($NetId)) {

                throw new \Exception('NetId must be provided.');

            }


            $client = new Client([
                'base_uri' => $_ENV['AITS_NETID_ASSIGNMENT_AITS_SERVICE_HOST']
            ]);

// POST data
            $response = $client->request('GET', '/xfunctionalWS/query/org.any_openeai_enterprise.moa.jmsobjects.coreapplication.v1_0.NetIdAssignment/' . $_ENV['AITS_NETID_ASSIGNMENT_AITS_SENDER_APP_ID'] . '/' . $NetId . '/' . $Domain, [
                'headers' => [
                    'Content-type' => 'application/xml',
                    'Accept' => 'application/xml',
                ]
            ]);

            if ($response->getStatusCode('content-type') == 200) {

                $xmlstring = $response->getBody()->getContents();

                $netIdAssignment->setFromXML($xmlstring);

            }

            return $netIdAssignment;

        } catch (ClientException $e) {

            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();

            if(Utilities::is_cli()) {
                print_r($responseBodyAsString);
                echo PHP_EOL;
            }

            Utilities::SaveToErrorLog($responseBodyAsString, 'error', 'error');

        } catch (\Exception $e) {

            if(Utilities::is_cli()) {
                print_r($e->getMessage());
                echo PHP_EOL;
            }

            Utilities::SaveToErrorLog($e->getMessage(), 'warning', 'error');

        }

        return false;

    }

}