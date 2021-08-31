<?php

include('connection.php');



if (isset($_REQUEST['pincode']))

{

	$search_value = $_REQUEST['pincode'];





	$sql = "SELECT * FROM location WHERE pincode = {$search_value} ";



	$result = mysqli_query($conn, $sql);



		if(mysqli_num_rows($result) > 0 )

		{		

				while ($data = mysqli_fetch_array($result)) 

				{

					$output = $data;

				}

				

				echo json_encode($output);



		}

		else

		{

		 echo "false";

		}  

}







if (isset($_REQUEST['root_category_id'])) 

{



	

    		$root_category_id = $_POST['root_category_id'];



			// Fetch state name base on country id

			$query = "SELECT * FROM sub_category WHERE root_category_id = {$root_category_id}";



			$result = mysqli_query($conn,$query);



			if (mysqli_num_rows($result) > 0) 

			{

				echo '<option hidden=""> -- Select Sub Category --</option>';

		 	   while ($data = mysqli_fetch_array($result)) 

		 	   {

			        

		 	   	echo '<option value="'.$data['sub_category_id'].'">'.$data['sub_category'].'</option>';



		 	   }
			}

			else

			{

	    		echo 'Not available'; 

			}



}







if (isset($_REQUEST['sub_category_id'])) 

{



	

    		$sub_category_id = $_POST['sub_category_id'];



			// Fetch state name base on country id

			$query = "SELECT * FROM child_category WHERE sub_category_id = {$sub_category_id}";



			$result = mysqli_query($conn,$query);



			if (mysqli_num_rows($result) > 0) 

			{

				echo '<option hidden=""> -- Select Child Category --</option>';

		 	   while ($data = mysqli_fetch_array($result)) 

		 	   {

			        

		 	   	echo '<option value="'.$data['child_category_id'].'">'.$data['child_category'].'</option>';



		 	   }
		 	   echo '<option value="">None</option>';

			}

			else

			{

	    		echo 'Not available'; 

			}



}









?>