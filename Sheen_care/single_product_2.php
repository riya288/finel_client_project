<?php
include('admin/connection.php');
session_start();
$child_category_id = $_REQUEST['child_category_id'];
$cust_id = $_SESSION['cust_id'];


// for display data
$select = "SELECT * FROM stock JOIN product ON stock.pro_id = product.pro_id WHERE product.child_category_id = '{$child_category_id}'";
$run = mysqli_query($conn, $select);
$stock = 0;
$pro_id = 0;
while ($res = mysqli_fetch_array($run)) {
    $pro_id = $res['pro_id'];
    $pro_name = $res['pro_name'];
    $pro_short_description = $res['pro_short_description'];
    $pro_long_description = $res['pro_long_description'];
    $ingredients = $res['ingredients'];
    $key_benefits = $res['key_benefits'];

    $product_profile = $res['product_profile'];

    $directions_to_use = $res['directions_to_use'];

    $certifications = $res['certifications'];

    $general_info = $res['general_info'];

    $price = $res['price'];
    $offer_price = $res['offer_price'];
    $offer_status = $res['offer_status'];
    $pro_image = $res['pro_image'];
    $stock = $res['stock'];
    $weight = $res['weight'];
    $attribute = $res['attribute'];
    $product_rating = $res['product_rating'];
    $total_rating = $res['total_rating'];
    $iconimage = $res['iconimage'];
    $single_image1 = $res['single_image1'];
    $single_image2 = $res['single_image2'];
    $single_image3 = $res['single_image3'];
    $single_image4 = $res['single_image4'];

}

$per = ($offer_price * 100) / $price;
$per = round($per);
$tmp = 100 - $per;
$simpale_per = ($price * 100) / $price;
$tmp1 = 100 - $simpale_per;
$simpale_per = $tmp1;
$dis_per = $tmp;

// for add to cart
if (isset($_REQUEST['add_to_cart'])) {
    $quantity = $_REQUEST["qtybutton"];
    if (isset($_SESSION['user'])) {
        if ($stock > 0 && $pro_id > 0) {
            // for validation one product only one time add
            $select1 = "SELECT * FROM cart WHERE customer_id = '{$cust_id}'";
            $runn = mysqli_query($conn, $select1);
            while ($dataa = mysqli_fetch_array($runn)) {
                if ($pro_id == $dataa['pro_id']) {
                    $ck_pro_id = $dataa['pro_id'];
                    $ck_quantity = $dataa['quantity'];
                }
            }
            if ($ck_pro_id == $pro_id && $ck_quantity == $ck_quantity) {
                $update = "UPDATE cart SET customer_id='{$cust_id}',pro_id='{$pro_id}',quantity='{$quantity}' WHERE pro_id = '{$pro_id}'";
                $run4 = mysqli_query($conn, $update);

                if ($run4) {
                    echo "<script> window.location='cart.php' </script>";
                }

            } else {
                $insert = "INSERT INTO cart(customer_id,pro_id,quantity) VALUES('{$cust_id}','{$pro_id}','{$quantity}')";
                $run3 = mysqli_query($conn, $insert);

                if ($run3) {
                    echo "<script> window.location='cart.php' </script>";
                }
            }
        } else {
            $_SESSION['status'] = "This Item Is Out Of Stock..";
            $_SESSION['code'] = "error";
        }
    } else {
        if ($stock > 0 && $pro_id > 0) {
            $flag = false;
            if (isset($_SESSION['cart'])) {
                $i = 0;
                foreach ($_SESSION['cart'] as $id => $old_quantity) {
                    if ($id == $pro_id) {
                        $_SESSION['cart'][$pro_id] = $quantity + $old_quantity;
                        $_SESSION['total_cart_items'] += $quantity;
                        $flag = true;
                        break;
                    }
                    $i++;
                }
            }

            if ($flag == false) {
                $_SESSION['cart'][$pro_id] = $quantity;
                $_SESSION['total_cart_items'] += $quantity;
            }
            header('Location: '.$_SERVER['REQUEST_URI']);
        } else {
            $_SESSION['status'] = "This Item Is Out Of Stock..";
            $_SESSION['code'] = "error";
        }


    }


}

