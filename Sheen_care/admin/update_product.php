<?php

include('include/header.php');

include('connection.php');

?>

<?php



$pro_id = $_REQUEST['pro_id'];
$select = "SELECT * FROM product WHERE pro_id = '{$pro_id}' ";
$run = mysqli_query($conn,$select);
$i=1;
$data = mysqli_fetch_array($run);
$sub_category_id= $data['sub_category_id'];
$child_category_id = $data['child_category_id'];
if(empty($sub_category_id) || $sub_category_id==0){
	$selectd = "SELECT * FROM product JOIN stock ON product.pro_id = stock.pro_id JOIN root_category ON product.root_category_id = root_category.root_category_id WHERE product.pro_id = '{$pro_id}'";
}
elseif (empty($child_category_id) && !empty($sub_category_id)) {
	$selectd = "SELECT * FROM product JOIN stock ON product.pro_id = stock.pro_id JOIN root_category ON product.root_category_id = root_category.root_category_id JOIN sub_category ON product.sub_category_id = sub_category.sub_category_id  WHERE product.pro_id = '{$pro_id}'";

}else if(!empty($child_category_id) && !empty($sub_category_id)){
	$selectd = "SELECT * FROM product JOIN stock ON product.pro_id = stock.pro_id JOIN root_category ON product.root_category_id = root_category.root_category_id JOIN sub_category ON product.sub_category_id = sub_category.sub_category_id JOIN child_category ON product.child_category_id = child_category.child_category_id WHERE product.pro_id = '{$pro_id}'";
}
// for display

// $selectd = "SELECT * FROM product JOIN stock ON product.pro_id = stock.pro_id JOIN root_category ON product.root_category_id = root_category.root_category_id JOIN sub_category ON product.sub_category_id = sub_category.sub_category_id JOIN child_category ON product.child_category_id = child_category.child_category_id WHERE product.pro_id = '{$pro_id}'";

$rund = mysqli_query($conn, $selectd);

while ($datad = mysqli_fetch_array($rund)) 

{

	$dpro_name = $datad['pro_name'];
	$dhot_deal = $datad['hot_deal'];
	$diconimage = $datad['iconimage'];

	$dprice = $datad['price'];
// 	$dweight = $datad['weight'];
	$dattribute = $datad['attribute'];

	$doffer_status = $datad['offer_status'];

	$doffer_price = $datad['offer_price'];

	$dpro_short_description = $datad['pro_short_description'];

	$dpro_long_description = $datad['pro_long_description'];

	$dpro_image1 = $datad['pro_image'];

	$dpro_image2 = $datad['pro_image2'];

	$dstock = $datad['stock'];

	

	$dcategory = $datad['root_category'];

	$dcategory_id = $datad['root_category_id'];



	$dsubcategory = $datad['sub_category'];

	$dsubcategory_id = $datad['sub_category_id'];



	$dchildcategory = $datad['child_category'];

	$dchildcategory_id = $datad['child_category_id'];



	$dproduct_rating = $datad['product_rating'];

	$dtotal_rating = $datad['total_rating'];

	   $ingredients = $datad['ingredients'];

    $key_benefits = $datad['key_benefits'];

    

    

    $product_profile=$datad['product_profile'];

    $directions_to_use=$datad['directions_to_use'];

    $certifications=$datad['certifications'];

    $general_info=$datad['general_info'];



         $single_image1=$datad['single_image1'];

      $single_image2=$datad['single_image2'];

       $single_image3=$datad['single_image3'];

        $single_image4=$datad['single_image4'];





}





// for update

if (isset($_REQUEST['submit'])) 

