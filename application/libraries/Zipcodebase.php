<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zipcodebase
{

    private $api_key = 'f3eaacf0-35fd-11f0-b3db-cf0a1a5afb1e';
    private $base_url = 'https://app.zipcodebase.com/api/v1/distance';

    public function get_distance($from_zip, $to_zips, $country = 'id')
    {
        $ch = curl_init();

        $data = [
            'code' => $from_zip,
            'compare' => is_array($to_zips) ? implode(',', $to_zips) : $to_zips,
            'country' => $country,
            'unit' => 'km',
            'apikey' => $this->api_key,
        ];

        curl_setopt($ch, CURLOPT_URL, $this->base_url . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'apikey: ' . $this->api_key
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
