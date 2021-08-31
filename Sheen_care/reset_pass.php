<?php
include('header.php');
include('admin/connection.php');
session_start();
if (isset($_REQUEST['submit'])) {
    $new_pass = $_REQUEST['new_pass'];
    $re_pass = $_REQUEST['re_pass'];
    if ($new_pass == $re_pass) {
        $enc_pss = md5($new_pass);
        $update = "UPDATE customer SET password='{$enc_pss}' WHERE customer_id=" . $_SESSION['customer_id'];
        $run = mysqli_query($conn, $update);

        if ($run) {
            unset($_SESSION['customer_id']);
            unset($_SESSION['otp']);
            unset($_SESSION['reset']);

            $_SESSION['status'] = "New Password Reset Success";
            $_SESSION['code'] = "success";
        }
    } else {
        $_SESSION['status'] = "Password Does not Match";
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
                            <h4>Reset </h4>
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
                                        <input type="text" name="new_pass" placeholder="Enter New Password"/>
                                        <input type="text" name="re_pass" placeholder="Enter Confirm Password"/>
                                        <div class="button-box">
                                            <input type="submit" name="submit" value="Reset Password"
                                                   class="btn btn-danger"
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
    if ($status_alert == "New Password Reset Success") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "You clicked the button!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
            }).then(function () {
                window.location = "login.php";
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
                window.location = "reset_pass.php";
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
