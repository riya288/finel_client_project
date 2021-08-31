<?php

include('include/header.php');

include('connection.php');

?>

<?php



$loc_id = $_REQUEST['loc_id'];



$select1 ="SELECT * FROM location WHERE loc_id = $loc_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$area = $data1['area'];

	$pincode = $data1['pincode'];

	$standard_charge = $data1['standard_charge'];

	$express_charge = $data1['express_charge'];

}





if (isset($_REQUEST['submit'])) 

{



	$area = $_REQUEST['area'];

	$pincode = $_REQUEST['pincode'];

	$standard_charge = $_REQUEST['standard_charge'];

    $express_charge = $_REQUEST['express_charge'];



 

  			$update = "UPDATE location SET area = '{$area}', pincode = '{$pincode}', standard_charge = '{$standard_charge}', express_charge = '{$express_charge}' WHERE loc_id = $loc_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            unlink($delete_image);

            echo "<script> alert('Location Updated..!!'); 

            window.location='location.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='location.php';

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

								<h4>Update Location</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									
									<li class="breadcrumb-item active" aria-current="page">Update Location</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

				

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Area</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="area" type="text" placeholder="Enter Blog Title" value="<?php echo $area; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Pincode</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="pincode" type="text" placeholder="Enter Blog Title" value="<?php echo $pincode; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Standard Charge</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="standard_charge" type="text" placeholder="Enter Blog Title" value="<?php echo $standard_charge; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Express Charge</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="express_charge" type="text" placeholder="Enter Blog Title" value="<?php echo $express_charge; ?>">

							</div>

						</div>

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Add New Location">

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

	<script src="editor-ckeditor.min.js" type="text/javascript"></script>



</body>

</html>