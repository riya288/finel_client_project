<?php

include('include/header.php');

include('connection.php');

?>

<?php



$long_banner_id = $_REQUEST['long_banner_id'];



$select1 ="SELECT * FROM long_banner WHERE long_banner_id = $long_banner_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$url = $data1['long_banner_url'];

	$image = $data1['long_banner_image'];

}















if (isset($_REQUEST['submit'])) 

{

	

	$long_banner_url = $_REQUEST['long_banner_url'];

     // for image upload



if ($_FILES['long_banner_image']['size'] > 0) 

  {



        // for image upload

      $image_name = basename($_FILES['long_banner_image']['name']);

      $tmp_name = $_FILES['long_banner_image']['tmp_name']; 

      if (isset($image_name)) 

      {

        $location = 'upload/long_banner/';

        $move = move_uploaded_file($tmp_name, $location.$image_name);

        $delete_image = $location.$image;

      }







          $update = "UPDATE long_banner SET long_banner_image = '{$image_name}', long_banner_url = '{$long_banner_url}' WHERE long_banner_id = $long_banner_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            unlink($delete_image);

            echo "<script> alert('Long Banner Updated..!!'); 

            window.location='long_banner.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='long_banner.php';

            </script>";

          }





  }

  else

  {





    $update = "UPDATE long_banner SET long_banner_url = '{$long_banner_url}' WHERE long_banner_id = $long_banner_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('long Banner Updated..!!'); 

      window.location='long_banner.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='long_banner.php';

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

								<h4>Update Long Banner</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Update Long Bannner</li>

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

								<input class="form-control" name="long_banner_url" type="text" placeholder="Enter Url for click" value="<?php echo $url; ?>">

							</div>

						</div>

						<img src="upload/long_banner/<?php echo $image; ?>" style="width: 500px; height: 100px; margin-left: 17%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="long_banner_image" type="file">

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