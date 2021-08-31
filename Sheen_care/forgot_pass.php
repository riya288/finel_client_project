<?php
include('header.php');
include('admin/connection.php');
session_start();

if (isset($_REQUEST['send_otp'])) {

    $email = $_REQUEST['email'];

    $select = "SELECT * FROM customer WHERE email ='{$email}'";
    $run = mysqli_query($conn, $select);
    while ($data = mysqli_fetch_array($run)) {
        $customer_id = $data['customer_id'];
        $ck_email = $data['email'];
    }
    if ($ck_email == $email) // Check email
    {
        $customer_id = $customer_id;
        $toid = $email;
        $subject = "Wellcome Sheencare Forgot Password";
        // generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['customer_id'] = $customer_id;
        $message = " Your One Time Password is : " . $_SESSION['otp'];
        include('admin/phpmailer/PHPMailerAutoload.php');

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

        $mail->addAddress($toid);
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        if (!$mail->send()) {
            $error = "Mailer Error: " . $mail->ErrorInfo;
            ?>
            <script>alert('<?php echo $error ?>');</script><?php
        } else {
            $_SESSION['status'] = "OTP Sent Success";
            $_SESSION['code'] = "success";
        }
    } else {

        $_SESSION['status'] = "User Email does not exists";
        $_SESSION['code'] = "error";
    }
}
// for register
?>

<!-- login area start -->
<div class="login-register-area mb-60px mt-53px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4>Forgot </h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4>Password</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="text" name="email" placeholder="Email"/>
                                        <div class="button-box">
                                            <input type="submit" name="send_otp" value="SEND OTP" class="btn btn-danger"
                                                   style="background-color: green; color: white;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->
<?php include('includes/footer.php'); ?>
<?php include('includes/footerscript.php'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
$status_alert = $_SESSION['status'];
if (isset($_SESSION['status'])) {
    if ($status_alert == "OTP Sent Success") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "You clicked the button!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
            }).then(function () {
                window.location = "forgot_otp.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "User Name does not Valid") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "You clicked the button!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
            }).then(function () {
                window.location = "forgot_pass.php";
            });
        </script>
        <?php
    }
    unset($_SESSION['status']);
    unset($_SESSION['code']);
}
?>

</body>
<!-- Mirrored from demo.hasthemes.com/ecolife-preview/ecolife/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2020 05:47:21 GMT -->
</html>
