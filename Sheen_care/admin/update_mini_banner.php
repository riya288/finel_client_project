<?php

include('include/header.php');

include('connection.php');

?>

<?php



$banner_id = $_REQUEST['banner_id'];



$select1 ="SELECT * FROM banner WHERE banner_id = $banner_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$url = $data1['banner_url'];

	$image = $data1['banner_image'];

}















if (isset($_REQUEST['submit'])) 

{

	

	$mini_banner_url = $_REQUEST['mini_banner_url'];

     // for image upload



if ($_FILES['mini_banner_image']['size'] > 0) 

  {



        // for image upload

      $image_name = basename($_FILES['mini_banner_image']['name']);

      $tmp_name = $_FILES['mini_banner_image']['tmp_name']; 

      if (isset($image_name)) 

      {

        $location = 'upload/mini_banner/';

        $move = move_uploaded_file($tmp_name, $location.$image_name);

        $delete_image = $location.$image;

      }







          $update = "UPDATE banner SET banner_image = '{$image_name}', banner_url = '{$mini_banner_url}' WHERE banner_id = $banner_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            unlink($delete_image);

            echo "<script> alert('Mini Banner Updated..!!'); 

            window.location='mini_banner.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='mini_banner.php';

            </script>";

          }





  }

  else

  {





      $update = "UPDATE banner SET  banner_url = '{$mini_banner_url}' WHERE banner_id = $banner_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('Mini Banner Updated..!!'); 

      window.location='mini_banner.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='mini_banner.php';

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

								<h4>Update Mini Banner</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Mini Bannner</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

				

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Banner Url</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="mini_banner_url" type="text" placeholder="Enter Url for click" value="<?php echo $url; ?>">

							</div>

						</div>

						<img src="upload/mini_banner/<?php echo $image; ?>" style="width: 150px; height: 100px; margin-left: 17%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="mini_banner_image" type="file">

							</div>

						</div>						

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Banner">

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