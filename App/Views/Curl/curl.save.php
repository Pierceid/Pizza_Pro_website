<?php

// initialization
$url = "https://reqres.in/api/users?page=2";
$file = fopen("file.txt", "w");

$curl = curl_init();
// set up for sending
curl_setopt($curl, CURLOPT_URL, $url);
// set up for saving into a file
curl_setopt($curl, CURLOPT_FILE, $file);

$response = curl_exec($curl);
if ($e = curl_error($curl)) {
    echo $e;
}

fclose($file);
curl_close($curl);
