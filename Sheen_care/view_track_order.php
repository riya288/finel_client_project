<?php
include('header.php');
include('admin/connection.php');
session_start();
if (isset($_REQUEST['submit'])) {
    $track_id1 = $_REQUEST['track_id'];
    $track_id = str_replace(' ', '', $track_id1);
    $select_token = "SELECT * FROM shiprocket_token";
    $run_token = mysqli_query($conn, $select_token);
    while ($data_token = mysqli_fetch_array($run_token)) {
        $token = $data_token['shiprocket_token'];
    }

    $select = "SELECT * FROM order_master WHERE uniq_order_id = '{$track_id}'";
    $run = mysqli_query($conn, $select);
    while ($data = mysqli_fetch_array($run)) {
        $uniq_order_id = $data['uniq_order_id'];
    }

    if ($uniq_order_id == $track_id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track?order_id=" . $track_id . "&channel_id=1519471",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
        ));
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);

        $SR_login_Response_out = json_decode($SR_login_Response);
        if (!empty($SR_login_Response_out)) {
            echo '<script>location = "' . $SR_login_Response_out[0]->tracking_data->track_url . '"</script>';
        } else {
            $_SESSION['status'] = "Thank You. We are Processing your order.!";
            $_SESSION['code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Invalid Order ID..!!";
        $_SESSION['code'] = "error";
    }
}
?>
<style type="text/css">
    .hh-grayBox {
        background-color: #F8F8F8;
        margin-bottom: 20px;
        padding: 35px;
        width: 100%;
        margin-top: 20px;
    }

    .pt45 {
        padding-top: 45px;
    }

    .order-tracking {
        text-align: center;
        width: 33.33%;
        position: relative;
        display: block;
    }

    .order-tracking .is-complete {
        display: block;
        position: relative;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        border: 0px solid #AFAFAF;
        background-color: #f7be16;
        margin: 0 auto;
        transition: background 0.25s linear;
        -webkit-transition: background 0.25s linear;
        z-index: 2;
    }

    .order-tracking .is-complete:after {
        display: block;
        position: absolute;
        content: '';
        height: 14px;
        width: 7px;
        top: -2px;
        bottom: 0;
        left: 5px;
        margin: auto 0;
        border: 0px solid #AFAFAF;
        border-width: 0px 2px 2px 0;
        transform: rotate(45deg);
        opacity: 0;
    }

    .order-tracking.completed .is-complete {
        border-color: #27aa80;
        border-width: 0px;
        background-color: #27aa80;
    }

    .order-tracking.completed .is-complete:after {
        border-color: #fff;
        border-width: 0px 3px 3px 0;
        width: 7px;
        left: 11px;
        opacity: 1;
    }

    .order-tracking p {
        color: #A4A4A4;
        font-size: 16px;
        margin-top: 8px;
        margin-bottom: 0;
        line-height: 20px;
    }

    .order-tracking p span {
        font-size: 14px;
    }

    .order-tracking.completed p {
        color: #000;
    }

    .order-tracking::before {
        content: '';
        display: block;
        height: 3px;
        width: calc(100% - 40px);
        background-color: #f7be16;
        top: 13px;
        position: absolute;
        left: calc(-50% + 20px);
        z-index: 0;
    }

    .order-tracking:first-child:before {
        display: none;
    }

    .order-tracking.completed:before {
        background-color: #27aa80;
    }
</style>
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
<div class="container">
    <div class="row">
        <div class="col-12 col-md-12 hh-grayBox pt45 pb20">
            <div class="row justify-content-between">

                <?php
                $select = "SELECT * FROM order_master WHERE uniq_order_id = '{$track_id}'";
                $run = mysqli_query($conn, $select);
                while ($data = mysqli_fetch_array($run)) {
                    $status = $data['order_status'];
                }
                ?>
                <?php
                if ($status == "pending") {
                    ?>
                    <div class="order-tracking completed">
                        <span class="is-complete"></span>
                        <p>Ordered<br><span></span></p>
                    </div>
                    <div class="order-tracking">
                        <span class="is-complete"></span>
                        <p>Shipped<br><span></span></p>
                    </div>
                    <div class="order-tracking">
                        <span class="is-complete"></span>
                        <p>Delivered<br><span></span></p>
                    </div>
                    <?php
                } elseif ($status == "Dispetch") {
                    ?>
                    <div class="order-tracking completed">
                        <span class="is-complete"></span>
                        <p>Ordered<br><span></span></p>
                    </div>
                    <div class="order-tracking completed">
                        <span class="is-complete"></span>
                        <p>Shipped<br><span></span></p>
                    </div>
                    <div class="order-tracking">
                        <span class="is-complete"></span>
                        <p>Delivered<br><span></span></p>
                    </div>
                    <?php
                } elseif ($status == "Received") {
                    ?>
                    <div class="order-tracking completed">
                        <span class="is-complete"></span>
                        <p>Ordered<br><span></span></p>
                    </div>
                    <div class="order-tracking completed">
                        <span class="is-complete"></span>
                        <p>Shipped<br><span></span></p>
                    </div>
                    <div class="order-tracking completed">
                        <span class="is-complete"></span>
                        <p>Delivered<br><span></span></p>
                    </div>
                    <?php
                }else{
                ?>
                <div style="padding-left:40%;"><p><b>"Thank You. We are processing your order"</b></p></div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<?php include('includes/footerscript.php'); ?>
<?php
$status_alert = $_SESSION['status'];
if (isset($_SESSION['status'])) { ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
        }).then(function () {
            window.location = "track_order.php";
        });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['code']);
}
?>

</body>
</html>
