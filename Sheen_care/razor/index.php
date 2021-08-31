<?php

session_start();





       $name = $_SESSION['insta_name'];

       $grand_total = $_SESSION['insta_total'];

       $email = $_SESSION['insta_email'];

?>



<!DOCTYPE html>

<html>

<head>

  <title>Sheen care</title>

</head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 

<style>

  .card-product .img-wrap {

    border-radius: 3px 3px 0 0;

    overflow: hidden;

    position: relative;

    height: 220px;

    text-align: center;

  }

  .card-product .img-wrap img {

    max-height: 100%;

    max-width: 100%;

    object-fit: cover;

  }

  .card-product .info-wrap {

    overflow: hidden;

    padding: 15px;

    border-top: 1px solid #eee;

  }

  .card-product .bottom-wrap {

    padding: 15px;

    border-top: 1px solid #eee;

  }



  .label-rating { margin-right:10px;

    color: #333;

    display: inline-block;

    vertical-align: middle;

  }



  .card-product .price-old {

    color: #999;

  }

</style>

<body>





<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>



  $(document).ready(function(){

    var totalAmount = "<?php echo $grand_total; ?>";

   

    var product_id =  1;

    var options = {

    "key": "rzp_live_Xo3lMz364tQCT6",

    "amount": "<?php echo $grand_total*100; ?>", // 2000 paise = INR 20

    "name": "<?php echo $name; ?>",

    "description": "Pay To SheenCare",

    "image": "",

    "handler": function (response){

          $.ajax({

            url: 'https://www.sheencare.com/razor/payment-process.php',

            type: 'post',

            dataType: 'json',

            data: {

                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,

            }, 

            success: function (msg) 

            {



               window.location.href = 'https://www.sheencare.com/razor/success.php';

            }





        });







     

    },



    "theme": {

        "color": "#528FF0"

    }

  };

  var rzp1 = new Razorpay(options);

  rzp1.open();

  e.preventDefault();

  });



 



</script>

</body>

</html>