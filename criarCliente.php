<?php


require_once('vendor/autoload.php');

function cadastraCliente($email, $nomedono){
    
    $client = new \GuzzleHttp\Client();
    
    $response = $client->request('POST', 'https://api.iugu.com/v1/customers?api_token=AA71308B7A2B84BA455EBDFB18624F50AC0291C0ED96C0B9E4B06DC6A1C5B169', [
      'body' => '{"email":"$email","name":"$nomedono"}',
      'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ],
    ]);
    
    echo $response->getBody();

}
