<?php
include('header.php');
include('admin/connection.php');
session_start();

// for register
if (isset($_REQUEST['register'])) {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $repassword = $_REQUEST['re-password'];
    $encpass = md5($password);

    $checkuserr = "SELECT email FROM customer WHERE email='{$email}'";
    $ddd = mysqli_query($conn, $checkuserr);
    while ($r = mysqli_fetch_array($ddd)) {
        $checkuser = $r['email'];
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        if ($email == $checkuser) {

            $_SESSION['status'] = "User Alredy exist..!!";
            $_SESSION['code'] = "warning";
        } else {
            if ($password == $repassword) {
                $insert = "insert into customer (first_name,last_name,phone,email,password) values('{$first_name}','{$last_name}','{$phone}','{$email}','{$encpass}')";
                $data = mysqli_query($conn, $insert);
                if ($data) {

                    $toid = $email;
                    $subject = "Welcome To Sheencare";

                    $message = " <h3>Thank You For Registration On</h3><h2><a href='https://sheencare.com/' target='_blank'>www.sheencare.com</a></h2> ";
                    include('admin/phpmailer/PHPMailerAutoload.php');

                    $mail = new PHPMailer;

                    $mail->isSMTP();

                    $mail->Host = 'mail.sheencare.com';

                    $mail->Port = 587;

                    $mail->SMTPSecure = 'smtp';

                    $mail->SMTPAuth = true;

                    $mail->Username = 'info@sheencare.com';// enter your mail

                    $mail->Password = '.J;%w5NA56I-';// enter pass

                    $mail->setFrom('info@sheencare.com', 'SHEEN CARE');  // Enter display email & name

                    $mail->addReplyTo('info@sheencare.com', 'SHEEN CARE');  // enter reply to mail & name

                    $mail->addAddress($toid);

                    $mail->Subject = $subject;

                    $mail->msgHTML($message);

                    if (!$mail->send()) {
                        $error = "Mailer Error: " . $mail->ErrorInfo;
                        ?>
                        <script> //alert('<?php// echo $error ?>');</script><?php
                    }

                    $_SESSION['status'] = "Register sucessfull..!!";
                    $_SESSION['code'] = "success";
                }
            } else {

                $_SESSION['status'] = "Invalid Password..!!";
                $_SESSION['code'] = "error";

            }

        }

    } else {

        $_SESSION['status'] = "Invalid Email..!!";
        $_SESSION['code'] = "warning";
    }

}

if (isset($_REQUEST['google_submit'])) {

    include('google-login/index.php');

    $link_demo = $google_client->createAuthUrl();

    if ($link_demo) {
        echo "<script> window.location='$link_demo'; </script>";
        //echo "<script> alert('$link_demo'); </script>";
    }

}

// for login