{

    $category_id = $_REQUEST['category_id'];

    $hot_deal = $_REQUEST['hot_deal'];

    $sub_category_id = $_REQUEST['sub_category_id'];

    	$iconimage = $_REQUEST['iconimage'];

    $child_category_id = $_REQUEST['child_category_id'];

    

    

    $pro_name = $_REQUEST['pro_name'];

    $price = $_REQUEST['price'];
    // $weight = $_REQUEST['weight'];
    $attribute = $_REQUEST['attribute'];

    $offer_price = $_REQUEST['offer_price'];

    $stock = $_REQUEST['stock'];



    $offer_status = $_REQUEST['offer_status'];



    $pro_short_description = $_REQUEST['pro_short_description'];

    $pro_long_description = $_REQUEST['pro_long_description'];

    $total_rating = $_REQUEST['total_rating'];

    $review_rating = $_REQUEST['review_rating'];

       $ingredients = $_REQUEST['ingredients'];

    $key_benefits = $_REQUEST['key_benefits'];

    

    

    $product_profile=$_REQUEST['product_profile'];

    $directions_to_use=$_REQUEST['directions_to_use'];

    $certifications=$_REQUEST['certifications'];

    $general_info=$_REQUEST['general_info'];

















   if ($_FILES['pro_image2']['size'] > 0 &&  $_FILES['pro_image1']['size'] > 0) 

  {



	// for image upload



	  $image_name2 = basename($_FILES['pro_image2']['name']);

	  $tmp_name = $_FILES['pro_image2']['tmp_name']; 

	  if (isset($image_name2)) 

	  {

	    $location = 'upload/product/';

	    $move = move_uploaded_file($tmp_name, $location.$image_name2);

	    $delete_image2 = $location.$dpro_image2;

	  }



	  	// for image upload



	  $image_name1 = basename($_FILES['pro_image1']['name']);

	  $tmp_name = $_FILES['pro_image1']['tmp_name']; 

	  if (isset($image_name1)) 

	  {

	    $location = 'upload/product/';

	    $move = move_uploaded_file($tmp_name, $location.$image_name1);

	   	$delete_image1 = $location.$dpro_image1;



	  }







        

       $update3 = "UPDATE product SET root_category_id = '{$category_id}',sub_category_id = '{$sub_category_id}',child_category_id = '{$child_category_id}', pro_name = '{$pro_name}', pro_short_description = '{$pro_short_description}', pro_long_description = '{$pro_long_description}', ingredients = '{$ingredients}', key_benefits = '{$key_benefits}',product_profile='{$product_profile}',directions_to_use='{$directions_to_use}',

            certifications='{$certifications}',general_info='{$general_info}',price = '{$price}', offer_price = '{$offer_price}',weight = '',attribute = '{$attribute}', offer_status = '{$offer_status}', pro_image = '{$image_name1}', pro_image2 = '{$image_name2}', product_rating ='{$review_rating}', total_rating ='{$total_rating}', hot_deal ='{$hot_deal}', iconimage ='{$iconimage}' WHERE pro_id = '{$pro_id}'";

        
        $run3 = mysqli_query($conn,$update3); 





          if ($run3) 

          {

                 unlink($delete_image2);

                 unlink($delete_image1);

                echo "<script> alert('product Updated..!!'); 

                window.location='product.php';

                </script>";

                

          

          }

          else

          {

            echo "<script> alert('Something went wrong.. 1!!'); 

            window.location='product.php';

            </script>";

          }

      

  }



 	elseif ($_FILES['pro_image1']['size'] > 0) 

  {

     

	// for image upload



	  $image_name1 = basename($_FILES['pro_image1']['name']);

	  $tmp_name = $_FILES['pro_image1']['tmp_name']; 

	  if (isset($image_name1)) 

	  {

	    $location = 'upload/product/';

	    $move = move_uploaded_file($tmp_name, $location.$image_name1);

	   	$delete_image1 = $location.$dpro_image1;



	  }







       $update = "UPDATE product SET root_category_id = '{$category_id}',sub_category_id = '{$sub_category_id}',child_category_id = '{$child_category_id}', pro_name = '{$pro_name}', pro_short_description = '{$pro_short_description}', pro_long_description = '{$pro_long_description}', ingredients = '{$ingredients}', key_benefits = '{$key_benefits}', product_profile='{$product_profile}',directions_to_use='{$directions_to_use}',

            certifications='{$certifications}',general_info='{$general_info}',

       price = '{$price}', offer_price = '{$offer_price}',weight = '',attribute = '{$attribute}', offer_status = '{$offer_status}', pro_image = '{$image_name1}', pro_image2 = '{$dpro_image2}', product_rating ='{$review_rating}', total_rating ='{$total_rating}', hot_deal ='{$hot_deal}', iconimage ='{$iconimage}' WHERE pro_id = '{$pro_id}'";

       $run = mysqli_query($conn,$update); 





          if ($run) 

          {

                 unlink($delete_image1);

                echo "<script> alert('product Updated..!!'); 

                window.location='product.php';

                </script>";

                

          

          }

          else

          {

            echo "<script> alert('Something went wrong..2!!'); 

            window.location='product.php';

            </script>";

          }

      

  }

  elseif ($_FILES['pro_image2']['size'] > 0) 

  {



	// for image upload



	  $image_name2 = basename($_FILES['pro_image2']['name']);

	  $tmp_name = $_FILES['pro_image2']['tmp_name']; 

	  if (isset($image_name2)) 

	  {

	    $location = 'upload/product/';

	    $move = move_uploaded_file($tmp_name, $location.$image_name2);

	    $delete_image2 = $location.$dpro_image2;

	  }





       $update3 = "UPDATE product SET root_category_id = '{$category_id}',sub_category_id = '{$sub_category_id}', child_category_id = '{$child_category_id}',pro_name = '{$pro_name}', pro_short_description = '{$pro_short_description}', pro_long_description = '{$pro_long_description}', ingredients = '{$ingredients}', key_benefits = '{$key_benefits}',product_profile='{$product_profile}',directions_to_use='{$directions_to_use}',

            certifications='{$certifications}',general_info='{$general_info}',

       price = '{$price}', offer_price = '{$offer_price}',weight = '',attribute = '{$attribute}', offer_status = '{$offer_status}', pro_image = '{$dpro_image1}', pro_image2 = '{$image_name2}', product_rating ='{$review_rating}', total_rating ='{$total_rating}', hot_deal ='{$hot_deal}', iconimage ='{$iconimage}' WHERE pro_id = '{$pro_id}'";

        $run3 = mysqli_query($conn,$update3); 





          if ($run3) 

          {

                 unlink($delete_image2);

                echo "<script> alert('product Updated..!!'); 

                window.location='product.php';

                </script>";

                

          

          }

          else

          {

            echo "<script> alert('Something went wrong.. 3!!'); 

            window.location='product.php';

            </script>";

          }

      

  }

  else

  {



        		$update = "UPDATE product SET root_category_id = '{$category_id}',sub_category_id = '{$sub_category_id}',child_category_id = '{$child_category_id}', pro_name = '{$pro_name}', pro_short_description = '{$pro_short_description}', pro_long_description = '{$pro_long_description}', ingredients = '{$ingredients}', key_benefits = '{$key_benefits}',product_profile='{$product_profile}',directions_to_use='{$directions_to_use}',certifications='{$certifications}',general_info='{$general_info}',price = '{$price}', offer_price = '{$offer_price}',weight = '',attribute = '{$attribute}', offer_status = '{$offer_status}', product_rating ='{$review_rating}', total_rating ='{$total_rating}', hot_deal ='{$hot_deal}', iconimage ='{$iconimage}' WHERE pro_id = '{$pro_id}'";

      			$run = mysqli_query($conn,$update); 



            if ($run) 

            {

              echo "<script> alert('product Updated..!!'); 

              window.location='product.php';

              </script>";

            }

            else

            {

              echo "<script> alert('Something went wrong..4!!'); 

              window.location='product.php';

              </script>";

            }

  

  }

  

}

