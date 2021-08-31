<?php

include('include/header.php');

include('connection.php');

?>

<?php



$stock_id = $_REQUEST['stock_id'];



$select1 ="SELECT * FROM stock JOIN product ON stock.pro_id = product.pro_id  WHERE stock.stock_id = $stock_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$pro_name = $data1['pro_name'];

	$stock = $data1['stock'];

}















if (isset($_REQUEST['submit'])) 

{

	

	$stock = $_REQUEST['stock'];

   



   





          $update = "UPDATE stock SET stock = '{$stock}' WHERE stock_id = $stock_id";

          $run = mysqli_query($conn,$update); 



          if ($run) 

          {

            unlink($delete_image);

            echo "<script> alert('Stock Updated..!!'); 

            window.location='stock.php';

            </script>";

          }

          else

          {

            echo "<script> alert('Something went wrong..!!'); 

            window.location='stock.php';

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

								<h4>Update Product Stock</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

								

									<li class="breadcrumb-item active" aria-current="page">Update Product Stock</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Product Name</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="pro_name" type="text" placeholder="Enter Url for click" value="<?php echo $pro_name; ?>" readonly="" >

							</div>

						</div>



							<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Stock</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="stock" type="text" placeholder="Enter Url for click" value="<?php echo $stock; ?>">

							</div>

						</div>

											

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Stock">

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