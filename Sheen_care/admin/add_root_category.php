<?php

include('include/header.php');

include('connection.php');

?>

<?php





if (isset($_REQUEST['submit'])) 

{

    $category_name = $_REQUEST['category_name'];



     // for image upload



  $image_name = basename($_FILES['category_image']['name']);

  $tmp_name = $_FILES['category_image']['tmp_name']; 

  if (isset($image_name)) 

  {

    $location = 'upload/category/';

    $move = move_uploaded_file($tmp_name, $location.$image_name);

  }







    $insert = "INSERT INTO root_category(root_category,root_category_image) VALUES ('{$category_name}','{$image_name}')";

    $run = mysqli_query($conn,$insert); 



    if ($run) 

    {

      echo "<script> alert('category Added..!!'); 

      window.location='root_category.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='add_root_category.php';

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

								<input class="form-control" name="category_name" type="text" placeholder="Enter Category Name">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="category_image" type="file">

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