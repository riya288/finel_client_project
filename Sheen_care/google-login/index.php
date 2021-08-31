<?php
include('../admin/connection.php');
//index.php
//Include Configuration File
$sessionPath = 'session.json';
// Save the session to a file.
if (!file_exists(dirname($sessionPath))) {
    mkdir(dirname($sessionPath), 0700, true);
}
file_put_contents($sessionPath, json_encode($_SESSION));
include('config.php');
$login_button = '';
if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }
        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }
        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }
        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}
if (!isset($_SESSION['access_token'])) {
    // $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
}
?>
<?php
$google_first_name = $_SESSION['user_first_name'];
$google_last_name = $_SESSION['user_last_name'];
$google_email = $_SESSION['user_email_address'];
if ($google_email != "") {
    $checkuserr = "SELECT * FROM customer WHERE email= '{$google_email}'";
    $ddd = mysqli_query($conn, $checkuserr);
    while ($r = mysqli_fetch_array($ddd)) {
        $checkemail = $r['email'];
        $user_name = $r['first_name'];
        $cust_id = $r['customer_id'];
        $password = $r['password'];
    }
    if ($google_email == $checkemail) {
        $_SESSION['user'] = $checkemail;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['cust_id'] = $cust_id;
    } else {
        $insert = "insert into customer (first_name,last_name,email) values('{$google_first_name}','{$google_last_name}','{$google_email}')";
        $data = mysqli_query($conn, $insert);
        if ($data) {
            $checkuserr = "SELECT * FROM customer WHERE email= '{$google_email}'";
            $ddd = mysqli_query($conn, $checkuserr);
            while ($rr = mysqli_fetch_array($ddd)) {
                $checkemail = $rr['email'];
                $user_name = $rr['first_name'];
                $cust_id = $rr['customer_id'];
                $password = $rr['password'];
            }
            $_SESSION['user'] = $checkemail;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['cust_id'] = $cust_id;
        }
    }

    if (isset($_SESSION['cust_id'])) {
        $cart = array();
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            unset($_SESSION['cart']);
        } elseif (file_exists($sessionPath)) {
            $fileData = json_decode(file_get_contents('https://www.sheencare.com/' . $sessionPath), true);
            if (!empty($fileData))
                $cart = $fileData['cart'];
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $sessionPath);
        }
        foreach ($cart as $pro_id => $quantity) {
            $cart_query = "SELECT * FROM cart WHERE customer_id = '{$cust_id}' AND pro_id='{$pro_id}'";
            $cart_data = mysqli_query($conn, $cart_query);
            $num = mysqli_num_rows($cart_data);
            if ($num > 0) {
                while ($cart_value = mysqli_fetch_array($cart_data)) {
                    $cart_id = $cart_value['cart_id'];
                }
                $update = "UPDATE cart SET quantity = quantity + $quantity WHERE cart_id = $cart_id";
                mysqli_query($conn, $update);
            } else {
                $insert = "INSERT INTO cart(customer_id,pro_id,quantity) VALUES('{$cust_id}','{$pro_id}','{$quantity}')";
                $run = mysqli_query($conn, $insert);
            }
        }
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $info = get_browser($useragent);
        $userip = $_SERVER['REMOTE_ADDR'];
        $toid = $google_email;
        $subject = "";
        $subject = "Login Successful in Sheencare with  " . $userip;
        $message = "if you are not please change the password  " . $info;
        include('../admin/phpmailer/PHPMailerAutoload.php');
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
        header("Location: ../index.php");
        exit();
    }
}
?>