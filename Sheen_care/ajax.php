<?php
include('admin/connection.php');
session_start();
if (isset($_REQUEST['pincode'])) {
    $search_value = $_REQUEST['pincode'];

    $sql = "SELECT * FROM location WHERE pincode = {$search_value} ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $output = $data;
        }
        echo json_encode($output);
    } else {
        echo "false";
    }
}

if (isset($_REQUEST['cart_id'])) {
    $cart_id = $_REQUEST['cart_id'];

    $query = "DELETE FROM cart WHERE  cart_id = $cart_id";
    $run = mysqli_query($conn, $query);

    if ($run) {
        echo "true";
    } else {
        echo "false";
    }
}

if (isset($_REQUEST['ses_product'])) {
    $pro_id = intval($_REQUEST['ses_product']);
    $_SESSION['total_cart_items'] -= $_SESSION['cart'][$pro_id];
    unset($_SESSION['cart'][$pro_id]);
    echo "true";
}


if (isset($_REQUEST['enter_promocode'])) {
    $enter_promocode = $_REQUEST['enter_promocode'];

    $sql = "SELECT * FROM promocode WHERE promocode = '{$enter_promocode}' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
            $output = $data;
        }
        echo json_encode($output);
    } else {
        echo "false";
    }
}

if (isset($_REQUEST['pro_id'])) {
    $pro_id = $_REQUEST['pro_id'];
    $customer_id = $_SESSION['cust_id'];

    if ($customer_id == "") {
        $flag = false;
        if (isset($_SESSION['cart'])) {
            $i = 0;
            foreach ($_SESSION['cart'] as $id => $quantity) {
                if ($id == $pro_id) {
                    $_SESSION['cart'][$id] = $quantity + 1;
                    $_SESSION['total_cart_items'] += 1;
                    $flag = true;
                    break;
                }
                $i++;
            }
        }

        if ($flag == false) {
            $_SESSION['cart'][$pro_id] = 1;
            $_SESSION['total_cart_items'] += 1;
        }
        echo "true";
    } else {
        // for validation one product only one time add
        $select1 = "SELECT * FROM cart WHERE customer_id = '{$customer_id}'";
        $runn = mysqli_query($conn, $select1);
        while ($dataa = mysqli_fetch_array($runn)) {
            if ($pro_id == $dataa['pro_id']) {
                $ck_pro_id = $dataa['pro_id'];
                $ck_quantity = $dataa['quantity'];
                $quantity = $ck_quantity + 1;
            }
        }

        if ($ck_pro_id == $pro_id) {
            $update = "UPDATE cart SET customer_id='{$customer_id}',pro_id='{$pro_id}',quantity='{$quantity}' WHERE pro_id = '{$pro_id}'";
            $run4 = mysqli_query($conn, $update);
            if ($run4) {
                echo "true";
            } else {
                echo "false";
            }
        } else {
            $insert = "INSERT INTO cart(customer_id,pro_id,quantity) VALUES('{$customer_id}','{$pro_id}',1)";
            $run3 = mysqli_query($conn, $insert);
            if ($run3) {
                echo "true";
            } else {
                echo "false";
            }
        }

    }

}

?>


