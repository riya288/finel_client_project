<?php
  session_start();
  

 $data = [ 
         'payment_id' => $_POST['razorpay_payment_id'],
         'amount' => $_POST['totalAmount'],
        ];

 // you can write your database insertation code here
 // after successfully insert transaction in database, pass the response accordingly
 $arr = array('msg' => 'Payment successfully credited', 'status' => true); 


$_SESSION['payment_data'] = $data;
 echo json_encode($arr);


?>

