<?php
include('header.php');
include('admin/connection.php');
session_start();
$cust_id = $_SESSION['cust_id'];

// for find shipping charge
// if (isset($_REQUEST['shipping_pincode_btn']))
// {
//     $cust_pincode = $_REQUEST['cust_pincode'];
//     $shipping_charge_select ="SELECT * FROM location WHERE pincode ='{$cust_pincode}' ";
//     $shipping_charge_run = mysqli_query($conn, $shipping_charge_select);
//     while ($shipping_data = mysqli_fetch_array($shipping_charge_run))
//     {
//         $standard_charge = $shipping_data['standard_charge'];
//         $express_charge = $shipping_data['express_charge'];
//     }
// }

?>
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
<script type="text/javascript">
    function add_to_cart(pro_id) {
        var pro_id = pro_id;

        $.ajax({
            url: 'ajax.php',
            type: 'GET',
            data: 'pro_id=' + pro_id,
            success: function (data) {
                if (data == "true") {
                    swal({
                        title: "Item Added",
                        text: "",
                        icon: "success",
                        button: "Ok",
                    }).then(function () {
                        window.location.reload(2);
                    });
                } else {
                    swal({
                        title: "Something went wrong",
                        text: "",
                        icon: "warning",
                        button: "Ok",
                    }).then(function () {
                        window.location.reload();
                    });
                }
            }
        });
    }
