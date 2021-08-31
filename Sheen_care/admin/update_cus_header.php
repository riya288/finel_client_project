<?php

include('include/header.php');

include('connection.php');

?>

<?php



$header_text_id = $_REQUEST['header_text_id'];



$select1 ="SELECT * FROM header_text WHERE header_text_id = $header_text_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$header_text = $data1['header_text'];


}



if (isset($_REQUEST['submit'])) 

{

	

	$header_text = $_REQUEST['header_text'];   





          $update = "UPDATE header_text SET header_text = '{$header_text}' WHERE header_text_id = $header_text_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 
          {


            echo "<script> 

            window.location='cus_header.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='cus_header.php';

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

								<h4>Update Header Text</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Header Text</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Header Text</label>

							<div class="col-sm-12 col-md-10">

								<!-- <input class="form-control" name="header_text" type="text" placeholder="Enter Url for click"  > -->

								<textarea class="textarea_editor form-control"   name="header_text" placeholder="Enter Url for click"><?php echo $header_text; ?></textarea>


							</div>

						</div>



		
						</div>

											

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Header Text">

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