?>

<style type="text/css">

	 @import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

@import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

.switch {

  position: relative;

  display: inline-block;

  width: 60px;

  height: 34px;

}



.switch input { 

  opacity: 0;

  width: 0;

  height: 0;

}



.slider {

  position: absolute;

  cursor: pointer;

  top: 0;

  left: 0;

  right: 0;

  bottom: 0;

  background-color: #ccc;

  -webkit-transition: .4s;

  transition: .4s;

}



.slider:before {

  position: absolute;

  content: "";

  height: 26px;

  width: 26px;

  left: 4px;

  bottom: 4px;

  background-color: white;

  -webkit-transition: .4s;

  transition: .4s;

}



input:checked + .slider {

  background-color: #2196F3;

}



input:focus + .slider {

  box-shadow: 0 0 1px #2196F3;

}



input:checked + .slider:before {

  -webkit-transform: translateX(26px);

  -ms-transform: translateX(26px);

  transform: translateX(26px);

}



/* Rounded sliders */

.slider.round {

  border-radius: 34px;

}



.slider.round:before {

  border-radius: 50%;

}



</style>



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



								<select class="form-control" name="category_id" id="category">

									<option value="<?php echo $dcategory_id; ?>" hidden=""><?php echo $dcategory; ?></option>

									<?php

										$select1 = "SELECT * FROM root_category";

										$run1 = mysqli_query($conn, $select1);

										while ($data1 = mysqli_fetch_array($run1)) 

											{

											?>

											<option value="<?php echo $data1['root_category_id']; ?>"><?php echo $data1['root_category']; ?></option>

											<?php

										}

									?>

								</select>

								<!-- <input class="form-control" name="category_name" type="text" placeholder="Enter Category Name"> -->

							</div>

						</div>

						



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Sub Category</label>

							<div class="col-sm-12 col-md-10">

								<select class="form-control" name="sub_category_id" id="sub_category">

									

									<option hidden="" value="<?php echo $dsubcategory_id; ?>"><?php echo $dsubcategory; ?></option>



										<?php

										$select2 = "SELECT * FROM sub_category WHERE root_category_id = '{$dcategory_id}'";

										$run2 = mysqli_query($conn, $select2);

										while ($data2 = mysqli_fetch_array($run2)) 

											{

											?>

											<option value="<?php echo $data2['sub_category_id']; ?>"><?php echo $data2['sub_category']; ?></option>

											<?php

										}

									?>

									

								</select>

								<!-- <input class="form-control" name="category_name" type="text" placeholder="Enter Category Name"> -->

							</div>

						</div>











						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Child Category</label>

							<div class="col-sm-12 col-md-10">

								<select class="form-control" name="child_category_id" id="sub_category">

									

									<option hidden="" value="<?php echo $dchildcategory_id; ?>"><?php echo $dchildcategory; ?></option>



										<?php

										$select3 = "SELECT * FROM child_category WHERE sub_category_id = '{$dsubcategory_id}'";

										$run3 = mysqli_query($conn, $select3);

										while ($data3 = mysqli_fetch_array($run3)) 

											{

											?>

											<option value="<?php echo $data3['child_category_id']; ?>"><?php echo $data3['child_category']; ?></option>

											<?php

										}

									?>

									<option value="">None</option>

								</select>

								<!-- <input class="form-control" name="category_name" type="text" placeholder="Enter Category Name"> -->

							</div>

						</div>







						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Product Name</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="pro_name" type="text" placeholder="Enter Product Name" value="<?php echo $dpro_name; ?>">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">MRP Price</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="price" type="text" placeholder="Enter Price" value="<?php echo $dprice; ?>">

							</div>

						</div>



							<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">offer Price</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="offer_price" type="text" placeholder="Enter Offer Price" value="<?php echo $doffer_price; ?>">

							</div>

						</div>
						<!--	<div class="form-group row">-->

						<!--	<label class="col-sm-12 col-md-2 col-form-label">Weight</label>-->

						<!--	<div class="col-sm-12 col-md-10">-->

						<!--		<input class="form-control" name="weight" type="text" placeholder="Enter Weight" value="<?php //echo $dweight; ?>">-->

						<!--	</div>-->

						<!--</div>-->
						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Weight</label>

						<div class="col-sm-12 col-md-10">

								<input class="form-control" name="attribute" type="text" placeholder="Enter Weight" value="<?php echo $dattribute; ?>">

							</div>

						</div>


						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Offer ON / OFF</label>

							<div class="col-sm-12 col-md-10">



       					<label class="switch">

       					<?php

       						if ($doffer_status > 0) 

       						{

       						?>

       							<input type="checkbox" name="ck_status" id="ck_status" checked>

       						<?php

       						}

       						else

       						{

       						?>

       						<input type="checkbox" name="ck_status" id="ck_status">

       						<?php

       						}



       					?>                      

 					

                      <span class="slider"></span>

             				</div>

						</div>

	<input type="text" name="offer_status" id="offer_status" value="<?php echo $doffer_status; ?>" hidden="">



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Short Description</label>

							<div class="col-sm-12 col-md-10">

								<textarea class="textarea_editor1 form-control" name="pro_short_description" placeholder="Short Description.." ><?php echo $dpro_short_description; ?></textarea>

								

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Long Description</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor2 form-control border-radius-0" name="pro_long_description" placeholder="Long Description ..."><?php echo $dpro_long_description; ?></textarea>



							</div>

						</div>







						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Key Benefits</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor3 form-control border-radius-0"  name="key_benefits" placeholder="key benefits ..."><?php echo $key_benefits; ?>

							</textarea>



							</div>

						</div>





						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Ingredients</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor4 form-control border-radius-0"  name="ingredients" placeholder="Ingredients ..."><?php echo $ingredients; ?>

							</textarea>



							</div>

						</div>

						

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Product Profile</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor5 form-control border-radius-0"  name="product_profile" placeholder="Product Profile ..."><?php echo $product_profile?></textarea>



							</div>

						</div>

						

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Directions to Use</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor6 form-control border-radius-0"  name="directions_to_use" placeholder="Directions to Use ..."><?php echo $directions_to_use ?></textarea>



							</div>

						</div>

						

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Certifications</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor7 form-control border-radius-0"  name="certifications" placeholder="Certifications ..."><?php echo $certifications?></textarea>



							</div>

						</div>

						

						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">General Info</label>

							<div class="col-sm-12 col-md-10">



							<textarea class="textarea_editor8 form-control border-radius-0"  name="general_info" placeholder="General Info ..."><?php echo $general_info?></textarea>



							</div>

						</div>

						







						<img src="upload/product/<?php echo $dpro_image1; ?>" style="width: 100px; height: 100px; margin-left: 20%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image 1</label>

							<div class="col-sm-12 col-md-10">
