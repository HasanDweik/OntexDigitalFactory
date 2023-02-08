<?php

$apiKey = "81vhcdbbftogrypwbqtrjznhupnfidom";
$csvFile = "customers.csv";

// read the CSV file and store the data in an array
$rows = array_map('str_getcsv', file($csvFile));
array_walk($rows, function(&$row) use ($rows) {
  $row = array_combine($rows[0], $row);
});
array_shift($rows);

// loop through each customer and push to API
foreach ($rows as $customer) {
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.dev.ecommerce.ontdf.io/rest/V1/customers",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
      "customer" => [
        "email" => $customer['email'],
        "firstname" => $customer['firstname'],
        "lastname" => $customer['lastname'],
        "addresses" => [
          [
            "defaultShipping" => true,
            "defaultBilling" => true,
            "firstname" => $customer['firstname'],
            "lastname" => $customer['lastname'],
            "region" => [
              "regionCode" => $customer['region_code'],
              "region" => $customer['region']
            ],
            "postcode" => $customer['postcode'],
            "street" => [
              $customer['street']
            ],
            "telephone" => $customer['telephone'],
            "countryId" => $customer['country_id']
          ]
        ]
      ],
      "password" => $customer['password']
    ]),
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer $apiKey",
      "Content-Type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo "Customer with email " . $customer['email'] . " successfully added<br>";
  }
}
