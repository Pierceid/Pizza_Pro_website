<?php

// initialization
$url = "https://reqres.in/api/users/2";
$array = array(
    "name" => "Erik",
    "student" => true
);
$data = http_build_query($array);
$header = array(
    'Authorization: asdfghjkl'
);

$curl = curl_init();
// set up for sending
curl_setopt($curl, CURLOPT_URL, $url);
// set up for posting
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($curl);
if ($e = curl_error($curl)) {
    echo $e;
} else {
    $decoded = json_decode($response, true);
    $encoded = json_encode($decoded);
    var_dump($encoded);
}

curl_close($curl);