<span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
								<input class="form-control" name="pro_image1" type="file" value="upload/product/<?php echo $dpro_image1; ?>">

							</div>

						</div>

						

						<img src="upload/product/<?php echo $dpro_image2; ?>" style="width: 100px; height: 100px; margin-left: 20%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Upload Image 2</label>

							<div class="col-sm-12 col-md-10">
<span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
								<input class="form-control" name="pro_image2" type="file" value="upload/product/<?php echo $dpro_image2; ?>">

							</div>

						</div>	









						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Stock</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="stock" type="text" placeholder="Enter Total Quantity" c>

							</div>

						</div>		





							<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Total Rating</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="total_rating" type="text" placeholder="4 / 5 Like that.." value="<?php echo $dtotal_rating; ?>">

							</div>

						</div>







							<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Product Rating</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="review_rating" type="text" placeholder="Show Total star " value="<?php echo $dproduct_rating; ?>">

							</div>

						</div>




						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Hot Deal</label>
							<div class="col-sm-12 col-md-10">
								<select class="form-control" name="hot_deal" >

									<?php
									if ($dhot_deal == 0) 
									{
										?>
										<option value="0" hidden="">No</option>
										<?php
										
									}
									else
									{
										?>
										<option value="1" hidden="">Yes</option>
										<?php
									}
										 
									?>
									
									<option value="0">No</option>
									<option value="1">Yes</option>					
									

									

								</select>

								

							</div>

						</div>
							<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Show icon</label>
							<div class="col-sm-12 col-md-10">
								<select class="form-control" name="iconimage" >

									<?php
									if ($diconimage == 0) 
									{
										?>
										<option value="0" hidden="">No</option>
										<?php
										
									}
									else
									{
										?>
										<option value="1" hidden="">Yes</option>
										<?php
									}
										 
									?>
									
									<option value="0">No</option>
									<option value="1">Yes</option>					
									

									

								</select>

								

							</div>

						</div>



						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Update Product">

						</div>

									

					

					</form>

				

			

			</div>

			

			<div class="footer-wrap pd-20 mb-20 card-box" style="margin-top: 10vh;">

						 Product Details images</div>

		</div>

	</div>







					<div class="pd-20 card-box mb-30">

					<?php

					if (isset($_REQUEST['single_image1_btn'])) 

					{

							// for image upload



						  $usingle_image1 = basename($_FILES['usingle_image1']['name']);

						  $tmp_name = $_FILES['usingle_image1']['tmp_name']; 

						  if (isset($usingle_image1)) 

						  {

						    $location = 'upload/product/';

						    $move = move_uploaded_file($tmp_name, $location.$usingle_image1);

						    $delete_single_image1 = $location.$single_image1;

						  }





						$update_single_image1 = "UPDATE product SET single_image1 = '{$usingle_image1}' WHERE pro_id = '{$pro_id}'";

						$run_single_image1 = mysqli_query($conn,$update_single_image1);



						if ($run_single_image1) 

						{

							unset($delete_single_image1);



							echo "<script> alert('Product Image 1 is Updated'); 

							window.location='product.php';

							</script>";





						}

					}

					

					?>

					<form action="" method="POST" enctype="multipart/form-data">

						



						<img src="upload/product/<?php echo $single_image1; ?>" style="width: 100px; height: 100px; margin-left: 20%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Single Image 1</label>

							<div class="col-sm-12 col-md-10">