if (isset($_REQUEST['review_submit'])) {
    $name = $_REQUEST['name'];
    $review = $_REQUEST['review'];
    $email = $_REQUEST['email'];
    $rating = $_REQUEST['review_rating'];

    $insert_review = "INSERT INTO review(pro_id,name,email,review,rating,image) VALUES('{$pro_id}','{$name}','{$email}','{$review}','{$rating}','demo.png')";
    $insert_run = mysqli_query($conn, $insert_review);

    if ($insert_run) {
        $_SESSION['status'] = "Thank You";
        $_SESSION['code'] = "success";
    }
}

include('header.php');
?>
<style type="text/css">
    @import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);
    /*rating*/
    h1 {
        font-size: 1.5em;
        margin: 10px
    }

    .rating {
        border: none;
        margin-right: 49px
    }

    .myratings {
        font-size: 85px;
        color: green
    }

    .rating > [id^="star"] {
        display: none
    }

    .rating > label:before {
        margin: 5px;
        font-size: 2.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005"
    }

    .rating > .half:before {
        content: "\f089";
        position: absolute
    }

    .rating > label {
        color: #ddd;
        float: right
    }

    .rating > [id^="star"]:checked ~ label,
    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: #FFD700
    }

    .rating > [id^="star"]:checked + label:hover,
    .rating > [id^="star"]:checked ~ label:hover,
    .rating > label:hover ~ [id^="star"]:checked ~ label,
    .rating > [id^="star"]:checked ~ label:hover ~ label {
        color: #FFED85
    }

    .reset-option {
        display: none
    }

    .reset-button {
        margin: 6px 12px;
        background-color: rgb(255, 255, 255);
        text-transform: uppercase
    }

    .mt-100 {
        margin-top: 10px
    }

    .card {
        position: relative;
        display: flex;
        width: 100%;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        padding: 1rem 1rem
    }

    .card .card-body {
        padding: 1rem 1rem
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem
    }

    .btn:focus {
        outline: none
    }

    .btn {
        border-radius: 22px;
        text-transform: capitalize;
        font-size: 13px;
        padding: 8px 19px;
        cursor: pointer;
        color: #fff;
        background-color: #D50000
    }

    .btn:hover {
        background-color: #D32F2F !important
    }