if (isset($_REQUEST['login'])) {
    $form_email = $_REQUEST['email'];
    $form_user_password = $_REQUEST['password'];
    $form_user_password = md5($form_user_password);

    $select = "SELECT * FROM customer WHERE email='{$form_email}'";
    $run = mysqli_query($conn, $select);
    while ($data = mysqli_fetch_array($run)) {
        $email = $data['email'];
        $user_name = $data['first_name'];
        $cust_id = $data['customer_id'];
        $password = $data['password'];
    }

    if ($form_email == $email && $form_user_password == $password) {

        $_SESSION['user'] = $email;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['cust_id'] = $cust_id;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $pro_id => $quantity) {
                $cart_query = "SELECT * FROM cart WHERE customer_id = '{$cust_id}' AND pro_id='{$pro_id}'";
                $cart_data = mysqli_query($conn, $cart_query);
                $num = mysqli_num_rows($cart_data);
                if($num > 0){
                    while ($cart_value = mysqli_fetch_array($cart_data)) {
                        $cart_id = $cart_value['cart_id'];
                    }
                    $update = "UPDATE cart SET quantity = quantity + $quantity WHERE cart_id = $cart_id";
                    mysqli_query($conn,$update);
                } else {
                    $insert = "INSERT INTO cart(customer_id,pro_id,quantity) VALUES('{$cust_id}','{$pro_id}','{$quantity}')";
                    $run = mysqli_query($conn, $insert);
                }
            }
            unset($_SESSION['cart']);
        }

        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $info = get_browser($useragent);

        $userip = $_SERVER['REMOTE_ADDR'];
        $toid = $email;
        $subject = "Login Successful in Sheencare with  " . $userip;

        $message = "if you are not please change the password  " . $info;
        include('admin/phpmailer/PHPMailerAutoload.php');

        $mail = new PHPMailer;

        $mail->isSMTP();

        $mail->Host = 'mail.sheencare.com';

        $mail->Port = 587;

        $mail->SMTPSecure = 'smtp';

        $mail->SMTPAuth = true;

        $mail->Username = 'info@sheencare.com';// enter your mail

        $mail->Password = '.J;%w5NA56I-';// enter pass

        $mail->setFrom('info@sheencare.com', 'SHEEN CARE');  // Enter display email & name

        $mail->addReplyTo('info@sheencare.com', 'SHEEN CARE');  // enter reply to mail & name

        $mail->addAddress($toid);

        $mail->Subject = $subject;

        $mail->msgHTML($message);

        if (!$mail->send()) {
            $error = "Mailer Error: " . $mail->ErrorInfo;
            ?>
            <script> //alert('<?php// echo $error ?>');</script><?php
        }

        $_SESSION['status'] = "Login Success..!!";
        $_SESSION['code'] = "success";

    } else {

        $_SESSION['status'] = "Login Failed..!!";
        $_SESSION['code'] = "error";

    }

}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- login area start -->
<div class="login-register-area mb-60px mt-53px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4>login</h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4>register</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">

                                <div class="login-register-form">

                                    <form action="" method="post">
                                        <div class="button-box box-center">
                                            <button type="submit" name="google_submit"><img
                                                        src="assets/images/google-logo.jpg"></button>
                                        </div>

                                        <input type="text" name="email" placeholder="Email"/>
                                        <input type="password" name="password" placeholder="Password"/>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox"/>
                                                <a class="flote-none" href="#">Remember me</a>
                                                <a href="forgot_pass.php">Forgot Password?</a>
                                            </div>
                                            <input type="submit" name="login" value="Login" class="btn btn-danger"
                                                   style="background-color: green; color: white;">

                                            <!--   <div class="button-box">
                                               <button type="submit" name="google_submit" class="btn btn-danger form-control"><i class="fa fa-google" aria-hidden="true"></i> Google</button>
                                            </div> -->
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">

                                    <form action="" method="post">
                                       
                                        <input type="text" name="first_name" placeholder="First Name"/>
                                        <input type="text" name="last_name" placeholder="Last Name"/>
                                        <input name="phone" placeholder="Phone Number" type="number"/>
                                        <input name="email" placeholder="Email" type="email"/>
                                        <input type="password" name="password" placeholder="Password"/>
                                        <input type="password" name="re-password" placeholder="Re-Password"/>

                                        <div class="button-box">
                                            <input type="submit" name="register" value="Register" class="btn btn-danger"
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
<!-- Scripts to be loaded  -->
<!-- JS
============================================ -->

<!--====== Vendors js ======-->
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>

<script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>

<!--====== Plugins js ======-->
<!-- <script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/popper.min.js"></script>
<script src="assets/js/plugins/meanmenu.js"></script>
<script src="assets/js/plugins/owl-carousel.js"></script>
<script src="assets/js/plugins/jquery.nice-select.js"></script>
<script src="assets/js/plugins/countdown.js"></script>
<script src="assets/js/plugins/elevateZoom.js"></script>
<script src="assets/js/plugins/jquery-ui.min.js"></script>
<script src="assets/js/plugins/slick.js"></script>
<script src="assets/js/plugins/scrollup.js"></script>
<script src="assets/js/plugins/range-script.js"></script> -->

<!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

<script src="assets/js/plugins.min.js"></script>

<!-- Main Activation JS -->
<script src="assets/js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
