<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 4/16/19
 * Time: 1:12 PM
 */

namespace AitsNetidAssignment\Controllers;


use AitsNetidAssignment\Model\NetIdAssignment;
use AitsNetidAssignment\utilities\Utilities;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

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
        try {

            if(empty($NetId)) {
                throw new \Exception('NetId must be provided.');
            }

            $client = new Client();

            $apiEndpoint = $_ENV['AITS_AZURE_NETID_ASSIGNMENT_API_URL'] . '/' . $NetId . '/' . $Domain;

            $request = new Request('GET', $apiEndpoint, [
                'Cache-Control' => 'no-cache',
                'Ocp-Apim-Subscription-Key' => $_ENV['AITS_AZURE_NETID_ASSIGNMENT_PRIMARY_KEY']
            ]);

            $response = $client->send($request);

            if ($response->getStatusCode('content-type') != 200) {
                throw new \Exception('API request was not successful.');
            }

            $json = $response->getBody()->getContents();
            $netIdAssignment = new NetIdAssignment();
            $netIdAssignment->setFromJson($json);

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