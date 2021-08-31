<?php

include('include/header.php');

include('connection.php');







// for display

$shop_product_id = $_GET['shop_product_id'];



$select = "SELECT * FROM shop_product JOIN category ON shop_product.category_id = category.category_id JOIN product ON shop_product.pro_id = product.pro_id WHERE shop_product.shop_product_id = '{$shop_product_id}'";

$run = mysqli_query($conn,$select);



while ($res = mysqli_fetch_array($run)) 

{

  $category = $res['category'];

  $category_id = $res['category_id'];
  $pro_id = $res['pro_id'];

  $shop_product = $res['pro_name'];

}



?>



<?php





if (isset($_REQUEST['submit'])) 

{

    $category_id = $_REQUEST['category_id'];

    $shop_product = $_REQUEST['shop_product'];





   

    $update = "UPDATE shop_product SET pro_id = '{$shop_product}', category_id = '{$category_id}' WHERE shop_product_id = $shop_product_id";

    $run = mysqli_query($conn,$update); 



    if ($run) 

    {

      echo "<script> alert('Product Update..!!'); 

      window.location='shop_product.php';

      </script>";

    }

    else

    {

      echo "<script> alert('Something went wrong..!!'); 

      window.location='update_shop_product.php';

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

								<h4>Update Product</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Update Product</li>

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



								<select name="category_id" class="form-control">

									<option hidden="" value="<?php echo $category_id; ?>"><?php echo $category; ?></option>

									

									<?php 

										$select_category = "SELECT * FROM category";

										$run_category = mysqli_query($conn,$select_category);

										while ($category_data = mysqli_fetch_array($run_category)) 

										{

										?>

									<option value="<?php echo $category_data['category_id']; ?>"><?php echo $category_data['category']; ?></option>



										<?php

										}

									?>

								</select>

							</div>

						</div>





					
						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Product</label>

							<div class="col-sm-12 col-md-10">



								<select name="shop_product" class="form-control">

									<option hidden="" value="<?php echo $pro_id; ?>"><?php echo $shop_product; ?></option>

									

								<?php 

										$select_category = "SELECT * FROM product";

										$run_category = mysqli_query($conn,$select_category);

										while ($category_data = mysqli_fetch_array($run_category)) 

										{

										?>

									<option value="<?php echo $category_data['pro_id']; ?>"><?php echo $category_data['pro_name']; ?></option>



										<?php

										}

									?>

								</select>

							</div>

						</div>


						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Product">

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