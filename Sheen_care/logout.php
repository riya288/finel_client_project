<?php
session_start();

include('google-login/config.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();


unset($_SESSION['user']);
unset($_SESSION['user_name']);
unset($_SESSION['cust_id']);

	$_SESSION['status'] = "Logout Success";
	$_SESSION['code'] = "success";
?>

<!DOCTYPE html>
<html>
<?php include('includes/headerscript.php'); ?>

<body>


<script src="js/jquery-1.10.2.min.js"></script> 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
$status_alert = $_SESSION['status'];
if(isset($_SESSION['status']))
{
    if ($status_alert == "Logout Success") 
    {
      ?>
              <script>
              swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
              
              }).then(function() {
              window.location = "login.php";
              });
             </script>
    <?php
    }
    else
    {
    ?>
           <script>
              swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
              
              }).then(function() {
              window.location = "index.php";
              });
             </script>
<?php
}
unset($_SESSION['status']);
unset($_SESSION['code']);

}
?>
</body>
</html>