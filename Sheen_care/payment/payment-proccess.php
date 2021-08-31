<?php
    session_start();
       $name = $_SESSION['insta_name'];
       $grand_total = $_SESSION['insta_total'];
       $email = $_SESSION['insta_email'];
        


    require_once('vendor/autoload.php');

   

    $api = new Instamojo\Instamojo('4dbaa0ca05c05d5984047e08a87b2275','b459bce37904675dae6c0ae57d9131b0','https://www.instamojo.com/api/1.1/');

    try {
        $response = $api->paymentRequestCreate(array(
            "purpose" => "www.sheen.com",
            "amount" => $grand_total,
            "buyer_name" => $name,
            "send_email" => true,
            "email" => $email,
            "phone" => $_POST["phone"],
            "redirect_url" => "http://sheencare.niktechsolution.com/payment/payment-success.php"
            ));
            
            header('Location: ' . $response['longurl']);
            exit();
    }catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }

?>