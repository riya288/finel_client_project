<?php

include('include/header.php');

include('connection.php');

?>

<?php





if (isset($_REQUEST['submit'])) 

{



	$blog_short_description = $_REQUEST['blog_short_description'];

	$blog_long_description = $_REQUEST['blog_long_description'];

	$blog_title = $_REQUEST['blog_title'];

    

   // for image upload

  $image_name = basename($_FILES['blog_image']['name']);

  $tmp_name = $_FILES['blog_image']['tmp_name']; 

  if (isset($image_name)) 

  {

    $location = 'upload/blog/';

    $move = move_uploaded_file($tmp_name, $location.$image_name);

  }







    $insert = "INSERT INTO blog(blog_title,blog_short_description,blog_long_description,blog_image) VALUES ('{$blog_title}','{$blog_short_description}','{$blog_long_description}','{$image_name}')";

    $run = mysqli_query($conn,$insert); 



    if ($run) 

    {

      echo "<script> alert('New Blog Added..!!'); 

      window.location='blog.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='blog.php';

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

								<h4>Add Blog</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Add Blog</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

				

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Blog Title</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="blog_title" type="text" placeholder="Enter Blog Title">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Short Description</label>

							<div class="col-sm-12 col-md-10">

								<textarea class="form-control" name="blog_short_description" placeholder="Short Description.."></textarea>

								

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Long Description</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor form-control border-radius-0" name="blog_long_description" placeholder="Long Description ..."></textarea>



							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Blog Image</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="blog_image" type="file">

							</div>

						</div>						

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Add New Blog">

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