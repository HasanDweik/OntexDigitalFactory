<?php

$customerId = 123;
$apiKey = "81vhcdbbftogrypwbqtrjznhupnfidom";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.dev.ecommerce.ontdf.io/rest/V1/customers/$customerId",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $apiKey"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $customer = json_decode($response);
  if ($customer) {
    // display customer information
    echo "Customer Information:<br>";
    echo "ID: " . $customer->id . "<br>";
    echo "Email: " . $customer->email . "<br>";
    echo "First Name: " . $customer->firstname . "<br>";
    echo "Last Name: " . $customer->lastname . "<br>";
  } else {
    echo "Error: Customer with ID $customerId not found";
  }
}
