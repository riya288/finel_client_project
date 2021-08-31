
<?php
include('connection.php');
session_start();

if(isset($_REQUEST['submit']))
{
				
	
	    $email = $_REQUEST['email'];

	    $select="SELECT * FROM admin WHERE email ='{$email}'";
	    $run= mysqli_query($conn, $select);
	    while ($data = mysqli_fetch_array($run)) 
	    {
	      $ck_email = $data['email'];
	      $admin_id = $data['admin_id'];
	    
	    } 

		if($ck_email == $email) // Check email
		{
		
			$admin_id=$admin_id;			
			$toid=$email;
			$subject="Wellcome PowerX Forgot Password";
			
			// generate OTP
			$otp = rand(100000,999999);						
			$_SESSION['otp']=$otp;
			$_SESSION['admin_id']=$admin_id;
			
			$message=" Your One Time Password is : ".$_SESSION['otp'];
			include 'phpmailer/PHPMailerAutoload.php';  
			
					$mail = new PHPMailer;

					$mail->isSMTP();

					$mail->Host = 'mail.powerxcure.com';

					$mail->Port = 587;

					$mail->SMTPSecure = 'tls';

					$mail->SMTPAuth = true;

					$mail->Username = 'team@powerxcure.com';// enter your mail

					$mail->Password = 'Z#l{f9-u~Q+=';// enter pass

					$mail->setFrom('team@powerxcure.com', 'Sheen.com');  // Enter display email & name

					$mail->addReplyTo('team@powerxcure.com', 'Sheen.com');  // enter reply to mail & name


					$mail->addAddress($toid);

					$mail->Subject = $subject;

					$mail->msgHTML($message);

					if (!$mail->send()) {
					   $error = "Mailer Error: " . $mail->ErrorInfo;
						?><script>alert('<?php echo $error ?>');</script><?php
					} 
					else 
					{
					echo "<script>  
					alert('OTP Sent Success'); 
					window.location='enter_otp.php';
					</script>";
					}
		}
		else
		{
				echo "<script>  
				alert('User Name does not Valid'); 
				window.location='forgot_pass.php';
				</script>";
		}
}

?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body>

	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Forgot Password</h2>
						</div>
						<h6 class="mb-20">Enter your email address to reset your password</h6>
						<form action="" method="POST">
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" name="email" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
										-->
										<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit">
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="index.php">Login</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
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