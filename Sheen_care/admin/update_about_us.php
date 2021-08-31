<?php
include('include/header.php');
include('connection.php');
?>
<?php


$about_us_id = $_REQUEST['about_us_id'];


// for display 
$select1 ="SELECT * FROM about_us WHERE about_us_id = $about_us_id";
$run1 = mysqli_query($conn, $select1);

while ($data1 = mysqli_fetch_array($run1)) 
{
	$dabout_title = $data1['about_title'];
	$dabout_description = $data1['about_description'];
	$dcompany_description = $data1['company_description'];
	$dteam_description = $data1['team_description'];
	$dtestimonial_description = $data1['testimonial_description'];
	$dabout_image = $data1['about_image'];
}




// for update

if (isset($_REQUEST['submit'])) 
{

	$about_title = $_REQUEST['about_title'];
	
		
	$about_description = $_REQUEST['about_description'];
	
	$company_description = $_REQUEST['company_description'];
	
	$team_description = $_REQUEST['team_description'];
	$testimonial_description = $_REQUEST['testimonial_description'];
		




if ($_FILES['about_image']['size'] > 0) 
  {

		   // for image upload
		  $image_name = basename($_FILES['about_image']['name']);
		  $tmp_name = $_FILES['about_image']['tmp_name']; 
		  if (isset($image_name)) 
		  {
		    $location = 'upload/about_us/';
		    $move = move_uploaded_file($tmp_name, $location.$image_name);
		     $delete_image = $location.$dabout_image;
		  }



          $update = "UPDATE about_us SET about_title = '{$about_title}', about_description = '{$about_description}' , company_description = '{$company_description}', team_description = '{$team_description}', testimonial_description = '{$testimonial_description}', about_image = '{$image_name}' WHERE about_us_id = $about_us_id";
          $run = mysqli_query($conn,$update); 

          if ($run) 
          {
            unlink($delete_image);
            echo "<script> alert('about us Updated..!!'); 
            window.location='about.php';
            </script>";
          }
          else
          {
            echo "<script> alert('Something went wrong..!!'); 
            window.location='about.php';
            </script>";
          }


  }
  else
  {


          $update = "UPDATE about_us SET about_title = '{$about_title}', about_description = '{$about_description}' , company_description = '{$company_description}', team_description = '{$team_description}', testimonial_description = '{$testimonial_description}' WHERE about_us_id = $about_us_id";
    $run = mysqli_query($conn,$update); 

    if ($run == true) 
    {
      echo "<script> alert('about us Updated..!!'); 
      window.location='about.php';
      </script>";
    }
    else
    {
      echo "<script> alert('Something went wrong..!!'); 
      window.location='about.php';
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
								<h4>Update About Us</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item active" aria-current="page">Update About Us</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					
					<form action="" method="POST" enctype="multipart/form-data">
						
				
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">About Title</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" name="about_title" type="text" placeholder="Enter Blog Title" value="<?php echo $dabout_title; ?>">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">About Description</label>
							<div class="col-sm-12 col-md-10">
								<textarea class="textarea_editor form-control" name="about_description" placeholder="Description.."><?php echo $dabout_description; ?></textarea>
								
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Aim</label>
							<div class="col-sm-12 col-md-10">

							<textarea class="form-control border-radius-0" name="company_description" placeholder="Description ..."><?php echo $dcompany_description; ?></textarea>

							</div>
						</div>


						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Focus</label>
							<div class="col-sm-12 col-md-10">

							<textarea class="form-control border-radius-0" name="team_description" placeholder="Description ..."><?php echo $dteam_description; ?></textarea>

							</div>
						</div>


						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Mission </label>
							<div class="col-sm-12 col-md-10">

							<textarea class="form-control border-radius-0" name="testimonial_description" placeholder="Description ..."><?php echo $dtestimonial_description; ?></textarea>

							</div>
						</div>

						<img src="upload/about_us/<?php echo $dabout_image; ?>" style="width: 100px; height: 100px; margin-left: 20%; margin-bottom: 1vh;">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">About Image</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" name="about_image" type="file">
							</div>
						</div>						
						
						<div class="text-center">
							<input class="btn btn-success" type="submit" name="submit" value="Update About us">
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