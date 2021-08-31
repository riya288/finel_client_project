<?php

include('include/header.php');

include('connection.php');

?>

<?php





$term_condition_id = $_REQUEST['term_condotion_id'];





// for display 

$select1 ="SELECT * FROM term_condition WHERE term_condition_id = $term_condition_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$dterm_condition = $data1['term_condition'];

}









// for update



if (isset($_REQUEST['submit'])) 

{



	$term_condition = $_REQUEST['term_condition'];

    











   $update = "UPDATE term_condition SET term_condition='{$term_condition}' WHERE term_id = $term_condition_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('privacy policy Updated..!!'); 

      window.location='term_condition.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='term_condition.php';

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

								<h4>Update Term Condition</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Term Condition</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

				



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Term condition</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor form-control border-radius-0" name="term_condition" placeholder="Long Description ..."><?php echo $dterm_condition; ?></textarea>



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