<?php

include('include/header.php');

include('connection.php');

?>

<?php



$promocode_id = $_REQUEST['promocode_id'];



$select = "SELECT * FROM promocode WHERE promocode_id = '{$promocode_id}'";

$run1 = mysqli_query($conn, $select);

while ($data1 = mysqli_fetch_array($run1)) 

{

	$promocode = $data1['promocode'];

	$discount = $data1['discount'];

}



if (isset($_REQUEST['submit'])) 

{



	$promocode = $_REQUEST['promocode'];

	$discount = $_REQUEST['discount'];



 



     $update = "UPDATE promocode SET promocode = '{$promocode}', discount = '{$discount}' WHERE promocode_id = $promocode_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('Promocode Updated..!!'); 

      window.location='promocode.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='promocode.php';

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

								<h4>Update Promocode</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Promocode</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST">

					

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Promocode</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="promocode" type="text" placeholder="Enter Promocode" value="<?php echo $promocode; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Discount Price</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="discount" type="text" placeholder="Enter Blog Title" value="<?php echo $discount; ?>">

							</div>

						</div>

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Promocede">

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