<span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
								<input class="form-control" name="usingle_image1" type="file" value="upload/product/<?php echo $dpro_image2; ?>">

							</div>

						</div>	

						



						<div class="text-center">

							<input class="btn btn-success" type="submit" name="single_image1_btn" value="Update Image">

						</div>

									

					

					</form>







									



				

			

			</div>











				<div class="pd-20 card-box mb-30">

					<?php

					if (isset($_REQUEST['single_image2_btn'])) 

					{

							// for image upload



						  $usingle_image2 = basename($_FILES['usingle_image2']['name']);

						  $tmp_name = $_FILES['usingle_image2']['tmp_name']; 

						  if (isset($usingle_image2)) 

						  {

						    $location = 'upload/product/';

						    $move = move_uploaded_file($tmp_name, $location.$usingle_image2);

						    $delete_single_image2 = $location.$single_image2;

						  }





						$update_single_image2 = "UPDATE product SET single_image2 = '{$usingle_image2}' WHERE pro_id = '{$pro_id}'";

						$run_single_image2 = mysqli_query($conn,$update_single_image2);



						if ($run_single_image2) 

						{

							unset($delete_single_image2);



							echo "<script> alert('Product Image 2 is Updated'); 

							window.location='product.php';

							</script>";

							





						}

					}

					

					?>

					<form action="" method="POST" enctype="multipart/form-data">

						



						<img src="upload/product/<?php echo $single_image2; ?>" style="width: 100px; height: 100px; margin-left: 20%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Single Image 2</label>

							<div class="col-sm-12 col-md-10">