</script>
<!-- cart area start -->
<div class="cart-main-area mtb-60px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <?php
                                if (isset($_SESSION['cust_id'])) {
                                    ?>
                                    <th>Subtotal</th>
                                    <?php
                                }
                                ?>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <?php
                            if (isset($_SESSION['cart'])) {
                                $i = 0;
                                $total = 0;
                                $total_quantity = 0;
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
                                            $tmp_total[$i] = $total;
                                            $sub_total = array_sum($tmp_total) + $shipping_charge;
                                            $pro_id_array[$i] = $data['pro_id'];

                                            ?>
                                            <tbody>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img
                                                                src="admin/upload/product/<?php echo $data['pro_image']; ?>"
                                                                alt="" style="width: 80px; height: 80px;"/></a>
                                                </td>
                                                <td class="product-name"><a
                                                            href="#"><?php echo $data['pro_name']; ?></a>
                                                </td>
                                                <?php
                                                if ($offer_status > 0) {
                                                    $final_price = $data['offer_price'];
                                                } else {
                                                    $final_price = $data['price'];
                                                }
                                                ?>
                                                <input type="hidden" name="change_price" id="change_price"
                                                       value="<?= $final_price ?>">
                                                <td class="product-price-cart"><span
                                                            class="amount">₹ <?= $final_price ?></span></td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" id=""
                                                               name="qtybutton" id="qtychange"
                                                               value="<?php echo $quantity; ?> "/>
                                                    </div>
                                                </td>
                                                <input type="hidden" name="change_total" id="change_total"
                                                       value="<?php echo $total; ?>">
                                                <td class="product-remove">
                                                    <a href="delete.php?cart_pro_id=<?php echo $pro_id; ?> "
                                                       onclick="return confirm_delete();"><i
                                                                class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                            $i++;
                                        }
                                        $grand += $total;
                                    }
                                }
                            } ?>
                            <tbody>
                            <?php
                            // for fetch data in cart
                            $i = 0;
                            $total = 0;
                            $total_quantity = 0;
                            $select = "SELECT * FROM cart JOIN product ON cart.pro_id = product.pro_id  JOIN stock ON product.pro_id = stock.pro_id WHERE cart.customer_id = '{$cust_id}'";
                            $run = mysqli_query($conn, $select);
                            if (mysqli_num_rows($run) > 0)
                            {
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
                                    $tmp_total[$i] = $total;
                                    //echo "<script> alert('$tmp_total'); </script>";
                                    $sub_total = array_sum($tmp_total) + $shipping_charge;
                                    $pro_id_array[$i] = $data['pro_id'];

                                    ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img
                                                        src="admin/upload/product/<?php echo $data['pro_image']; ?>"
                                                        alt="" style="width: 80px; height: 80px;"/></a>
                                        </td>
                                        <td class="product-name"><a href="#"><?php echo $data['pro_name']; ?></a></td>
                                        <?php
                                        if ($offer_status > 0) {
                                            $final_price = $data['offer_price'];
                                        } else {
                                            $final_price = $data['price'];
                                        }
                                        ?>
                                        <input type="hidden" name="change_price" id="change_price"
                                               value="<?= $final_price ?>">
                                        <td class="product-price-cart"><span class="amount">₹ <?= $final_price ?></span></td>
                                        <td class="cart-info quantity">
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
                                        </td>
                                        <td class="cart-info price"
                                            id="cart-price-<?php echo $data["cart_id"]; ?>">
                                            <?php echo "₹" . $total; ?>
                                        </td>
                                        <input type="hidden" name="change_total" id="change_total"
                                               value="<?php echo $total; ?>">
                                        <td class="product-remove">
                                            <a href="delete.php?cart_id=<?php echo $data['cart_id']; ?> "
                                               onclick="return confirm_delete();"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $grand += $total;
                                    $i++;
                                } ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <th>Total Amount</th>
                                    <td><?= $grand ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                            else
                            {
                            if (!isset($_SESSION['cart']))
                            {

                            ?>
                            <tbody>
                            <td colspan="6"> Empty Cart</td>
                            </tbody>
                        <?php
                        }
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="product.php">Continue Shopping</a>
                                    <?php
                                    if (!isset($_SESSION['cust_id'])) {
                                        ?>
                                        <input type="submit" name="place_order" value="Proceed to Checkout"
                                               class="btn btn-success">
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_SESSION['cust_id'])) {
                    ?>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                    </div>
                                    <div class="discount-code">
                                        <p>Enter your coupon code if you have one.</p>
                                        <input type="text" name="enter_promocode" id="enter_promocode"
                                               class="form-control"
                                               placeholder="SHEEN1586XGHQ" value=""/>
                                        <div class="text-center mt-5">
                                            <input type="button" name="promo_submit" id="promo_submit"
                                                   value="Apply Coupon"
                                                   class="btn btn-success" style="background-color: green;">
                                        </div>
                                        <span style="color: green; font-size: 1.5em; display: none;" id="promo_mess">Promocode Appiled..!!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="cart-tax">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                    </div>
                                    <div class="tax-wrapper">
                                        <p>Enter your destination to get a shipping estimate.</p>
                                        <div class="tax-select-wrapper">
                                            <div class="tax-select mb-25px">
                                                <label>
                                                    * Zip/Postal Code
                                                </label>
                                                <input type="Number" name="cust_pincode" id="cust_pincode" required=""
                                                       placeholder="Pincode" class="form-control" value=""/>
                                                <input type="Number" name="final_pincode" id="final_pincode" value=""
                                                       hidden="">
                                            </div>
                                            <div class="text-center mt-5">
                                                <button class="btn btn-success" type="button" id="shipping_pincode_btn">
                                                    Get
                                                    Shipping Charge
                                                </button>
                                                <button class="btn btn-success" type="button" id="change_pincode"
                                                        style="display: none;">Change Pincode
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                    </div>
                                    <h5>Total products <span><?php echo $total_quantity; ?></span></h5>
                                    <h5 id="promo_mess1" style="display: none;">Promocode Discount <span
                                                id="promo_mess2"></span></h5>
                                    <div class="total-shipping">
                                        <h5>Total shipping</h5>
                                        <ul>
                                            <!-- Default radio -->
                                            <div class="form-check">
                                                <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="shipping_mode"
                                                        id="flexRadioDefault1"
                                                        value="Standard"
                                                        checked
                                                        style="display: none;"
                                                />
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Standard </label>
                                                <label id="standard_charge_view" style="margin-left: 68%;">₹ <?php
                                                    if (isset($standard_charge)) {
                                                        echo $standard_charge;
                                                    } else {
                                                        echo "0.00";
                                                    }
                                                    ?></label>
                                            </div>
                                            <!-- Default checked radio -->
                                            <div class="form-check">
                                                <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="shipping_mode"
                                                        id="flexRadioDefault2"
                                                        value="Express"
                                                        style="display: none;"
                                                />
                                                <input type="text" name="express_charge" id="express_charge" value=""
                                                       hidden="">
                                                <input type="text" name="standard_charge" id="standard_charge" value=""
                                                       hidden="">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Express </label>
                                                <span id="express_charge_view" style="margin-left: 70%;">₹ <?php
                                                    if (isset($express_charge)) {
                                                        echo $express_charge;
                                                    } else {
                                                        echo "0.00";
                                                    }
                                                    ?></span>
                                            </div>
                                        </ul>
                                    </div>
                                    <h4 class="grand-totall-title">Grand Total <span id="grand_total_show">₹ <?php
                                            if (isset($_SESSION['login_total'])) {
                                                echo $_SESSION['login_total'];
                                            } else {
                                                echo $sub_total;
                                            }

                                            ?></span></h4>
                                    <input type="text" name="grand_total" id="grand_total"
                                           value="<?php echo $sub_total; ?>" hidden="">
                                    <input type="hidden" name="has_cod" id="has_cod" value="0">
                                    <div class="text-center mt-5">
                                        <input type="submit" name="place_order" value="Proceed to Checkout"
                                               class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    $select = mysqli_query($conn, "SELECT * FROM discount");
    $row = mysqli_fetch_assoc($select);
    $dis_old = $row['dis'];
    ?>
    <input type="hidden" value="<?= $dis_old ?>" id="dis_old">
</div>
<!-- cart area end -->
<?php include('includes/footer.php'); ?>
<?php include('includes/footerscript.php'); ?>
<script>
    // for confirm to delete
    function confirm_delete() {
        var x = confirm('Are you sure..??');
        if (x) {
            return true;
        } else {
            return false;
        }
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#change_pincode").on("click", function () {
            window.location = 'cart.php';
        });
        $("#shipping_pincode_btn").on("click", function () {
            var search_term = $("#cust_pincode").val();
            $("#final_pincode").val(search_term);
            $('#flexRadioDefault2').show();
            $('#flexRadioDefault1').show();

            if (search_term == "") {
                swal({
                    title: "Please Enter Pincode!",
                    icon: "warning",
                    button: "Ok!",
                });
            } else {

                $.ajax({
                    url: 'ajax.php',
                    type: 'GET',
                    data: 'pincode=' + search_term,
                    success: function (data) {
                        if (data == "false") {
                            swal({
                                title: "This area is out of service!",
                                icon: "warning",
                                button: "Ok!",
                            });
                        } else {
                            var parsed_result = JSON.parse(data);  //parsing here
                            var json_standard_charge = parsed_result.standard_charge; //  50
                            var json_express_charge = parsed_result.express_charge;   //  100
                            var grand_total = $('#grand_total').val();                  // 1000
                            var dis = $('#dis_old').val();
                            
                            if (parseFloat(grand_total) >= parseFloat(dis)) {
                                json_standard_charge = 0;
                                json_express_charge = 0;
                            }
                            var total_grand_total = Number(json_standard_charge) + Number(grand_total);

                            $('#standard_charge_view').text("₹ " + json_standard_charge);
                            $('#express_charge_view').text("₹ " + json_express_charge);
                            // if (json_express_charge != "" && json_standard_charge != "") {
                            $('#grand_total').val(total_grand_total);
                            $('#standard_charge').val(json_standard_charge);
                            $('#express_charge').val(json_express_charge);
                            $('#grand_total_show').text("₹ " + total_grand_total);
                            $('#shipping_pincode_btn').fadeOut(0);
                            $('#change_pincode').fadeIn(200);
                            $('#has_cod').val(parsed_result.has_cod);
                            // }

                        }
                    }
                })
            }
        });

        $("#flexRadioDefault2").on("click", function () { //express service

            var standard_charge = $('#standard_charge').val();
            var express_charge = $('#express_charge').val();
            var grand_total = $('#grand_total').val();

            var express_grand_total = Number(grand_total) - Number(standard_charge);
            var express_grand_total = Number(express_grand_total) + Number(express_charge);
            $('#grand_total_show').text("₹ " + express_grand_total);
            $('#grand_total').val(express_grand_total);
        });

        $("#flexRadioDefault1").on("click", function () {  // Standard service

            var standard_charge = $('#standard_charge').val();
            var express_charge = $('#express_charge').val();
            var grand_total = $('#grand_total').val();

            var standard_grand_total = Number(grand_total) - Number(express_charge);
            var standard_grand_total = Number(standard_grand_total) + Number(standard_charge);
            $('#grand_total_show').text("₹ " + standard_grand_total);
            $('#grand_total').val(standard_grand_total);

        });

        $(".inc").on("click", function () { //express service
            swal({
                title: "Please Login",
                text: "",
                icon: "warning",
                button: "Ok",
            }).then(function () {
                window.location = "login.php";
            });
        });

        $(".dec").on("click", function () { //express service
            swal({
                title: "Please Login",
                text: "",
                icon: "warning",
                button: "Ok",
            }).then(function () {
                window.location = "login.php";
            });
        });

        $("#promo_submit").on("click", function () {
            var enter_promocode = $("#enter_promocode").val();
            if (enter_promocode == "") {
                swal({
                    title: "Please Enter Promocode!",
                    icon: "warning",
                    button: "Ok!",
                });
            } else {

                $.ajax({
                    url: 'ajax.php',
                    type: 'GET',
                    data: 'enter_promocode=' + enter_promocode,
                    success: function (data) {
                        if (data == "false") {
                            swal({
                                title: "Sorry, Wrong Promocode..",
                                icon: "warning",
                                button: "Ok!",
                            });
                        } else {
                            var parsed_result = JSON.parse(data);
                            var discount = parsed_result.discount;
                            var grand_total1 = $('#grand_total').val();

                            var total_grand_total1 = Number(grand_total1) - Number(discount);

                            if (total_grand_total1 > 0) {
                                $('#grand_total').val(total_grand_total1);
                                $('#grand_total_show').text("₹ " + total_grand_total1);
                                $('#promo_submit').fadeOut(0);
                                $('#promo_mess').fadeIn(500);
                                $('#promo_mess1').fadeIn(500);
                                $('#promo_mess2').text("₹ " + discount);
                                $('#promo_mess2').fadeIn(500);
                            }

                        }
                    }
                });
            }

        });
    });
