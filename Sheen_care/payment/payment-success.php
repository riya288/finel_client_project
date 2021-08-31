<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>Instamojo Thank You - Tutsmake</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="">
	
	<br><br><br><br>
	<article class="bg-secondary mb-3">  
	<div class="card-body text-center">
	<h4 class="text-white">Thank you for payment<br></h4>
	<?php

		require_once('vendor/autoload.php');

     $API_KEY = "test_d883b3a8d2bc1adc7a535506713";
    $AUTH_TOKEN = "test_dc229039d2232a260a2df3f7502";
    $URL = "https://test.instamojo.com/api/1.1/";

		$api = new Instamojo\Instamojo($API_KEY, $AUTH_TOKEN,$URL);

		$payid = $_GET["payment_request_id"];

		try {
		$response = $api->paymentRequestStatus($payid);
		$insta_tran_id = $response['payments'][0]['payment_id'];
		$insta_tran_status = $response['payments'][0]['status'];

			$_SESSION['insta_tran_id']= $insta_tran_id;
			$_SESSION['insta_tran_status'] = $insta_tran_status;

			if (isset($_SESSION['insta_tran_id'])) 
			{


				
 				echo "<script> window.location='instamojo_payment.php'; </script>";
			}
	

		}
		catch (Exception $e) {
		print('Error: ' . $e->getMessage());
		}
	?>
	</article>

</body>
</html>
