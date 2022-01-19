<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('DELETE', 'https://api.iugu.com/v1/subscriptions/B08CD35D31DB445190B54ECDC3E94C39?api_token=AA71308B7A2B84BA455EBDFB18624F50AC0291C0ED96C0B9E4B06DC6A1C5B169 ', [
  'headers' => [
    'Accept' => 'application/json',
  ],
]);

echo $response->getBody();