</script>
<?php
$status_alert = $_SESSION['status'];

if (isset($_SESSION['status'])) {
    if ($status_alert == "Sorry, This area is out of service .!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "warning",
                button: "Ok",
            }).then(function () {
                window.location = "login.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "We are Coming soon Your Area..") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
            }).then(function () {
                window.location = "product.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "This Item Is Out Of Stock..") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",
            }).then(function () {
                window.location = "product.php";
            });
        </script>
        <?php
    }
    unset($_SESSION['status']);
    unset($_SESSION['code']);
}
?>
<!-- for place order data  -->
<?php
if (isset($_REQUEST['place_order'])) {

    if (!isset($_SESSION['cust_id'])) {
        $_SESSION['status'] = "Please Login";
        $_SESSION['code'] = "error";
    } else {
        $_SESSION['final_pro_id_array'] = $pro_id_array;
        $_SESSION['final_single_quantity'] = $stock_quantity;
        $_SESSION['final_shipping_charge'] = $_REQUEST['shipping_mode'];
        $_SESSION['final_total_product'] = $total_quantity;
        $_SESSION['final_sub_total'] = $_REQUEST['grand_total'];
        $_SESSION['final_standard_charge'] = $_REQUEST['standard_charge'];
        $_SESSION['final_express_charge'] = $_REQUEST['express_charge'];
        $_SESSION['final_delivery_pincode'] = $_REQUEST['final_pincode'];
        $_SESSION['has_cod'] = $_REQUEST['has_cod'];

         if (isset($_SESSION['final_delivery_pincode'])) {
                    $pincodex = $_SESSION['final_delivery_pincode'];
                    $query = mysqli_query($conn,"SELECT 1 FROM location WHERE pincode = '{$pincodex}'");
                    if (mysqli_num_rows($query) > 0){
                    echo "<script> window.location='checkout.php'; </script>";
                    }else{
                         $_SESSION['status'] = "Enter Valid Pincode..!";
                        $_SESSION['code'] = "error";
                      }
                 }
    }

}

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
$status_alert = $_SESSION['status'];

if (isset($_SESSION['status'])) {
    if ($status_alert == "Please Login") {
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
<!-- Mirrored from demo.hasthemes.com/ecolife-preview/ecolife/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2020 05:49:37 GMT -->
</html>