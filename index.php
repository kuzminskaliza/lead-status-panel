<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crm.belmar.pro/api/v1/getstatuses',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
       "date_from" : "2022-12-01 00:00:00",
       "date_to" : "2022-12-31 23:59:59",
       "page" : 0,
       "limit" : 100
     }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'token: ba67df6a-a17c-476f-8e95-bcdb75ed3958'
    ),
));

$response = curl_exec($curl);

$error = curl_error($curl);
curl_close($curl);

if ($error) {
    echo "CURL Error: $error";
} else {
    echo "Response:<br>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
}