</style>
<!-- Shop details Area start -->
<section class="product-details-area mtb-60px">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2">
                <div id="gallery" class="">
                    <?php
                    if (!empty($single_image1)) {
                        ?>
                        <a class="active" data-image="admin/upload/product/<?php echo $single_image1; ?>"
                           data-zoom-image="admin/upload/product/<?php echo $single_image1; ?>">
                            <img src="admin/upload/product/<?php echo $single_image1; ?>" alt="" class="h-brade"/>
                        </a>
                        <?php
                    }
                    ?>
                    <?php
                    if (!empty($single_image2)) {
                        ?>
                        <a class="" data-image="admin/upload/product/<?php echo $single_image2; ?>"
                           data-zoom-image="admin/upload/product/<?php echo $single_image2; ?>">
                            <img src="admin/upload/product/<?php echo $single_image2; ?>" alt="" class="h-brade"/>
                        </a>
                        <?php
                    }
                    ?>
                    <?php
                    if (!empty($single_image3)) {
                        ?>
                        <a class="" data-image="admin/upload/product/<?php echo $single_image3; ?>"
                           data-zoom-image="admin/upload/product/<?php echo $single_image3; ?>">
                            <img src="admin/upload/product/<?php echo $single_image3; ?>" alt="" class="h-brade"/>
                        </a>
                        <?php
                    }
                    ?>
                    <?php
                    if (!empty($single_image4)) {
                        ?>
                        <a class="" data-image="admin/upload/product/<?php echo $single_image4; ?>"
                           data-zoom-image="admin/upload/product/<?php echo $single_image4; ?>">
                            <img src="admin/upload/product/<?php echo $single_image4; ?>" alt="" class="h-brade"/>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12">
                <div class="product-details-img product-details-tab">
                    <div class="zoompro-wrap zoompro-2">
                        <div class="zoompro-border zoompro-span">
                            <img class="zoompro" src="admin/upload/product/<?php echo $pro_image; ?>"
                                 data-zoom-image="admin/upload/product/<?php echo $pro_image; ?>" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12">
                <div class="product-details-content">
                    <h2><?php echo $pro_name; ?></h2>
                    <p><?php echo $pro_short_description; ?></p>
                    <p><?php echo $pro_long_description; ?></p>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i style="color: orange;"> <?php echo $total_rating; ?> </i>
                            <?php
                            if ($product_rating == 1) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 2) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 3) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 4) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 5) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                   
                           <div class="pricing-meta count">
                                <ul>
                                    <li class="old-price">₹ <?php echo $price. ".00"; ?>
                                    </li>

                                    <li class="current-price"><?php
                                        echo $offer_price . ".00"; ?></li>

                                </ul>
                            </div>
                    <?php if (isset($attribute) && !empty($attribute)) {
                        $peice = explode(",", $attribute);
                        $count = count($peice);
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <div class="btn btn-small pricing-meta" style="background-color: #8e8a8a;"
                                 id="count<?= $i ?>">
                                <li><?= $peice[$i] ?></li>
                            </div>
                        <?php }
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="pro-details-quality mt-5px">
                            <div class="cart-plus-minus">
                                <?php
                                if (isset($_REQUEST['quantity']) && isset($_REQUEST['pro_id'])) {
                                    ?>
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                           value="<?php echo $_REQUEST['quantity']; ?>"/>
                                    <?php
                                } else {
                                    ?>
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" min="1" value="1"/>
                                    <?php
                                }
                                ?>
                            </div>
                            <div style="margin-top: 1%; margin-left: 5%;">
                                <input type="submit" name="add_to_cart" value="ADD TO CART" class="btn btn-success"
                                       style="background-color: green;">
                            </div>
                        </div>
                    </form>

                    <!--  <div class="pro-details-policy">
                       <ul>
                           <li><img src="assets/images/icons/policy.png" alt="" /><span>Security Policy (Edit With Customer Reassurance Module)</span></li>
                           <li><img src="assets/images/icons/policy-2.png" alt="" /><span>Delivery Policy (Edit With Customer Reassurance Module)</span></li>
                           <li><img src="assets/images/icons/policy-3.png" alt="" /><span>Return Policy (Edit With Customer Reassurance Module)</span></li>
                       </ul>
                       </div> -->
                    <?php if ($iconimage == 1) { ?>
                        <div class="iconclass">
                            <img src="assets/images/iconimage.jpg">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop details Area End -->
<!-- product details description area start -->
<div class="description-review-area mb-60px">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a class="active" data-toggle="tab" href="#des-details2">Product Details</a>
                <a data-toggle="tab" href="#des-details4">Ingredients</a>
                <a data-toggle="tab" href="#des-details5">Key Benefits</a>
                <a data-toggle="tab" href="#des-details6">Product Profile </a>
                <a data-toggle="tab" href="#des-details7">Directions to use </a>
                <a data-toggle="tab" href="#des-details8">Certifications</a>
                <a data-toggle="tab" href="#des-details9">General Info</a>
                <?php
                $select_review = "SELECT * FROM review WHERE pro_id = '{$pro_id}' ORDER BY review_id DESC LIMIT 3";
                $run_review = mysqli_query($conn, $select_review);
                $num_rows = mysqli_num_rows($run_review);
                ?>
                <a data-toggle="tab" href="#des-details3">Reviews (<?php echo $num_rows; ?>)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane active">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $pro_long_description; ?></p>
                    </div>
                </div>
                <div id="des-details4" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $ingredients; ?></p>
                    </div>
                </div>
                <div id="des-details5" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $key_benefits; ?></p>
                    </div>
                </div>
                <div id="des-details6" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $product_profile; ?></p>
                    </div>
                </div>
                <div id="des-details7" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $directions_to_use; ?></p>
                    </div>
                </div>
                <div id="des-details8" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $certifications; ?></p>
                    </div>
                </div>
                <div id="des-details9" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <p><?php echo $general_info; ?></p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <?php
                                while ($data_review = mysqli_fetch_array($run_review)) {
                                    $rating = $data_review['rating'];
                                    ?>
                                    <div class="single-review child-review mt-5">
                                        <div class="review-img">
                                            <img src="assets/images/review/<?php echo $data_review['image']; ?>" alt=""
                                                 style="width: 120px; height: 120px; border-radius: 50%;"/>
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="rating-product">
                                                        <?php
                                                        if ($rating == 1) {
                                                            ?>
                                                            <i class="ion-android-star"></i>
                                                            <?php
                                                        } elseif ($rating == 2) {
                                                            ?>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <?php
                                                        } elseif ($rating == 3) {
                                                            ?>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <?php
                                                        } elseif ($rating == 4) {
                                                            ?>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <?php
                                                        } elseif ($rating == 5) {
                                                            ?>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <?php
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p style="width: 100%;"><b><?php echo $data_review['name']; ?></b></p>
                                            </div>
                                            <div class="review-bottom">
                                                <p><?php echo $data_review['review']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <div class="ratting-form">
                                    <form action="" method="POST">
                                        <div class="star-box">
                                            <input type="number" id="myratings" name="review_rating" hidden="">
                                            <h5 class="mt-2 ml-5">Review Rating</small></h5>
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="rating" value="5"/>
                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" name="rating" value="4"/>
                                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3" name="rating" value="3"/>
                                                <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2" name="rating" value="2"/>
                                                <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1" name="rating" value="1"/>
                                                <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                <input type="radio" class="reset-option" name="rating" value="reset"/>
                                            </fieldset>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-10">
                                                    <input placeholder="Name" type="text" name="name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-10">
                                                    <input placeholder="Email" type="email" name="email"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="review" placeholder="Message"></textarea>
                                                    <input type="submit" name="review_submit" value="Submit"/>
                                                </div>
                                            </div>
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
<!-- product details description area end -->
<!-- Recent Add Product Area Start -->
<section class="recent-add-area mt-30 mb-30px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>In The Same Category</h2>
                    <p>some other products in the same category:</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Recent Product slider Start -->
        <div class="recent-product-slider owl-carousel owl-nav-style">
            <!-- Single Item -->
            <?php
            if (isset($_REQUEST['root_category_id'])) {
                $root_category_id = $_REQUEST['root_category_id'];

                $select1 = "SELECT * FROM product WHERE root_category_id = '{$root_category_id}' ";
            } elseif (isset($_REQUEST['sub_category_id'])) {
                $sub_category_id = $_REQUEST['sub_category_id'];
                $select = "SELECT root_category_id  FROM product WHERE sub_category_id = '{$sub_category_id}'";
                $run2 = mysqli_query($conn, $select);
                $res = mysqli_fetch_array($run2);
                $root_category_id = $res['root_category_id'];
                $select1 = "SELECT * FROM product WHERE root_category_id = '{$root_category_id}' ";
            } elseif (isset($_REQUEST['child_category_id'])) {
                $child_category_id = $_REQUEST['child_category_id'];
                $select = "SELECT root_category_id  FROM product WHERE child_category_id = '{$child_category_id}'";
                $run2 = mysqli_query($conn, $select);
                $res = mysqli_fetch_array($run2);
                $root_category_id = $res['root_category_id'];
                $select1 = "SELECT * FROM product WHERE root_category_id = '{$root_category_id}' ";
            } elseif (isset($_REQUEST['pro_id'])) {
                $pro_id = $_REQUEST['pro_id'];
                $select = "SELECT root_category_id  FROM product WHERE pro_id = '{$pro_id}'";
                $run2 = mysqli_query($conn, $select);
                $res = mysqli_fetch_array($run2);
                $root_category_id = $res['root_category_id'];
                $select1 = "SELECT * FROM product WHERE root_category_id = '{$root_category_id}' ";
            } else {

                $select1 = "SELECT * FROM product";
            }


            $run1 = mysqli_query($conn, $select1);
            while ($data1 = mysqli_fetch_array($run1)) {
                $product_rating = $data1['product_rating'];
                ?>
                <article class="list-product">
                    <div class="img-block">
                        <a href="single_product.php?pro_id=<?php echo $data1['pro_id'] ?>" class="thumbnail">
                            <img class="first-img" src="admin/upload/product/<?php echo $data1['pro_image']; ?>"
                                 alt=""/>
                            <img class="second-img" src="admin/upload/product/<?php echo $data1['pro_image2']; ?>"
                                 alt=""/>
                        </a>
                    </div>
                    <!--<ul class="product-flag">-->
                    <!--    <li class="new">New</li>-->
                    <!--</ul>-->
                    <div class="product-decs">
                        <h2><a href="single_product.php?pro_id=<?php echo $data1['pro_id']; ?>"
                               class="product-link"><?php echo $data1['pro_name']; ?></a></h2>
                        <a class="inner-link"
                           href="single_product.php?pro_id=<?php echo $data1['pro_id']; ?>"><span><?php echo $data1['pro_short_description']; ?></span></a>
                        <div class="rating-product">
                            <?php
                            if ($product_rating == 1) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 2) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 3) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 4) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star-outline" style="color: orange;"></i>
                                <?php
                            } elseif ($product_rating == 5) {
                                ?>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <i class="ion-android-star" style="color: orange;"></i>
                                <?php
                            }

                            ?>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">₹ <?php echo $data1['price']; ?></li>
                                <li class="current-price">₹ <?php echo $data1['offer_price']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php echo $data1['pro_id']; ?>)">ADD
                                    TO CART </a></li>
                            <!--  <?php
                            //if (isset($_SESSION['cust_id']))
                            {
                                ?>
                     <li class="cart"><a class="cart-btn" onclick="add_to_cart(<? php// echo $data1['pro_id'];
                                ?>)">ADD TO CART </a></li>
                     <?php
                            }
                            //else
                            {
                                ?>
                     <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<?php //echo $data1['pro_id'];
                                ?>">ADD TO CART </a></li>
                     <?php
                            }
                            ?> -->
                        </ul>
                    </div>
                </article>
                <?php
            }
            ?>
            <!-- Single Item -->
        </div>
        <!-- Recent product slider end -->
    </div>
</section>
<!-- Recent product area end -->
<?php include('includes/footer.php'); ?>
<?php include('includes/footerscript.php'); ?>
<script>
    // for rating review
    $("input[type='radio']").click(function () {
        var sim = $("input[type='radio']:checked").val();

        $("#myratings").val(sim);


    });
</script>
<?php
$status_alert = $_SESSION['status'];


if (isset($_SESSION['status'])) {
    if ($status_alert == "Please Login Again..") {
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
    } elseif ($status_alert == "We are coming soon in your area..") {
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
    } elseif ($status_alert == "Thank You") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "single_product.php?pro_id=<?php echo $pro_id; ?>";
            });
        </script>
        <?php
    }

    unset($_SESSION['status']);
    unset($_SESSION['code']);

}
?>
<script type="text/javascript">
    function add_to_cart(pro_id) {
        var pro_id = pro_id;


        $.ajax({
            url: 'ajax.php',
            type: 'GET',
            data: 'pro_id=' + pro_id,
            success: function (data) {

                if (data) {

                    swal({
                        title: "Item Added",
                        text: "",
                        icon: "success",
                        button: "Ok",
                    }).then(function () {
                        window.location.reload();
                    });

                }
            }
        });
    }
</script>
</body>
</html>