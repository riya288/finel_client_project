<?php
	
	error_reporting(0);

// 	$servername = "localhost";
// 	$username = "root";
// 	$password = "";
// 	$dbname = "sheencare_website";
	
    	 $servername = "localhost";
        	  $username = "sheencar_testuser";
	    $password = "nGA-PC%gBH1H";
	    $dbname = "sheencar_test_database";

	//connection
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	
	if($conn)
	{

	}
	else
	{
	echo "Connection failed...!!";
	}




?>