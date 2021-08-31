<?php
session_start();

if (isset($_SESSION['max_order_id'])) 
{
$order_id = $_SESSION['max_order_id'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>www.sheen.com</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<style type="text/css">
	
	.success-page{
  max-width:300px;
  display:block;
  margin: 0 auto;
  text-align: center;
      position: relative;
    top: 50%;
    transform: perspective(1px) translateY(50%)
}
.success-page img{
  max-width:62px;
  display: block;
  margin: 0 auto;
  margin-top: 10vh;
}

.btn-view-orders{
  display: block;
  border:1px solid #47c7c5;
  width:100px;
  margin: 0 auto;
  margin-top: 45px;
  padding: 10px;
  color:#fff;
  background-color:#47c7c5;
  text-decoration: none;
  margin-bottom: 20px;
}
h2{
  color:green;
    margin-top: 25px;

}
a{
  text-decoration: none;
}
</style>
<body>



<div class="success-page">
   <img  src="http://share.ashiknesin.com/green-checkmark.png" class="center" alt="" />
  <h2>Order Success !!</h2>
  <p>We are delighted to inform you that we received your Order</p>
<br>
  <a href="index.php" class="btn btn-success">Continue Shopping</a>
  <a href="invoice.php?order_id=<?php echo $order_id; ?>" class="btn btn-danger" style="margin-left: 1%;">Download Invoice</a>

</div>
</div>


</body>
</html>