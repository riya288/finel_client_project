<?php

include('connection.php');



if (isset($_REQUEST['cate_id'])) 

{

	$cate_id = $_REQUEST['cate_id'];





	$query = "DELETE FROM root_category WHERE  root_category_id = $cate_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='root_category.php' </script>";

	}

}





if (isset($_REQUEST['slider_id'])) 

{

	$slider_id = $_REQUEST['slider_id'];





	$query = "DELETE FROM slider WHERE  slider_id = $slider_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='slider.php' </script>";

	}

}





if (isset($_REQUEST['long_banner_id'])) 

{

	$long_banner_id = $_REQUEST['long_banner_id'];





	$query = "DELETE FROM long_banner WHERE  long_banner_id = $long_banner_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='long_banner.php' </script>";

	}

}



if (isset($_REQUEST['banner_id'])) 

{

	$banner_id = $_REQUEST['banner_id'];





	$query = "DELETE FROM banner WHERE  banner_id = $banner_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='mini_banner.php' </script>";

	}

}









if (isset($_REQUEST['pro_id'])) 

{

	$pro_id = $_REQUEST['pro_id'];



	$stock_query = "DELETE FROM stock WHERE  pro_id = $pro_id";

	$stock_run= mysqli_query($conn,$stock_query);



	if ($stock_run) 

	{

		

			$query = "DELETE FROM product WHERE  pro_id = $pro_id";

			$run= mysqli_query($conn,$query);



		echo "<script> alert('Delete Success..!!'); 

		window.location='product.php' </script>";

	}

}







if (isset($_REQUEST['loc_id'])) 

{

	$loc_id = $_REQUEST['loc_id'];





	$query = "DELETE FROM location WHERE  loc_id = $loc_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='location.php' </script>";

	}

}







if (isset($_REQUEST['inquiry_id'])) 

{

	$inquiry_id = $_REQUEST['inquiry_id'];





	$query = "DELETE FROM inquiry WHERE  inquiry_id = $inquiry_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='inquiry.php' </script>";

	}

}







if (isset($_REQUEST['blog_id'])) 

{

	$blog_id = $_REQUEST['blog_id'];





	$query = "DELETE FROM blog WHERE  blog_id = $blog_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='blog.php' </script>";

	}

}



if (isset($_REQUEST['promocode_id'])) 

{

	$promocode_id = $_REQUEST['promocode_id'];





	$query = "DELETE FROM promocode WHERE  promocode_id = $promocode_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='promocode.php' </script>";

	}

}







if (isset($_REQUEST['sub_category_id'])) 

{

	$sub_category_id = $_REQUEST['sub_category_id'];





	$query = "DELETE FROM sub_category WHERE  sub_category_id = $sub_category_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='sub_category.php' </script>";

	}

}





if (isset($_REQUEST['child_category_id'])) 

{

	$child_category_id = $_REQUEST['child_category_id'];





	$query = "DELETE FROM child_category WHERE  child_category_id = $child_category_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='child_category.php' </script>";

	}

}


if (isset($_REQUEST['store_id'])) 

{

	$store_id = $_REQUEST['store_id'];





	$query = "DELETE FROM store WHERE  store_id = $store_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='store.php' </script>";

	}

}

if (isset($_REQUEST['category_id'])) 

{

	$category_id = $_REQUEST['category_id'];





	$query = "DELETE FROM category WHERE  category_id = $category_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='category.php' </script>";

	}

}

if (isset($_REQUEST['shop_product_id'])) 

{

	$shop_product_id = $_REQUEST['shop_product_id'];





	$query = "DELETE FROM shop_product WHERE  shop_product_id = $shop_product_id";

	$run= mysqli_query($conn,$query);



	if ($run) 

	{

		echo "<script> alert('Delete Success..!!'); 

		window.location='shop_product.php' </script>";

	}

}
?>