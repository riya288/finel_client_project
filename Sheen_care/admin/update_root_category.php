<?php

include('include/header.php');

include('connection.php');







// for display

$cate_id = $_GET['cate_id'];



$select = "SELECT * FROM root_category WHERE root_category_id = '{$cate_id}'";

$run = mysqli_query($conn,$select);



while ($res = mysqli_fetch_array($run)) 

{

  $cate_name = $res['root_category'];

  $cate_image = $res['root_category_image'];

}



?>

<?php



// for insert

if (isset($_REQUEST['submit'])) 

{

    $category_name = $_REQUEST['category_name'];

    $category_image = $_REQUEST['category_image'];









  if ($_FILES['category_image']['size'] > 0) 

  {



        // for image upload

      $image_name = basename($_FILES['category_image']['name']);

      $tmp_name = $_FILES['category_image']['tmp_name']; 

      if (isset($image_name)) 

      {

        $location = 'upload/category/';

        $move = move_uploaded_file($tmp_name, $location.$image_name);

        $delete_image = $location.$cate_image;

      }







          $update = "UPDATE root_category SET root_category = '{$category_name}', root_category_image = '{$image_name}' WHERE root_category_id = $cate_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            unlink($delete_image);

            echo "<script> alert('category Updated..!!'); 

            window.location='root_category.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='root_category.php';

            </script>";

          }





  }

  else

  {





    $update = "UPDATE root_category SET root_category = '{$category_name}' WHERE root_category_id = $cate_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('category Updated..!!'); 

      window.location='root_category.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='root_category.php';

      </script>";

    }



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

								<h4>Update Category</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								
									<li class="breadcrumb-item active" aria-current="page">Update Category</li>

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

								<input class="form-control" name="category_name" type="text" value="<?php echo $cate_name; ?>" placeholder="Enter Category Name">

							</div>

						</div>

						<img src="upload/category/<?php echo $cate_image; ?>" style="width: 200px; height: 80px; margin-left: 17%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="category_image" type="file">

							</div>

						</div>						

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Category">

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