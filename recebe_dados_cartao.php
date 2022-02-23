<?php
//RECEBE OS NOME DO CARTÃO E TOKEN DE AUTORIZAÇÃO DO SERVIDOR DA YUGO.
$e = $_POST['token'];
echo $e;

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/customers/$cliente/payment_methods?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"description\":\"peladinho\",\"token\":\"$e\",\"set_as_default\":\"true\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}