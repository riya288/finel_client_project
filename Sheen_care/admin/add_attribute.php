<?php

include('include/header.php');

include('connection.php');

?>

<?php

if (isset($_REQUEST['submit'])) 

{

    $attribute = $_REQUEST['attribute'];
    
    $insert = "INSERT INTO attribute(attribute) VALUES ('{$attribute}')";

    $run = mysqli_query($conn,$insert); 



    if ($run) 

    {

      echo "<script> alert('Attribute Added..!!'); 

      window.location='attribute.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='add_attribute.php';

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

								<h4>Add Attribute</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Add Attribute</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Attribute</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="attribute" type="text" placeholder="Enter Attribute Name">

							</div>

						</div>

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Add New Attribute">

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