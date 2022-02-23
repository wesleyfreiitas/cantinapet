<?php

$json = file_get_contents("file.json");

$data = json_decode($json);

$recent_invoices_obj = $data->recent_invoices;

$recent_invoices = json_encode($recent_invoices_obj);

$data2 = json_decode($recent_invoices);

echo $data2[0]->id;