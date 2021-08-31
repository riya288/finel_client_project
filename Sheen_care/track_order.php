<?php
include('header.php');
include('admin/connection.php');
session_start();


?>


<!-- login area start -->
<div class="login-register-area mb-60px mt-53px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">

                        <a data-toggle="tab" href="#lg2">
                            <h4>Track Order</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">

                                    <form action="view_track_order.php" method="post">
                                        <input type="text" name="track_id" placeholder="Enter Order ID"/>
                                        <div class="button-box">

                                            <input type="submit" name="submit" value="Track Order"
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
    if ($status_alert == "User Alredy exist..!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "login.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "Register sucessfull..!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "login.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "Invalid Password..!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            });
        </script>
        <?php
    } elseif ($status_alert == "Invalid Email..!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "login.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "Login Success..!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "index.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "Login Failed..!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "login.php";
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