<span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
								<input class="form-control" name="usingle_image2" type="file" value="upload/product/<?php echo $dpro_image2; ?>">

							</div>

						</div>	

						



						<div class="text-center">

							<input class="btn btn-success" type="submit" name="single_image2_btn" value="Update Image">

						</div>

									

					

					</form>







									



				

			

			</div>











				<div class="pd-20 card-box mb-30">

					<?php

					if (isset($_REQUEST['single_image3_btn'])) 

					{

							// for image upload



						  $usingle_image3 = basename($_FILES['usingle_image3']['name']);

						  $tmp_name = $_FILES['usingle_image3']['tmp_name']; 

						  if (isset($usingle_image3)) 

						  {

						    $location = 'upload/product/';

						    $move = move_uploaded_file($tmp_name, $location.$usingle_image3);

						    $delete_single_image3 = $location.$single_image3;

						  }





						$update_single_image3 = "UPDATE product SET single_image3 = '{$usingle_image3}' WHERE pro_id = '{$pro_id}'";

						$run_single_image3 = mysqli_query($conn,$update_single_image3);



						if ($run_single_image3) 

						{

							unset($delete_single_image3);



							echo "<script> alert('Product Image 3 is Updated'); 

							window.location='product.php';

							</script>";





						}

					}

					

					?>

					<form action="" method="POST" enctype="multipart/form-data">

						



						<img src="upload/product/<?php echo $single_image3; ?>" style="width: 100px; height: 100px; margin-left: 20%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Single Image 3</label>

							<div class="col-sm-12 col-md-10">
