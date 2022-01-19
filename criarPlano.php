<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.iugu.com/v1/plans?api_token=AA71308B7A2B84BA455EBDFB18624F50AC0291C0ED96C0B9E4B06DC6A1C5B169 ', [
  'body' => '{"name":"plano","identifier":"5","interval":1,"interval_type":"weeks","value_cents":100}',
  'headers' => [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
  ],
]);

echo $response->getBody();