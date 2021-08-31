<?php

include('include/header.php');

include('connection.php');

?>

<?php





$cancellation_return_policy_id = $_REQUEST['cancellation_return_policy_id'];





// for display 

$select1 ="SELECT * FROM cancellation_return_policy WHERE cancellation_return_policy_id = $cancellation_return_policy_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$cancellation_return_policy = $data1['cancellation_return_policy'];

}









// for update



if (isset($_REQUEST['submit'])) 

{



	$cancellation_return_policy = $_REQUEST['cancellation_return_policy'];

    











   $update = "UPDATE cancellation_return_policy SET cancellation_return_policy = '{$cancellation_return_policy}' WHERE cancellation_return_policy_id = $cancellation_return_policy_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('cancellation return policy Updated..!!'); 

      window.location='cancellation_return_policy.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='cancellation_return_policy.php';

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

								<h4>Update Cancellation & Return Policy</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Update Cancellation & Return Policy</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

				



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Privacy Policy</label>

							<div class="col-sm-12 col-md-10">



							<textarea style="height: 40vh;" class="textarea_editor form-control border-radius-0" name="cancellation_return_policy" placeholder="Long Description ..."><?php echo $cancellation_return_policy; ?></textarea>



							</div>

						</div>



						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update cancellation return policy">

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