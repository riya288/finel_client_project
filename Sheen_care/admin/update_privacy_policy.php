<?php

include('include/header.php');

include('connection.php');

?>

<?php





$privacy_policy_id = $_REQUEST['privacy_policy_id'];





// for display 

$select1 ="SELECT * FROM privacy_policy WHERE privacy_policy_id = $privacy_policy_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$dprivacy_policy = $data1['privacy_policy'];

}









// for update



if (isset($_REQUEST['submit'])) 

{

	$privacy_policy = $_REQUEST['privacy_policy'];

	





   $update = "UPDATE privacy_policy SET privacy_policy = '{$privacy_policy}' WHERE privacy_policy_id = $privacy_policy_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('privacy policy Updated..!!'); 

      window.location='privacy_policy.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='privacy_policy.php';

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

								<h4>Update privacy policy</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Update privacy policy</li>

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



							<textarea class="textarea_editor form-control border-radius-0" name="privacy_policy" placeholder="Long Description ..."><?php echo $dprivacy_policy; ?></textarea>



							</div>

						</div>



						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update privacy policy">

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