<?php
include('admin/connection.php');
session_start();

$cart_customer_id = isset($_SESSION['cust_id']) ? intval($_SESSION['cust_id']) : 0;

$select_header_text = "SELECT * FROM header_text";
$run_header_text = mysqli_query($conn, $select_header_text);
while ($data_header_text = mysqli_fetch_array($run_header_text)) {
    $header_text = $data_header_text['header_text'];
}

if (isset($_REQUEST['search_btn'])) {
    $search_value = $_REQUEST['search_value'];

    $_SESSION['search_value'] = $search_value;

    if (isset($_SESSION['search_value'])) {
        echo "<script> window.location='search_product.php'; </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/headerscript.php'); ?>

<!-- <style type="text/css">
  .count-cart{
    background-color:green;
    position: absolute;
    top: 9px;
    left: -26px;
    right: auto;
    width: 18px;
    height: 18px;
    content: "3";
    color: #fff;
    line-height: 18px;
    text-align: center;
    border-radius: 50%;
    float: right;
}
</style> -->

<style type="text/css">
    .btn-increment-decrement {
        display: inline-block;
        padding: 5px 0px;
        background: #e2e2e2;
        width: 30px;
        text-align: center;
        cursor: pointer;
    }

    .input-quantity {
        border: 0px;
        width: 30px;
        display: inline-block;
        margin: 0;
        box-sizing: border-box;
        text-align: center;
    }
</style>

<header class="home-5 home-cosmatics">
    <script type="text/javascript">
        function delete_header_item(cart_id) {
            var cart_id = cart_id;

            $.ajax({
                url: 'ajax.php',
                type: 'GET',
                data: 'cart_id=' + cart_id,
                success: function (data) {
                    if (data) {
                        swal({
                            title: "Delete Success",
                            text: "",
                            icon: "success",
                            button: "Ok",
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        swal({
                            title: "Something went wrong",
                            text: "",
                            icon: "error  ",
                            button: "Ok",
                        }).then(function () {
                            window.location.reload();
                        });
                    }
                }
            });
        }

        function delete_ses_header_item(pro_id) {
            $.ajax({
                url: 'ajax.php',
                type: 'GET',
                data: 'ses_product=' + pro_id,
                success: function (data) {
                    if (data) {
                        swal({
                            title: "Delete Success",
                            text: "",
                            icon: "success",
                            button: "Ok",
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        swal({
                            title: "Something went wrong",
                            text: "",
                            icon: "error  ",
                            button: "Ok",
                        }).then(function () {
                            window.location.reload();
                        });
                    }
                }
            });
        }
    </script>

    <script>
        function increment_quantity(cart_id, price) {
            var inputQuantityElement = $("#input-quantity-" + cart_id);
            var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
            var newPrice = newQuantity * price;
            save_to_db(cart_id, newQuantity, newPrice);
        }

        function decrement_quantity(cart_id, price) {
            var inputQuantityElement = $("#input-quantity-" + cart_id);
            if ($(inputQuantityElement).val() > 1) {
                var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
                var newPrice = newQuantity * price;
                save_to_db(cart_id, newQuantity, newPrice);
            }
        }

        function save_to_db(cart_id, new_quantity, newPrice) {
            var inputQuantityElement = $("#input-quantity-" + cart_id);
            var priceElement = $("#cart-price-" + cart_id);
            $.ajax({
                url: "update_cart_quantity.php",
                data: "cart_id=" + cart_id + "&new_quantity=" + new_quantity,
                type: 'post',
                success: function (response) {
                    window.location.reload();
                    // $(inputQuantityElement).val(new_quantity);
                    //       $(priceElement).text("₹"+newPrice);
                    //       var totalQuantity = 0;
                    //       $("input[id*='input-quantity-']").each(function() {
                    //           var cart_quantity = $(this).val();
                    //           totalQuantity = parseInt(totalQuantity) + parseInt(cart_quantity);
                    //       });
                    //       $("#total-quantity").text(totalQuantity);
                    //       var totalItemPrice = 0;
                    //       $("div[id*='cart-price-']").each(function() {
                    //           var cart_price = $(this).text().replace("₹","");
                    //           totalItemPrice = parseInt(totalItemPrice) + parseInt(cart_price);
                    //       });
                    //       $("#grand_total_show").text(totalItemPrice);
                }
            });
        }
    </script>

    <!--====== PRELOADER PART ENDS ======-->
    <div id="main">
        <!-- Header Start -->
        <header class="main-header">
            <!-- Header Top Start -->
            <div class="header-top-nav" style="background-color:#3F5724;">
                <div class="container">
                    <div class="row">
                        <!--Left Start-->
                        <div class="col-md-8 col-xs-8  col-sm-8">
                            <div class="left-text">
                                <marquee style="width:100%;"><?php echo $header_text; ?></marquee>
                            </div>
                        </div>
                        <!--Left End-->
                        <!--Right Start-->
                        <div class="col-xs-4 col-md-4 col-sm-4 text-right">
                            <div class="header-right-nav">
                                <?php
                                if (isset($_SESSION['user']))
                                {
                                ?>
                                <div class="dropdown-navs mt-2">
                                    <ul>
                                        <!-- Settings Start -->
                                        <li class="dropdown xs-after-n">
                                            <a class="angle-icon" href="#">Settings</a>
                                            <ul class="dropdown-nav">
                                                <li><a href="my_account.php">My Account</a></li>
                                                <li><a href="my_order.php">Order Traking</a></li>
                                                <li><a href="my_all_order.php">My Order</a></li>
                                                <li><a href="logout.php">Log-out</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <?php
                                    }
                                    else {
                                        ?>

                                        <ul>
                                            <li class="dropdown xs-after-n">
                                                <a class="" href="login.php">Login</a>

                                            </li>
                                        </ul>

                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!--Right End-->
                    </div>
                </div>
            </div>
            <!-- Header Top End -->
            <!-- Header Buttom Start -->
            <div class="header-navigation d-none d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <!--Contact info Start -->
                            <div class="contact-link">
                                <div class="phone">
                                    <p>Call us:</p>
                                    <a href="tel: +919428172734">(+91 9428172734)</a>
                                </div>
                            </div>
                            <!--Contact info End -->
                        </div>
                        <!-- Logo Start -->
                        <div class="col-md-4 col-sm-4">
                            <div class="logo text-center">
                                <a href="index.php"><img src="assets/images/logo/sheen_logo.png" alt=""
                                                         class="h-90"/></a>
                            </div>
                        </div>
                        <!-- Logo End -->
                        <div class="col-md-4 col-sm-4">
                            <!--Header Bottom Account Start -->
                            <div class="header_account_area home-2">
                                <!--Seach Area Start -->
                                <div class="header_account_list search_list">
                                    <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                                    <div class="dropdown_search">

                                        <form action="" method="post" id="search_form" class="frmSearch">
                                            <input placeholder="Search Product here ..." id="search-box" type="text"
                                                   name="search_value"/>
                                            <div id="suggesstion-box"></div>
                                            <button type="submit" name="search_btn"><i
                                                        class="ion-ios-search-strong"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                                <!--Seach Area End -->
                                <!--Cart info Start -->
                                <!-- <div class="cart-info d-flex">
                                    <div class="mini-cart-warp">
                                      <a href="cart.php" class="fa fa-shopping-bag fa-2x" style="color: green;"></a>

                                    </div>
                                </div> -->
                                <?php
                                $total_quantity = 0;
                                if ($cart_customer_id > 0) {
                                    // for fetch data in cart
                                    $select = "SELECT * FROM cart LEFT JOIN product ON cart.pro_id = product.pro_id LEFT JOIN stock ON product.pro_id = stock.pro_id WHERE cart.customer_id = '{$cart_customer_id}'";
                                    $run = mysqli_query($conn, $select);
                                    if (mysqli_num_rows($run) > 0) {
                                        while ($data = mysqli_fetch_array($run)) {
                                            $total_quantity = $total_quantity + $data['quantity'];
                                        }
                                    }
                                }
                                ?>

                                <div class="cart-info d-flex">
                                    <div class="mini-cart-warp">

                                        <?php
                                        if (isset($_SESSION['cust_id'])) {
                                            ?>
                                            <span class="s-bradge"><?php echo $total_quantity; ?></span>
                                            <!--<a class="count-cart">
                                                <span> ₹ <?php
                                            /*                                                    if ($sub_total == "") {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $sub_total;
                                                                                                }
                                                                                                */ ?>
                                                </span>
                                            </a>-->
                                        <?php } else {
                                            if (isset($_SESSION['total_cart_items'])) { ?>
                                                <span class="s-bradge"><?php echo isset($_SESSION['total_cart_items']) ? intval($_SESSION['total_cart_items']) : ''; ?></span>
                                            <?php } ?>
                                        <?php } ?>
                                        <a class="count-cart"><span></span></a>
                                        <div class="mini-cart-content">
                                            <ul>
                                                <?php
                                                $sub_total = 0;
                                                $total_quantity = 0;
                                                if (isset($_SESSION['cart'])) {
                                                    foreach ($_SESSION['cart'] as $pro_id => $quantity) {
                                                        // for fetch data in cart
                                                        $select = "SELECT * FROM  product JOIN stock ON product.pro_id = stock.pro_id WHERE product.pro_id = '{$pro_id}'";
                                                        $run = mysqli_query($conn, $select);
                                                        if (mysqli_num_rows($run) > 0) {
                                                            while ($data = mysqli_fetch_array($run)) {
                                                                $price = $data['price'];
                                                                $offer_price = $data['offer_price'];
                                                                $offer_status = $data['offer_status'];
                                                                $total_quantity = $total_quantity + $quantity;
                                                                if ($offer_status > 0) {
                                                                    $total = $offer_price * $quantity;
                                                                } else {
                                                                    $total = $price * $quantity;
                                                                }
                                                                $sub_total += $total;
                                                                ?>
                                                                <li class="single-shopping-cart">
                                                                    <div class="shopping-cart-img">
                                                                        <a href=""><img alt=""
                                                                                        src="admin/upload/product/<?php echo $data['pro_image']; ?>"/></a>
                                                                        <span class="product-quantity"><?php echo $quantity; ?> x</span>
                                                                    </div>
                                                                    <div class="shopping-cart-title">
                                                                        <h4>
                                                                            <a href=""><?php echo $data['pro_name']; ?></a>
                                                                        </h4>
                                                                        <span>₹ <?php echo $total; ?></span>
                                                                        <a onclick="delete_ses_header_item(<?= $pro_id ?>)"
                                                                           class="btn btn-sm btn-danger" style=""><i
                                                                                    style="color:white;float: right;"
                                                                                    class="fa fa-times"
                                                                                    aria-hidden="true"></i></a>
                                                                    </div>

                                                                </li>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }

                                                if ($cart_customer_id > 0) {
                                                    // for fetch data in cart
                                                    $select = "SELECT * FROM cart JOIN product ON cart.pro_id = product.pro_id  JOIN stock ON product.pro_id = stock.pro_id WHERE cart.customer_id = '{$cart_customer_id}'";
                                                    $run = mysqli_query($conn, $select);
                                                    if (mysqli_num_rows($run) > 0) {
                                                        while ($data = mysqli_fetch_array($run)) {
                                                            $price = $data['price'];
                                                            $offer_price = $data['offer_price'];
                                                            $offer_status = $data['offer_status'];
                                                            $quantity = $data['quantity'];
                                                            $stock_quantity[] = $quantity;
                                                            $total_quantity = $total_quantity + $data['quantity'];
                                                            if ($offer_status > 0) {
                                                                $total = $offer_price * $quantity;
                                                            } else {
                                                                $total = $price * $quantity;
                                                            }
                                                            //echo "<script> alert('$tmp_total'); </script>";
                                                            $sub_total += $total;
                                                            ?>
                                                            <li class="single-shopping-cart">
                                                                <div class="shopping-cart-img">
                                                                    <a href=""><img alt=""
                                                                                    src="admin/upload/product/<?php echo $data['pro_image']; ?>"/></a>
                                                                    <span class="product-quantity"><?php echo $quantity; ?> x</span>
                                                                </div>
                                                                <div class="shopping-cart-title">
                                                                    <h4><a href=""><?php echo $data['pro_name']; ?></a>
                                                                    </h4>
                                                                    <span>₹ <?php echo $total; ?></span>
                                                                </div>

                                                                <div class="btn-increment-decrement"
                                                                     onClick="decrement_quantity(<?php echo $data["cart_id"]; ?>, '<?php echo $data["price"]; ?>')">
                                                                    -
                                                                </div>
                                                                <input class="input-quantity"
                                                                       id="input-quantity-<?php echo $data["cart_id"]; ?>"
                                                                       value="<?php echo $data["quantity"]; ?>">

                                                                <div class="btn-increment-decrement"
                                                                     onClick="increment_quantity(<?php echo $data["cart_id"]; ?>, '<?php echo $data["price"]; ?>')">
                                                                    +
                                                                </div>
                                                                <a onclick="delete_header_item(<?php echo $data['cart_id']; ?>)"
                                                                   class="btn btn-danger" style="margin-left: 18%;"><i
                                                                            style="color:white;" class="fa fa-times"
                                                                            aria-hidden="true"></i></a>
                                                            </li>

                                                            <?php
                                                        }
                                                    }
                                                } ?>

                                            </ul>
                                            <div class="shopping-cart-total">

                                                <h4 class="shop-total">Total : <span>₹ <?php
                                                        if ($sub_total == "") {
                                                            echo "0";
                                                        } else {
                                                            echo $sub_total;
                                                        }
                                                        ?></span></h4>
                                            </div>
                                            <div class="shopping-cart-btn text-center">
                                                <a class="default-btn" href="cart.php">checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Cart info End -->
                    </div>
                </div>
            </div>
    </div>
    <!--Header Bottom Account End -->
    <!-- Menu Content Start -->
    <div class="header-buttom-nav sticky-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="main-navigation d-none d-lg-block">

                        <ul>
                            <!-- <li> <a href="index.php">Home</a> </li> -->
                            <?php
                            $select_category1 = "SELECT * FROM root_category";
                            $run_category1 = mysqli_query($conn, $select_category1);
                            while ($data_category1 = mysqli_fetch_array($run_category1))
                            {
                            $root_category_id1 = $data_category1['root_category_id'];
                            ?>
                            <li class="menu-dropdown">
                                <a href="root_products.php?root_category_id=<?php echo $data_category1['root_category_id']; ?>"><?php echo $data_category1['root_category']; ?>
                                    <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu sub-menu">
                                    <?php
                                    $select_category2 = "SELECT * FROM sub_category WHERE root_category_id = '{$root_category_id1}' AND sub_category <> 'none' ORDER BY sub_category_id DESC";
                                    $run_category2 = mysqli_query($conn, $select_category2);
                                    while ($data_category2 = mysqli_fetch_array($run_category2))
                                    {
                                    $sub_category_id1 = $data_category2['sub_category_id'];
                                    ?>
                                    <li class="menu-dropdown position-static"><a
                                                href="sub_product.php?sub_category_id=<?php echo $data_category2['sub_category_id']; ?>"><?php echo $data_category2['sub_category']; ?>
                                            <?php
                                            $select_category3 = "SELECT * FROM child_category WHERE sub_category_id = '{$sub_category_id1}' AND child_category <> 'none' ORDER BY child_category_id DESC";
                                            $run_category3 = mysqli_query($conn, $select_category3);
                                            $row_demo = mysqli_num_rows($run_category3);
                                            ?>

                                            <?php
                                            if ($row_demo > 0) {
                                                ?>
                                                <i class="ion-ios-arrow-down"></i>
                                                <?php
                                            }
                                            ?>
                                        </a>

                                        <ul class="sub-menu sub-menu-2">
                                            <?php

                                            while ($data_category3 = mysqli_fetch_array($run_category3)) {
                                                ?>
                                                <li>
                                                    <a href="single_product_2.php?child_category_id=<?php echo $data_category3['child_category_id']; ?>"><?php echo $data_category3['child_category']; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>

                                        <?php } ?>
                                    </li>

                                </ul>

                                <?php } ?>

                            </li>
                            <li class="menu-dropdown">
                                <a href="shop_product.php">Shop by Concern<i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu sub-menu">
                                    <?php
                                    $select_category1 = "SELECT * FROM category";
                                    $run_category1 = mysqli_query($conn, $select_category1);
                                    while ($data_category1 = mysqli_fetch_array($run_category1)) {
                                        $category_id1 = $data_category1['category_id'];
                                        ?>
                                        <li class="menu-dropdown position-static"><a
                                                    href="shop_sub_product.php?category_id=<?= $category_id1 ?>"><?= $data_category1['category'] ?>
                                                <?php
                                                $select_category3 = "SELECT * FROM product JOIN shop_product ON shop_product.pro_id = product.pro_id WHERE shop_product.category_id = '{$category_id1}'";
                                                $run_category3 = mysqli_query($conn, $select_category3);
                                                $row_demo = mysqli_num_rows($run_category3);

                                                ?>

                                                <?php
                                                if ($row_demo > 0) {
                                                    ?>
                                                    <i class="ion-ios-arrow-down"></i>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                            <ul class="sub-menu sub-menu-2">
                                                <?php
                                                while ($data_category3 = mysqli_fetch_array($run_category3)) {
                                                    ?>
                                                    <li>
                                                        <a href="single_product.php?pro_id=<?php echo $data_category3['pro_id']; ?>"><?php echo $data_category3['pro_name']; ?></a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>

                            <li><a href="blog.php">Blog</a></li>

                            <li><a href="about.php">About us </a></li>

                            <!-- <li> <a href="store.php">Our Store</a> </li> -->

                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <!--Main Navigation End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Content End -->
    <!-- Header Buttom Start -->
    <div class="header-navigation sticky-nav d-lg-none">
        <div class="container-fluid">
            <div class="row">
                <!-- Logo Start -->
                <div class="col-md-2 col-sm-2">
                    <div class="logo">
                        <a href="index.php"><img src="assets/images/logo/sheen_logo.png" height="40" alt=""/></a>
                    </div>
                </div>
                <!-- Logo End -->
                <!-- Navigation Start -->
                <div class="col-md-10 col-sm-10">
                    <!--Main Navigation Start -->
                    <div class="main-navigation d-none d-lg-block">
                        <ul>
                            <li><a href="index.php">Home</a></li>

                            <?php
                            if (isset($_SESSION['user'])) {
                                ?>
                                <li><a href="my_order.php">My Order</a></li>
                                <?php
                            }
                            ?>

                            <li class="menu-dropdown">
                                <a href="#">Product <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">

                                    <?php
                                    $select_category1 = "SELECT * FROM root_category ORDER BY root_category_id DESC";
                                    $run_category1 = mysqli_query($conn, $select_category1);
                                    while ($data_category1 = mysqli_fetch_array($run_category1)) {
                                        $root_category_id1 = $data_category1['root_category_id'];
                                        ?>

                                        <li class="menu-dropdown position-static">
                                            <a href="#"><?php echo $data_category1['root_category']; ?><i
                                                        class="ion-ios-arrow-down"></i></a>
                                            <ul class="sub-menu sub-menu-2">
                                                <?php
                                                $select_category2 = "SELECT * FROM sub_category WHERE root_category_id = '{$root_category_id1}'  AND sub_category <> 'none' ORDER BY sub_category_id DESC";
                                                $run_category2 = mysqli_query($conn, $select_category2);
                                                while ($data_category2 = mysqli_fetch_array($run_category2)) {
                                                    ?>
                                                    <li>
                                                        <a href="product.php?sub_category_id=<?php echo $data_category2['sub_category_id']; ?>"><?php echo $data_category2['sub_category']; ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>

                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>

                            <li><a href="blog.php">Blog</a></li>

                            <li><a href="store.php">Our Store</a></li>
                            <li><a href="about.php">About us </a></li>

                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <!--Main Navigation End -->
                    <!--Header Bottom Account Start -->
                    <div class="header_account_area">
                        <!--Seach Area Start -->
                        <div class="header_account_list search_list">
                            <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                            <div class="dropdown_search">

                                <form action="" method="post" id="search_form">
                                    <input placeholder="Search Product here ..." type="text" name="search_value"/>

                                    <button type="submit" name="search_btn"><i class="ion-ios-search-strong"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                        <!--Seach Area End -->
                        <!--Contact info Start -->
                        <div class="contact-link">
                            <div class="phone">
                                <p>Call us:</p>
                                <a href="tel: +919428172734">(+91 9428172734)</a>
                            </div>
                        </div>
                        <!--Contact info End -->
                       <div class="cart-info d-flex">
                                    <div class="mini-cart-warp">

                                        <?php
                                        if (isset($_SESSION['cust_id'])) {
                                            ?>
                                            <span class="s-bradge"><?php echo $total_quantity; ?></span>
                                            <!--<a class="count-cart">
                                                <span> ₹ <?php
                                            /*                                                    if ($sub_total == "") {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $sub_total;
                                                                                                }
                                                                                                */ ?>
                                                </span>
                                            </a>-->
                                        <?php } else {
                                            if (isset($_SESSION['total_cart_items'])) { ?>
                                                <span class="s-bradge"><?php echo isset($_SESSION['total_cart_items']) ? intval($_SESSION['total_cart_items']) : ''; ?></span>
                                            <?php } ?>
                                        <?php } ?>
                                        <a class="count-cart"><span></span></a>
                                        <div class="mini-cart-content">
                                            <ul>
                                                <?php
                                                $sub_total = 0;
                                                $total_quantity = 0;
                                                if (isset($_SESSION['cart'])) {
                                                    foreach ($_SESSION['cart'] as $pro_id => $quantity) {
                                                        // for fetch data in cart
                                                        $select = "SELECT * FROM  product JOIN stock ON product.pro_id = stock.pro_id WHERE product.pro_id = '{$pro_id}'";
                                                        $run = mysqli_query($conn, $select);
                                                        if (mysqli_num_rows($run) > 0) {
                                                            while ($data = mysqli_fetch_array($run)) {
                                                                $price = $data['price'];
                                                                $offer_price = $data['offer_price'];
                                                                $offer_status = $data['offer_status'];
                                                                $total_quantity = $total_quantity + $quantity;
                                                                if ($offer_status > 0) {
                                                                    $total = $offer_price * $quantity;
                                                                } else {
                                                                    $total = $price * $quantity;
                                                                }
                                                                $sub_total += $total;
                                                                ?>
                                                                <li class="single-shopping-cart">
                                                                    <div class="shopping-cart-img">
                                                                        <a href=""><img alt=""
                                                                                        src="admin/upload/product/<?php echo $data['pro_image']; ?>"/></a>
                                                                        <span class="product-quantity"><?php echo $quantity; ?> x</span>
                                                                    </div>
                                                                    <div class="shopping-cart-title">
                                                                        <h4>
                                                                            <a href=""><?php echo $data['pro_name']; ?></a>
                                                                        </h4>
                                                                        <span>₹ <?php echo $total; ?></span>
                                                                        <a onclick="delete_ses_header_item(<?= $pro_id ?>)"
                                                                           class="btn btn-sm btn-danger" style=""><i
                                                                                    style="color:white;float: right;"
                                                                                    class="fa fa-times"
                                                                                    aria-hidden="true"></i></a>
                                                                    </div>

                                                                </li>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }

                                                if ($cart_customer_id > 0) {
                                                    // for fetch data in cart
                                                    $select = "SELECT * FROM cart JOIN product ON cart.pro_id = product.pro_id  JOIN stock ON product.pro_id = stock.pro_id WHERE cart.customer_id = '{$cart_customer_id}'";
                                                    $run = mysqli_query($conn, $select);
                                                    if (mysqli_num_rows($run) > 0) {
                                                        while ($data = mysqli_fetch_array($run)) {
                                                            $price = $data['price'];
                                                            $offer_price = $data['offer_price'];
                                                            $offer_status = $data['offer_status'];
                                                            $quantity = $data['quantity'];
                                                            $stock_quantity[] = $quantity;
                                                            $total_quantity = $total_quantity + $data['quantity'];
                                                            if ($offer_status > 0) {
                                                                $total = $offer_price * $quantity;
                                                            } else {
                                                                $total = $price * $quantity;
                                                            }
                                                            //echo "<script> alert('$tmp_total'); </script>";
                                                            $sub_total += $total;
                                                            ?>
                                                            <li class="single-shopping-cart">
                                                                <div class="shopping-cart-img">
                                                                    <a href=""><img alt=""
                                                                                    src="admin/upload/product/<?php echo $data['pro_image']; ?>"/></a>
                                                                    <span class="product-quantity"><?php echo $quantity; ?> x</span>
                                                                </div>
                                                                <div class="shopping-cart-title">
                                                                    <h4><a href=""><?php echo $data['pro_name']; ?></a>
                                                                    </h4>
                                                                    <span>₹ <?php echo $total; ?></span>
                                                                </div>

                                                                <div class="btn-increment-decrement"
                                                                     onClick="decrement_quantity(<?php echo $data["cart_id"]; ?>, '<?php echo $data["price"]; ?>')">
                                                                    -
                                                                </div>
                                                                <input class="input-quantity"
                                                                       id="input-quantity-<?php echo $data["cart_id"]; ?>"
                                                                       value="<?php echo $data["quantity"]; ?>">

                                                                <div class="btn-increment-decrement"
                                                                     onClick="increment_quantity(<?php echo $data["cart_id"]; ?>, '<?php echo $data["price"]; ?>')">
                                                                    +
                                                                </div>
                                                                <a onclick="delete_header_item(<?php echo $data['cart_id']; ?>)"
                                                                   class="btn btn-danger" style="margin-left: 18%;"><i
                                                                            style="color:white;" class="fa fa-times"
                                                                            aria-hidden="true"></i></a>
                                                            </li>

                                                            <?php
                                                        }
                                                    }
                                                } ?>

                                            </ul>
                                            <div class="shopping-cart-total">

                                                <h4 class="shop-total">Total : <span>₹ <?php
                                                        if ($sub_total == "") {
                                                            echo "0";
                                                        } else {
                                                            echo $sub_total;
                                                        }
                                                        ?></span></h4>
                                            </div>
                                            <div class="shopping-cart-btn text-center">
                                                <a class="default-btn" href="cart.php">checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <!--Cart info End -->
                </div>
            </div>

            <!------------------------------------------------ mobile menu ------------------------------------------------------------------>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <?php
                            $select_category1 = "SELECT * FROM root_category";
                            $run_category1 = mysqli_query($conn, $select_category1);
                            while ($data_category1 = mysqli_fetch_array($run_category1))
                            {
                            $root_category_id1 = $data_category1['root_category_id'];
                            ?>
                            <li>
                                <a href="root_products.php?root_category_id=<?php echo $data_category1['root_category_id']; ?>"><?php echo $data_category1['root_category']; ?>
                                    </a>
                                <ul>
                                    <?php
                                    $select_category2 = "SELECT * FROM sub_category WHERE root_category_id = '{$root_category_id1}'  AND sub_category <> 'none' ORDER BY sub_category_id DESC";
                                    $run_category2 = mysqli_query($conn, $select_category2);
                                    while ($data_category2 = mysqli_fetch_array($run_category2))
                                    {
                                    $sub_category_id1 = $data_category2['sub_category_id'];
                                    ?>
                                    <li>
                                        <a href="sub_product.php?sub_category_id=<?php echo $data_category2['sub_category_id']; ?>"><?php echo $data_category2['sub_category']; ?>
                                            <?php
                                            $select_category3 = "SELECT * FROM child_category WHERE sub_category_id = '{$sub_category_id1}' AND child_category <> 'none' ORDER BY child_category_id DESC";
                                            $run_category3 = mysqli_query($conn, $select_category3);
                                            $row_demo = mysqli_num_rows($run_category3);
                                            ?>

                                           
                                        </a>

                                        <ul>
                                            <?php
                                            while ($data_category3 = mysqli_fetch_array($run_category3)) {
                                                ?>
                                                <li>
                                                    <a href="single_product_2.php?child_category_id=<?php echo $data_category3['child_category_id']; ?>"><?php echo $data_category3['child_category']; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>

                                        <?php } ?>
                                    </li>

                                </ul>
                                <?php } ?>

                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="about.php">About us </a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <!--Header Bottom Account End -->
</header>




