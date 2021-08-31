<?php

include('include/header.php');

include('connection.php');

?>

<?php



$order_id = $_REQUEST['order_id'];















if (isset($_REQUEST['submit'])) 

{

	

		$status = $_REQUEST['status'];

          $update = "UPDATE order_master SET order_status = '{$status}' WHERE order_id = $order_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            echo "<script> alert('Status Updated..!!'); 

            window.location='delivery_order.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='delivery_order.php';

            </script>";

          }





  

}







?>



	<div class="main-container">

		<div class="pd-ltr-20 xs-pd-20-10">

			<div class="min-height-200px">

				<div class="page-header">

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="title">

								<h4>Update Delivery Order</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Delivery Order</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Order Status</label>

							<div class="col-sm-12 col-md-10">



								<select class="form-control" name="status">

									<option value="Dispetch">Dispetch</option>

									<option value="Received">Received</option>



								</select>



							</div>

						</div>



					

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Status">

						</div>

									

					

					</form>

				

			

			</div>

			

			

		</div>

	</div>

	<!-- js -->

	<script src="vendors/scripts/core.js"></script>

	<script src="vendors/scripts/script.min.js"></script>

	<script src="vendors/scripts/process.js"></script>

	<script src="vendors/scripts/layout-settings.js"></script>

</body>

</html>