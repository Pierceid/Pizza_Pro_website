<?php

// initialization
$url = "https://reqres.in/api/users";
$array = array(
    "name" => "Erik",
    "student" => true
);
$data = http_build_query($array);

$curl = curl_init();
// set up for sending
curl_setopt($curl, CURLOPT_URL, $url);
// set up for posting
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
if ($e = curl_error($curl)) {
    echo $e;
} else {
    $decoded = json_decode($response);
    foreach ($decoded as $item => $value) {
        echo $item . ": " . $value . '<br>';
    }
}

curl_close($curl);