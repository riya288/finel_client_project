<?php

include('include/header.php');

include('connection.php');

session_start();

?>

<?php



$inquiry_id = $_REQUEST['inquiry_id'];



$select1 ="SELECT * FROM inquiry WHERE inquiry_id = $inquiry_id";

$run1 = mysqli_query($conn, $select1);



while ($data1 = mysqli_fetch_array($run1)) 

{

	$demail = $data1['email'];

	$dname = $data1['name'];

	$dsubject = $data1['subject'];
	
	$dcontact_for= $data1['contact_for'];




}


if (isset($_REQUEST['submit'])) 

{


	$name = $_REQUEST['name'];

	$to_email = $_REQUEST['to_email'];

	$subject = $_REQUEST['subject'];

	$message = $_REQUEST['message'];



      include('phpmailer/PHPMailerAutoload.php');
     
      
          $mail = new PHPMailer;
        

          $mail->isSMTP();

          $mail->Host = 'mail.sheencare.com';

          $mail->Port = 465;
  

          $mail->SMTPSecure = 'ssl';

          $mail->SMTPAuth = true;

          $mail->Username = 'info@sheencare.com';// enter your mail

          $mail->Password = '.J;%w5NA56I-';// enter pass

          $mail->setFrom('info@sheencare.com', 'SHEENCARE');  // Enter display email & name

          $mail->addReplyTo('info@sheencare.com', 'SHEENCARE');  // enter reply to mail & name


          $mail->addAddress($to_email);

          $mail->Subject = $subject;

          $mail->msgHTML($message);

          if (!$mail->send()) {
             $error = "Mailer Error: " . $mail->ErrorInfo;
            ?><script>alert('<?php echo $error ?>');</script><?php
          } 
          else 
          {
      
           $_SESSION['status']= "Reply Success";
           $_SESSION['code']= "success";
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

								<h4>Reply Inquiry</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									

									<li class="breadcrumb-item active" aria-current="page">Reply Inquiry</li>

								</ol>

							</nav>

						</div>

						

					</div>

				</div>

				<!-- Default Basic Forms Start -->

				<div class="pd-20 card-box mb-30">

					

					<form action="" method="POST" enctype="multipart/form-data">

						

					<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Contact For</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="to_email" type="text" placeholder="" value="<?php echo $dcontact_for; ?>" readonly="">

							</div>

						</div>
						
						
						
						

						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Email</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="to_email" type="text" placeholder="" value="<?php echo $demail; ?>" readonly="">

							</div>

						</div>





						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Name</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="name" type="text" placeholder="" value="<?php echo $dname; ?>" readonly="">

							</div>

						</div>





						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Subject</label>

							<div class="col-sm-12 col-md-10">

								<input class="form-control" name="subject" type="text" placeholder="" value="<?php echo $dsubject; ?>" readonly="">

							</div>

						</div>



						<div class="form-group row">

							<label class="col-sm-12 col-md-2 col-form-label">Reply To Customer</label>

							<div class="col-sm-12 col-md-10">

								<textarea class="form-control" name="message"></textarea>

							</div>

						</div>						

						

						<div class="text-center">

							<input class="btn btn-success" type="submit" name="submit" value="Send Mail">

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
	
	
	 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
$status_alert = $_SESSION['status'];

if(isset($_SESSION['status']))
{
if ($status_alert == "Reply Success") 
{
  ?>
          <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          }).then(function() {
          window.location = "inquiry.php";
          });
         </script>
<?php
}
elseif ($status_alert == "User Name does not Valid") 
{    
?>
       <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          }).then(function() {
          window.location = "inquiry.php";
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