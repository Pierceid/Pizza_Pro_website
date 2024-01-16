<?php

// initialization
$url = "https://reqres.in/api/users?page=2";

$curl = curl_init();
// set up for sending
curl_setopt($curl, CURLOPT_URL, $url);
// set up for responding
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
if ($e = curl_error($curl)) {
    echo $e;
} else {
    $decoded = json_decode($response, true);
    print_r($decoded);
}

curl_close($curl);
