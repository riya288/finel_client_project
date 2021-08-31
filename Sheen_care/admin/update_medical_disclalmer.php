<?php

include('include/header.php');

include('connection.php');

?>

<?php





$medical_disclalmer_id = $_REQUEST['medical_disclalmer_id'];





// for display 

$select1 ="SELECT * FROM medical_disclalmer WHERE medical_disclalmer_id = $medical_disclalmer_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$medical_disclalmer = $data1['medical_disclalmer'];

}









// for update



if (isset($_REQUEST['submit'])) 

{



	$medical_disclalmer = $_REQUEST['medical_disclalmer'];

    











   $update = "UPDATE medical_disclalmer SET medical_disclalmer = '{$medical_disclalmer}' WHERE medical_disclalmer_id = $medical_disclalmer_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('medical disclalmer Updated..!!');

      window.location='medical_disclalmer.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='medical_disclalmer.php';

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

								<h4>Update Medical Disclalmer</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Medical Disclalmer</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

				



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Medical Disclalmer</label>

							<div class="col-sm-12 col-md-10">



							<textarea style="height: 40vh;" class="textarea_editor form-control border-radius-0" name="medical_disclalmer" placeholder="Long Description ..."><?php echo $medical_disclalmer; ?></textarea>



							</div>

						</div>



						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Medical Disclalmer">

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