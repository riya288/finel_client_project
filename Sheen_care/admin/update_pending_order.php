<?php
include('include/header.php');
include('connection.php');
?>
<?php

$order_id = $_REQUEST['order_id'];

$select_payment = "SELECT * FROM payment WHERE order_id = '{$order_id}'";
$run_payment = mysqli_query($conn, $select_payment);

while ($data_payment = mysqli_fetch_array($run_payment)) {
    $payment_mode = $data_payment['payment_mode'];

}

if ($payment_mode == "COD") {
    $payment_mode = "Cod";
} else {
    $payment_mode = "Prepaid";
}

$select_order = "SELECT * FROM order_master JOIN order_detail ON order_master.order_id = order_detail.order_id JOIN product ON order_detail.pro_id = product.pro_id WHERE order_master.order_id = '{$order_id}'";
$run_order_sel = mysqli_query($conn, $select_order);
$order_items = array();
while ($data_order_sel = mysqli_fetch_array($run_order_sel)) {
    $uniq_order_id = $data_order_sel['uniq_order_id'];
    $shipping_charge_d = $data_order_sel['shipping_charge'];
    $total_amount = $data_order_sel['total_amount'];
    $total_quantity = $data_order_sel['total_quantity'];
    $final_pro_name = $data_order_sel['pro_name'];
    $final_pro_price = $data_order_sel['price'];

    $o_first_name = $data_order_sel['o_first_name'];
    $o_last_name = $data_order_sel['o_last_name'];

    $o_city = $data_order_sel['o_city'];
    $o_pincode = $data_order_sel['o_pincode'];
    $o_email = $data_order_sel['o_email'];
    $o_phone = $data_order_sel['o_phone'];
    $o_address = $data_order_sel['o_address'];

    $item = array();
    $item['name'] = $final_pro_name;
    $item['sku'] = $final_pro_name;
    $item['units'] = $data_order_sel['quantity'];
    $item['selling_price'] = $final_pro_price;
    $item['discount'] = '';
    $item['tax'] = '';
    $order_items[] = $item;
}

$half = (int)ceil(count($words = str_word_count($o_address, 1)) / 2);
$address1 = implode(' ', array_slice($words, 0, $half));
$address2 = implode(' ', array_slice($words, $half));

if (isset($_REQUEST['submit'])) {

    $status = $_REQUEST['status'];
    $length = $_REQUEST['length'];
    $breadth = $_REQUEST['breadth'];
    $height = $_REQUEST['height'];
    $weight = $_REQUEST['weight'];

    date_default_timezone_set('Asia/Kolkata');
    $current_time_d = date('Y-m-d h:i');

    $select_token = "SELECT * FROM shiprocket_token";
    $run_token = mysqli_query($conn, $select_token);
    while ($data_token = mysqli_fetch_array($run_token)) {
        $add_on = strtotime($data_token['add_on']);
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $update_add_on = date('Y-m-d h:i:s');
        $diff_time = $current_time - $add_on;

        if ($diff_time > 86400) //86400
        {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\n    \"email\": \"vrtechie.web@gmail.com\",\n    \"password\": \"VRTechie@123\"\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));
            $SR_login_Response = curl_exec($curl);
            curl_close($curl);
            $SR_login_Response_out = json_decode($SR_login_Response);
            $token = $SR_login_Response_out->{'token'};

            $update_token = "UPDATE shiprocket_token SET shiprocket_token = '{$token}',add_on = '{$update_add_on}'";
            $run_update_token = mysqli_query($conn, $update_token);

        } else {
            $token = $data_token['shiprocket_token'];
        }

    }

    if ($token != "") {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "order_id": "' . $uniq_order_id . '",
                "order_date": "' . $current_time_d . '",
                "pickup_location": "Vadodara",
                "billing_customer_name": "Himanshu",
                "billing_last_name": "Bhatt",
                "billing_address": "312 , Vihav Ensign",
                "billing_address_2": "Vasna - Gotri Road, Opposite Sales India Showroom , Near Bansal Mall",
                "billing_city": "Vadodara",
                "billing_pincode": "390021",
                "billing_state": "Gujarat",
                "billing_country": "India",
                "billing_email": "himanshu.bhatt@octopuscare.in",
                "billing_phone": "9910311122",
                "shipping_is_billing": false,
                "shipping_customer_name": "' . $o_first_name . '",
                "shipping_last_name": "' . $o_last_name . '",
                "shipping_address": "' . $address1 . '",
                "shipping_address_2": "' . $address2 . '",
                "shipping_city": "' . $o_city . '",
                "shipping_country": "India",
                "shipping_state": "Gujarat",
                "shipping_email": "' . $o_email . '",
                "shipping_phone": "' . $o_phone . '",
                "shipping_pincode": "' . $o_pincode . '",
                "order_items": ' . json_encode($order_items) . ',
              "payment_method": "' . $payment_mode . '",
              "shipping_charges": ' . $shipping_charge_d . ',
              "giftwrap_charges": 0,
              "transaction_charges": 0,
              "total_discount": 0,
              "sub_total": ' . $total_amount . ',
              "length": ' . $length . ',
              "breadth": ' . $breadth . ',
              "height": ' . $height . ',
              "weight": ' . $weight . '
                }',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $token"
            ),
        ));
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        $SR_login_Response_out = json_decode($SR_login_Response);
        if ($SR_login_Response_out->status_code == 1) {

            $update = "UPDATE order_master SET order_status = '{$status}' WHERE order_id = $order_id";
            $run = mysqli_query($conn, $update);

            if ($run) {
                echo "<script> alert('Status Updated..!!'); 
             window.location='pending_order.php';
             </script>";
            } else {
                echo "<script> alert('Something went wrong..!!'); 
             window.location='pending_order.php';
             </script>";
            }

        } else {
            echo "<script> alert('" . $SR_login_Response_out->message . "'); 
             window.location='pending_order.php';
             </script>";
        }

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
                            <h4>Update Pending Order</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">Update Pending Order</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Order Status</label>
                        <div class="col-sm-12 col-md-10">

                            <select class="form-control" name="status">
                                <option value="pending">Pending</option>
                                <option value="Dispetch">Dispetch</option>

                            </select>

                        </div>
                    </div>
                    <br>
                    <center>
                        <h3 style="color: green;">Ship Rocket Details For Courier</h3>
                    </center>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Length</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="Number" name="length" class="form-control" placeholder="Enter Length" step="0.01">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Breadth</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="Number" name="breadth" class="form-control" placeholder="Enter Breadth" step="0.01">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Height</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="Number" name="height" class="form-control" placeholder="Enter Height" step="0.01">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Weight</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="Number" name="weight" class="form-control" placeholder="Enter Weight" step="0.01">

                        </div>
                    </div>

                    <div class="text-center">
                        <input class="btn btn-success" type="submit" name="submit" value="Update Status">
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
    </body>
    </html>
</div>