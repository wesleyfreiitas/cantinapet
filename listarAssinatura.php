<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.iugu.com/v1/subscriptions?api_token=AA71308B7A2B84BA455EBDFB18624F50AC0291C0ED96C0B9E4B06DC6A1C5B169 ');

echo $response->getBody();