<span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
								<input class="form-control" name="usingle_image3" type="file" value="upload/product/<?php echo $dpro_image3; ?>">

							</div>

						</div>	

						



						<div class="text-center">

							<input class="btn btn-success" type="submit" name="single_image3_btn" value="Update Image">

						</div>

									

					

					</form>







									



				

			

			</div>













				<div class="pd-20 card-box mb-30">

					<?php

					if (isset($_REQUEST['single_image4_btn'])) 

					{

							// for image upload



						  $usingle_image4 = basename($_FILES['usingle_image4']['name']);

						  $tmp_name = $_FILES['usingle_image4']['tmp_name']; 

						  if (isset($usingle_image4)) 

						  {

						    $location = 'upload/product/';

						    $move = move_uploaded_file($tmp_name, $location.$usingle_image4);

						    $delete_single_image4 = $location.$single_image4;

						  }





						$update_single_image4 = "UPDATE product SET single_image4 = '{$usingle_image4}' WHERE pro_id = '{$pro_id}'";

						$run_single_image4 = mysqli_query($conn,$update_single_image4);



						if ($run_single_image4) 

						{

							unset($delete_single_image4);



							

							echo "<script> alert('Product Image 4 is Updated'); 

							window.location='product.php';

							</script>";





						}

					}

					

					?>

					<form action="" method="POST" enctype="multipart/form-data">

						



						<img src="upload/product/<?php echo $single_image4; ?>" style="width: 100px; height: 100px; margin-left: 20%;">

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Single Image 4</label>

							<div class="col-sm-12 col-md-10">
<span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
								<input class="form-control" name="usingle_image4" type="file" value="upload/product/<?php echo $dpro_image4; ?>">

							</div>

						</div>	

						



						<div class="text-center">

							<input class="btn btn-success" type="submit" name="single_image4_btn" value="Update Image">

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



	<script>

		 

 $(document).ready(function(){

 

  $('#ck_status').on("change",function(){

    var x = $('#offer_status').val();



    if ( x > 0) 

    {

      $('#offer_status').val('0');

    }

    else

    {

      $('#offer_status').val('1');

    }



  });













  });



	</script>



	<script type="text/javascript">

		

  $("#category").on("click",function(){



  	var root_category_id = $(this).val();





  	$.ajax({



  		url: "ajax.php",

  		type: "POST",

  		data:{root_category_id:root_category_id},

  		success: function(data)

  		{

  			if (data == "Not available") 

  			{

  				$("#sub_category").html(data);

  			}

  			else

  			{

  				$("#sub_category").html(data);

  			}

  

  			

  		}

   	});





});



   	 jQuery(window).on("load",function() {

	"use strict";

	// bootstrap wysihtml5

	$('.textarea_editor1').wysihtml5({

		html: true

	});



	$('.textarea_editor2').wysihtml5({

		html: true

	});





	$('.textarea_editor3').wysihtml5({

		html: true

	});





	$('.textarea_editor4').wysihtml5({

		html: true

	});





	$('.textarea_editor5').wysihtml5({

		html: true

	});



	$('.textarea_editor6').wysihtml5({

		html: true

	});







	$('.textarea_editor7').wysihtml5({

		html: true

	});



	$('.textarea_editor8').wysihtml5({

		html: true

	});



	$('.textarea_editor9').wysihtml5({

		html: true

	});

});





	</script>

</body>

</html>