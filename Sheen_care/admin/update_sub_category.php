<?php

include('include/header.php');

include('connection.php');







// for display

$sub_category_id = $_GET['sub_category_id'];



$select = "SELECT * FROM sub_category JOIN root_category ON sub_category.root_category_id = root_category.root_category_id WHERE sub_category.sub_category_id = '{$sub_category_id}'";

$run = mysqli_query($conn,$select);



while ($res = mysqli_fetch_array($run)) 

{

  $root_category = $res['root_category'];

  $root_category_id = $res['root_category_id'];

  $sub_category = $res['sub_category'];

}



?>



<?php





if (isset($_REQUEST['submit'])) 

{

    $root_category_id = $_REQUEST['root_category_id'];

    $sub_category = $_REQUEST['sub_category'];





   

    $update = "UPDATE sub_category SET sub_category = '{$sub_category}', root_category_id = '{$root_category_id}' WHERE sub_category_id = $sub_category_id";

    $run = mysqli_query($conn,$update); 



    if ($run) 

    {

      echo "<script> alert('sub category Update..!!'); 

      window.location='sub_category.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='update_sub_category.php';

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

								<h4>Update Sub Category</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Update Sub Category</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Root Category</label>

							<div class="col-sm-12 col-md-10">



								<select name="root_category_id" class="form-control">

									<option hidden="" value="<?php echo $root_category_id; ?>"><?php echo $root_category; ?></option>

									

									<?php 

										$select_root_category = "SELECT * FROM root_category";

										$run_root_category = mysqli_query($conn,$select_root_category);

										while ($root_category_data = mysqli_fetch_array($run_root_category)) 

										{

										?>

									<option value="<?php echo $root_category_data['root_category_id']; ?>"><?php echo $root_category_data['root_category']; ?></option>



										<?php

										}

									?>

								</select>

							</div>

						</div>





						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Sub Category</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="sub_category" type="text" placeholder="Enter Sub Category Name" value="<?php echo $sub_category; ?>">

							</div>

						</div>



						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Sub Category">

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