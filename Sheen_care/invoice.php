<?php
include('admin/connection.php');


$order_id = $_REQUEST['order_id'];


$select ="SELECT DISTINCT * FROM invoice JOIN order_master ON invoice.order_id = order_master.order_id JOIN order_detail ON order_master.order_id = order_detail.order_id JOIN payment ON order_master.order_id = payment.order_id JOIN product ON order_detail.pro_id = product.pro_id JOIN customer ON customer.customer_id = order_master.customer_id WHERE invoice.order_id = '{$order_id}'";

$run = mysqli_query($conn, $select);

while ($data = mysqli_fetch_array($run))
{

$date = $data['invoice_date'];
$address = $data['invoice_address'];
$city = $data['invoice_city'];
$pincode = $data['pincode'];
$sub_total = $data['invoice_sub_total'];
$uniq_order_id = $data['uniq_order_id'];
$first = $data['o_first_name'];
$last =  $data['o_last_name'];
$name = $last." ".$first;
$shipping_charge = $data['shipping_charge'];
$payment_mode = $data['payment_mode'];
$insta_tran_id = $data['insta_tran_id'];

$pro_id_array[] = $data['pro_id'];
$quantity_array[] = $data['quantity'];
$total_product = count($pro_id_array);
$offer_status = $data['offer_status'];
$city = $data['city'];
$state = $data['state'];
$country = $data['country'];
}


?>



<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>SheenCare.com</title>

	<!-- Site favicon -->
	 <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/fav.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="admin/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="admin/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="admin/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>

<br>
	<div class="container mt-2">
			<div class="min-height-200px">
				<div class="invoice-wrap">
					<div class="invoice-box">
						<div class="invoice-header">
							
						</div>
							
						<div class="text-center mb-30 weight-600">
						<img  src="assets/images/logo/sheen_logo.png" alt="" style="width: auto; height: 65px;">
						</div>
						<div class="invoice-desc taxhead pb-30">
							<div class=" clearfix">
								TAX INVOICE
							</div>
						</div>
						<!-- <h4 class="text-center mb-30 weight-600">www.sheencare.com</h4> -->
						<div class="row pb-30 pt-30">
							<div class="col-md-3 topsec">
								<h5 class="mb-15">SHIPPING ADDRESS:</h5>
								<p class="mb-5"><?php echo $name; ?></p><br>
								<p class="mb-5"><?php echo $address; ?></p>
							</div>
							<div class="col-md-4 topsec dottedborder">
								<h5 class="mb-15">SOLD BY:</h5>
								<div class="text-right">
									<p class="mb-5">SHEEN CARE</p>
									<p>312 , Vihav Ensign</p>
									<p>Vasna - Gotri Road, Opposite Sales</p>
									<p>India Showroom, Near Bansal Mall</p>
									<p>Vadodara 390021 Gujarat India</p>
									<p>State Code:24</p>
									<p>Ph: 9910311122</p>
									<p>GSTIN NO. 24AAGFO2948H1Z7</p>
									<p>Email:himanshu.bhatt@octopuscare.in</p>
								</div>
							</div>
							<div class="col-md-5 topsec">
								<h5 class="mb-15">INVOICE DETAILS</h5>
								<div class="row">
								<div class="col-md-5" style="font-weight:600">INVOICE DATE </div>
								<div class="col-md-7">:&nbsp;&nbsp;<?=$date?></div>
								<div class="col-md-5" style="font-weight:600">ORDER ID</div>
								<div class="col-md-7">:&nbsp;&nbsp;<?php echo $uniq_order_id; ?></div>
							</div>
							</div>
						</div>
						<div class="invoice-desc pb-30">
							<div class="invoice-desc-head clearfix">
								<div class="invoice-sub">Product Name</div>
								<div class="invoice-rate">Rate</div>
								<div class="invoice-hours">Quantity</div>
								<div class="invoice-subtotal">Subtotal</div>
							</div>
							<div class="invoice-desc-body">
								<ul>

									<?php


										$i=0;
										$j=1;
										while ($j <= $total_product) 
										{
											$temp_pro_id = $pro_id_array[$i];
											$temp_quantity = $quantity_array[$i];

											$select2 ="SELECT * FROM product WHERE pro_id = '{$temp_pro_id}'";								
											$run2 = mysqli_query($conn,$select2);
											while ($data2 = mysqli_fetch_array($run2)) 
											{
											?>

												<li class="clearfix">
													<div class="invoice-sub"><?php echo $data2['pro_name']; ?></div>
													<div class="invoice-rate"><?php
													if ($offer_status > 0) 
													{
														echo $data2['offer_price'];
														$offer_price = $data2['offer_price'];
														$tmp_total = $offer_price * $temp_quantity;
													}
													else
													{
														 echo $data2['price'];	
														$price = $data2['price'];
														$tmp_total = $price * $temp_quantity;
													}

													
													 

													 ?></div>
													<div class="invoice-hours"><?php echo $temp_quantity; ?></div>
													<div class="invoice-subtotal"><span class="weight-600">₹ <?php echo $tmp_total; ?></span></div>
												</li>

											<?php
											}
										$i++;
										$j++;					
										}


										
									?>
								
						


								</ul>
							</div>
							<div class="invoice-desc-footer" style="margin-top: -10%;">
								<div class="invoice-desc-head clearfix">
									<div class="invoice-sub">Payment Mode</div>
									<div class="invoice-subtotal">Total </div>
								</div>
								<div class="invoice-desc-body">
									<ul>
										<li class="clearfix">
											<div class="invoice-sub">
												<p class="font-14 mb-5"> <strong class="weight-600 ">Shipping Charge :</strong> <strong class="font-18 text-danger"><?php echo $shipping_charge; ?></strong> </p>
											
												<?php
												if ($payment_mode == "COD") 
												{
												?>
												<p class="font-14 mb-5"> <strong class="weight-600 ">COD Charge :</strong> <strong class="font-18 text-danger">75</strong> </p>
													<?php	
												} 

												?>
											<p class="font-14 mb-5"><strong class="weight-600">Payment Mode : </strong> <?php echo $payment_mode; ?></p>


												<?php
												if ($payment_mode == "razor") 
												{
												?>
												<p class="font-14 mb-5"><strong class="weight-600">Transation ID:</strong> <?php echo $insta_tran_id; ?></p>
												<?php	
												} 

												?>

												
										
											</div>

											<div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">₹ <?php echo $sub_total; ?></span></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<h4 class="text-center pb-20">Thank You!!</h4>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<br><br>
	<!-- js -->
	<script src="admin/vendors/scripts/core.js"></script>
	<script src="admin/vendors/scripts/script.min.js"></script>
	<script src="admin/vendors/scripts/process.js"></script>
	<script src="admin/vendors/scripts/layout-settings.js"></script>


</body>
</html>

