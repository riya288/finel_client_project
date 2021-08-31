<?php
session_start();
unset($_SESSION['admin']);
	echo "<script>  
	alert('Logout Success..!!'); 
	window.location='index.php';
	</script>";
?>