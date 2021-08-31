<?php

include('include/header.php');

include('connection.php');

?>

<?php



$slider_id = $_REQUEST['slider_id'];



$select1 ="SELECT * FROM slider WHERE slider_id = $slider_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$text1 = $data1['text1'];

	$text2 = $data1['text2'];

	$text3 = $data1['text3'];

	$url = $data1['slider_url'];

	$image = $data1['slider_image'];

}

















if (isset($_REQUEST['submit'])) 

{

	$slider_text1 = $_REQUEST['slider_text1'];

	$slider_text2 = $_REQUEST['slider_text2'];

	$slider_text3 = $_REQUEST['slider_text3'];

	$slider_url = $_REQUEST['slider_url'];

     // for image upload



if ($_FILES['slider_image']['size'] > 0) 

  {



        // for image upload

      $image_name = basename($_FILES['slider_image']['name']);

      $tmp_name = $_FILES['slider_image']['tmp_name']; 

      if (isset($image_name)) 

      {

        $location = 'upload/slider/';

        $move = move_uploaded_file($tmp_name, $location.$image_name);

        $delete_image = $location.$image;

      }







          $update = "UPDATE slider SET slider_image = '{$image_name}', slider_url = '{$slider_url}', text1 = '{$slider_text1}', text2 = '{$slider_text2}', text3 = '{$slider_text3}' WHERE slider_id = $slider_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            unlink($delete_image);

            echo "<script> alert('Slider Updated..!!'); 

            window.location='slider.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='slider.php';

            </script>";

          }





  }

  else

  {





    $update = "UPDATE slider SET slider_url = '{$slider_url}', text1 = '{$slider_text1}', text2 = '{$slider_text2}', text3 = '{$slider_text3}' WHERE slider_id = $slider_id";

    $run = mysqli_query($conn,$update); 



    if ($run == true) 

    {

      echo "<script> alert('Slider Updated..!!'); 

      window.location='slider.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='slider.php';

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

								<h4>Update Slider</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Slider</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Text 1</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="slider_text1" type="text" placeholder="Enter Text 1" value="<?php echo $text1; ?>" >

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Text 2</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="slider_text2" type="text" placeholder="Enter Text 2" value="<?php echo $text2; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Text 3</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="slider_text3" type="text" placeholder="Enter Text 3" value="<?php echo $text3; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Url</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="slider_url" type="text" placeholder="Enter Url for Button" value="<?php echo $url; ?>">

							</div>

						</div>

						<img src="upload/slider/<?php echo $image; ?>" style="width: 150px; height: 50px; margin-left: 17%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="slider_image" type="file">

							</div>

						</div>						

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Slider">

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