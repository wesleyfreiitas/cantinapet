<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.iugu.com/v1/subscriptions?api_token=AA71308B7A2B84BA455EBDFB18624F50AC0291C0ED96C0B9E4B06DC6A1C5B169 ', [
  'body' => '{"two_step":true,"suspend_on_invoice_expired":true,"only_charge_on_due_date":false,"customer_id":"420C1C10B341494E92CC2154A8558A3D","plan_identifier":"5"}',
  'headers' => [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
  ],
]);

echo $response->getBody();