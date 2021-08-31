<?php
$curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>'{"order_id": "SHEEENPOWERX123",
  "order_date": "28-4-2021 11:11",
  "pickup_location": "Vadodara",
  "billing_customer_name": "Himanshu",
  "billing_last_name": "Bhatt",
  "billing_address": "312 , Vihav Ensign",
  "billing_address_2": "Vasna - Gotri Road, Opposite Sales India Showroom , Near Bansal Mall",
  "billing_city": "Vadodara",
  "billing_pincode": "390021",
  "billing_state": "Gujarat",
  "billing_country": "India",
  "billing_email": "himanshu.bhatt@octopuscare.in",
  "billing_phone": "9910311122",
  "shipping_is_billing": true,
  "shipping_customer_name": "",
  "shipping_last_name": "",
  "shipping_address": "",
  "shipping_address_2": "",
  "shipping_city": "",
  "shipping_pincode": "",
  "shipping_country": "",
  "shipping_state": "",
  "shipping_email": "",
  "shipping_phone": "",
  "order_items": [
    {
      "name": "pen",
      "sku": "pen",
      "units": 10,
      "selling_price": 500,
      "discount": "",
      "tax": ""
    }
  ],
  "payment_method": "Prepaid",
  "shipping_charges": 40,
  "giftwrap_charges": 20,
  "transaction_charges": 0,
  "total_discount": 0,
  "sub_total": 9000,
  "length": 10,
  "breadth": 15,
  "height": 20,
  "weight": 2.5
	}',
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json",
	   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEzNzIyMjEsImlzcyI6Imh0dHBzOi8vYXBpdjIuc2hpcHJvY2tldC5pbi92MS9leHRlcm5hbC9hdXRoL2xvZ2luIiwiaWF0IjoxNjE5NTk0MTc3LCJleHAiOjE2MjA0NTgxNzcsIm5iZiI6MTYxOTU5NDE3NywianRpIjoiNnBrVTY2b2t0dGNFSkltbyJ9.Tx0kfq9vJQw_jZ3COGpnNdEa5KOFddPxUV7Gy-R3UJc"
    ),
  ));
  $SR_login_Response = curl_exec($curl);
  curl_close($curl);
  //$SR_login_Response_out = json_decode($SR_login_Response);
  echo '<pre>';
  print_r($SR_login_Response);
?>