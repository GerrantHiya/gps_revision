<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '../vendor/autoload.php'); // Adjust path if needed

class Rajaongkir
{
    protected $client;
    protected $api_key = 'eLddAx6d20020d33b6c7fa8e4rjizOad';

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function get_domestic_destination($search = "")
    {
        try {
            $response = $this->client->request('GET', 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->api_key,
                ],
                'query' => [
                    'search' => $search,
                ],
            ]);
            return $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $e->getMessage();
        }
    }
}

/**
 ** require_once('vendor/autoload.php');
 ** 
 ** $client = new \GuzzleHttp\Client();
 ** 
 ** $response = $client->request('GET', 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
 **   'headers' => [
 **     'accept' => 'application/json',
 **     'key' => 'eLddAx6d20020d33b6c7fa8e4rjizOad',
 **   ],
 ** ]);
 ** 
 ** echo $response->getBody();
 */
