<?php
include('header.php');
include('admin/connection.php');
session_start();

if (isset($_REQUEST['enter_otp'])) {
    $otp = $_REQUEST['otp'];
    $ses_otp = $_SESSION['otp'];
    if ($otp == $ses_otp) {
        $_SESSION['reset'] = $ses_otp;

        $_SESSION['status'] = "OTP match Success Now Reset Password";
        $_SESSION['code'] = "success";
    } else {

        $_SESSION['status'] = "Sorry OTP Not Match ";
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
                            <h4>Enter </h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4>OTP</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="text" name="otp" placeholder="Enter OTP"/>
                                        <div class="button-box">
                                            <input type="submit" name="enter_otp" value="Submit" class="btn btn-danger"
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
<?php
$status_alert = $_SESSION['status'];
if (isset($_SESSION['status'])) {
    if ($status_alert == "OTP match Success Now Reset Password") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "You clicked the button!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
            }).then(function () {
                window.location = "reset_pass.php";
            });
        </script>
        <?php
    } else {
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
    }
    unset($_SESSION['status']);
    unset($_SESSION['code']);
}
?>

</body>
<!-- Mirrored from demo.hasthemes.com/ecolife-preview/ecolife/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2020 05:47:21 GMT -->
</html>
