<?php

include('include/header.php');

include('connection.php');

?>

<?php





if (isset($_REQUEST['submit'])) 

{

    $category = $_REQUEST['category'];
    
    $insert = "INSERT INTO category(category) VALUES ('{$category}')";

    $run = mysqli_query($conn,$insert); 



    if ($run) 

    {

      echo "<script> alert('category Added..!!'); 

      window.location='category.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='add_category.php';

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

								<h4>Add Category</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Add Category</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Category</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="category" type="text" placeholder="Enter Category Name">

							</div>

						</div>

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Add New Category">

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