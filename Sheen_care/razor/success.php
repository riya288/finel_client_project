<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Thank You</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>
<br><br><br><br>
<article class="bg-secondary mb-3">  
<div class="card-body text-center">

<h4 class="text-white">Thank you for payment<br></h4>
</article>


<?php
	$payment_data = $_SESSION['payment_data'];

	$razor_tran_id =  $payment_data['payment_id'];

	$_SESSION['razor_tran_id'] = $razor_tran_id;

			if (isset($_SESSION['razor_tran_id'])) 
			{


				
 				echo "<script> window.location='razor_payment.php'; </script>";
			}
?>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</body>
</html>


