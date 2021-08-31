<?php
include('header.php');
include('admin/connection.php');

if (!isset($_GET['reload'])) {
    echo '<meta http-equiv=Refresh content="0;url=index.php?reload=1">';
}
session_start();
?>


<!-- Slider Arae Start -->
<div class="slider-area">
    <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">

        <?php

        $select7 = "SELECT * FROM slider";
        $run7 = mysqli_query($conn, $select7);
        while ($data7 = mysqli_fetch_array($run7)) {
            ?>
            <!-- Slider Single Item Start -->
            <div class="slider-height-6 d-flex align-items-start justify-content-start bg-img"
                 style="background-image: url(admin/upload/slider/<?php echo $data7['slider_image']; ?>);">
                <div class="container">
                    <div class="slider-content-1 slider-animated-1 text-left">
                        <span class="animated"><?php echo $data7['text1']; ?></span>
                        <h1 class="animated">
                            <?php echo $data7['text2']; ?> <br/>

                        </h1>
                        <p class="animated"><?php echo $data7['text3']; ?></p>
                        <a href="<?php echo $data7['slider_url']; ?>" class="shop-btn animated">Shop Now</a>
                    </div>
                </div>
            </div>

        <?php } ?>
        <!-- Slider Single Item End -->

    </div>
</div>
<!-- Slider Arae End -->


<!-- Recent Add Product Area Start -->
<section class="recent-add-area mt-30 mb-30px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>Best Seller Product</h2>
                    <p>Popular products:</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Recent Product slider Start -->
        <div class="best-sell-slider owl-carousel owl-nav-style">
            <!-- Single Item -->

            <?php

            $select1 = "SELECT * FROM product";
            $run1 = mysqli_query($conn, $select1);
            while ($data1 = mysqli_fetch_array($run1)) {
                $offer_status = $data1['offer_status'];
                $price = $data1['price'];
                $offer_price = $data1['offer_price'];
                $product_rating = $data1['product_rating'];

                $per = ($offer_price * 100) / $price;
                $per = round($per);
                $tmp = 100 - $per;
                $simpale_per = ($price * 100) / $price;
                $tmp1 = 100 - $simpale_per;
                $simpale_per = $tmp1;
                $dis_per = $tmp;

                ?>
                <article class="list-product">
                    <div class="img-block">
                        <a href="single_product.php?pro_id=<?php echo $data1['pro_id']; ?>" class="thumbnail">
                            <img class="first-img" src="admin/upload/product/<?php echo $data1['pro_image']; ?>"
                                 alt=""/>
                            <img class="second-img" src="admin/upload/product/<?php echo $data1['pro_image2']; ?>"
                                 alt=""/>
                        </a>

                    </div>

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
                                <li class="current-price">₹ <?php

                                    if ($offer_status > 0) {
                                        echo $data1['offer_price'];
                                    } else {
                                        echo $data1['price'];
                                    }


                                    ?></li>
                                <?php
                                if ($offer_status > 0) {
                                    ?>
                                    <li class="discount-price"><?php
                                        echo $dis_per . '%'; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>

                            <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php echo $data1['pro_id']; ?>)">ADD
                                    TO CART </a></li>

                            <!--       <?php
                            //if (isset($_SESSION['cust_id']))
                            {
                                ?>
                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<? php// echo $data1['pro_id'];
                                ?>)">ADD TO CART </a></li>
                                                <?php
                            }
                            // else
                            {
                                ?>
                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<? php// echo $data1['pro_id'];
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


<!-- Category Area Start -->
<!--        <section class="categorie-area">
           <div class="container">
               <div class="row">
                   <div class="col-md-12">

                       <div class="section-title mt-res-sx-30px mt-res-md-30px">
                           <h2>Popular Categories</h2>
                           <p>Add Popular Categories to weekly line up</p>
                       </div>


                   </div>
               </div>

                   <div class="category-slider owl-carousel owl-nav-style"> -->


<?php

// $select2 ="SELECT * FROM root_category";
// $run2= mysqli_query($conn, $select2);
// while ($data2 = mysqli_fetch_array($run2))
// {
?>


<!--                  <div class="category-item">
                            <div class="category-list mb-30px">
                                <div class="category-thumb">
                                    <a href="mobile_product.php">
                                        <img src="admin/upload/category/<? php// echo $data2['root_category_image']; ?>" alt="" style="width: 100%; height: 20vh;" />
                                    </a>
                                </div>
                                <div class="desc-listcategoreis">
                                    <div class="name_categories">
                                        <h4><? php// echo $data2['root_category']; ?></h4>
                                    </div>
                                    <a href="mobile_product.php"> Shop Now <i class="ion-android-arrow-dropright-circle"></i></a>
                                </div>
                            </div>
                         
            
                            </div> -->

<?php
//}
?>

<!--
                  </div>
              </div>
          </section> -->

<!-- Category Area End  -->


<!-- Hot deal area Start -->
<section class="hot-deal-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 ">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section Title -->
                        <div class="section-title">
                            <h2>Hot Deals</h2>
                            <p>Add hot products to weekly line up</p>
                        </div>
                        <!-- Section Title End-->
                    </div>
                </div>
                <!-- Hot Deal Slider Start -->
                <div class="hot-deal owl-carousel owl-nav-style">


                    <?php

                    $select3 = "SELECT * FROM product WHERE hot_deal = 1";
                    $run3 = mysqli_query($conn, $select3);
                    while ($data3 = mysqli_fetch_array($run3)) {
                        $offer_status = $data3['offer_status'];
                        $price = $data3['price'];
                        $offer_price = $data3['offer_price'];
                        $product_rating = $data3['product_rating'];

                        $per = ($offer_price * 100) / $price;
                        $per = round($per);
                        $tmp = 100 - $per;
                        $simpale_per = ($price * 100) / $price;
                        $tmp1 = 100 - $simpale_per;
                        $simpale_per = $tmp1;
                        $dis_per = $tmp;
                        ?>
                        <!--  Single item -->
                        <article class="list-product">
                            <div class="img-block">
                                <a href="single_product.php?pro_id=<?php echo $data3['pro_id']; ?>" class="thumbnail">
                                    <img class="first-img" src="admin/upload/product/<?php echo $data3['pro_image']; ?>"
                                         alt=""/>
                                    <img class="second-img"
                                         src="admin/upload/product/<?php echo $data3['pro_image2']; ?>" alt=""/>
                                </a>

                            </div>
                            <ul class="product-flag">
                                <li class="new">New</li>
                            </ul>


                            <div class="product-decs">
                                <h2><a href="single_product.php?pro_id=<?php echo $data3['pro_id']; ?>"
                                       class="product-link"><?php echo $data3['pro_name']; ?></a></h2>
                                <a class="inner-link"
                                   href="single_product.php?pro_id=<?php echo $data3['pro_id']; ?>"><span><?php echo $data3['pro_short_description']; ?></span></a>
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
                                        <li class="old-price">₹ <?php echo $data3['price']; ?></li>
                                        <li class="current-price">₹ <?php

                                            if ($offer_status > 0) {
                                                echo $data3['offer_price'];
                                            } else {
                                                echo $data3['price'];
                                            }


                                            ?></li>
                                        <?php
                                        if ($offer_status > 0) {
                                            ?>
                                            <li class="discount-price"><?php
                                                echo $dis_per . '%'; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="add-to-link">
                                    <ul>

                                        <li class="cart"><a class="cart-btn"
                                                            onclick="add_to_cart(<?php echo $data3['pro_id']; ?>)">ADD
                                                TO CART </a></li>

                                        <!-- <?php
                                        //if (isset($_SESSION['cust_id']))
                                        {
                                            ?>
                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php //echo $data3['pro_id'];
                                            ?>)">ADD TO CART </a></li>
                                                <?php
                                        }
                                        //else
                                        {
                                            ?>
                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<?php //echo $data3['pro_id'];
                                            ?>">ADD TO CART </a></li>
                                                <?php
                                        }
                                        ?> -->

                                    </ul>
                                </div>
                            </div>

                        </article>
                        <!--  Single item -->
                        <?php
                    }
                    ?>

                    <!--  Single item -->
                </div>
                <!-- Hot Deal Slider End -->
            </div>


            <!-- New Arrivals Area Start -->
            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section Title -->
                        <div class="section-title ml-0px mt-res-sx-30px">
                            <h2>New Arrivals</h2>
                            <p>Add new products to weekly line up</p>
                        </div>
                        <!-- Section Title -->
                    </div>
                </div>
                <!-- New Product Slider Start -->
                <div class="new-product-slider owl-carousel owl-nav-style">
                    <!-- Product Single Item -->


                    <?php

                    $select4 = "SELECT * FROM product ORDER BY pro_id DESC";
                    $run4 = mysqli_query($conn, $select4);
                    while ($data4 = mysqli_fetch_array($run4)) {
                        $offer_status = $data4['offer_status'];
                        $price = $data4['price'];
                        $offer_price = $data4['offer_price'];
                        $product_rating = $data4['product_rating'];
                        $per = ($offer_price * 100) / $price;
                        $per = round($per);
                        $tmp = 100 - $per;
                        $simpale_per = ($price * 100) / $price;
                        $tmp1 = 100 - $simpale_per;
                        $simpale_per = $tmp1;
                        $dis_per = $tmp;
                        ?>
                        <div class="product-inner-item">
                            <article class="list-product mb-30px">
                                <div class="img-block">
                                    <a href="single_product.php?pro_id=<?php echo $data4['pro_id']; ?>"
                                       class="thumbnail">
                                        <img class="first-img"
                                             src="admin/upload/product/<?php echo $data4['pro_image']; ?>" alt=""/>
                                        <img class="second-img"
                                             src="admin/upload/product/<?php echo $data4['pro_image2']; ?>" alt=""/>
                                    </a>

                                </div>

                                <div class="product-decs">

                                    <h2><a href="single_product.php?pro_id=<?php echo $data4['pro_id']; ?>"
                                           class="product-link"><?php echo $data4['pro_name']; ?></a></h2>
                                    <a class="inner-link"
                                       href="shop-4-column.html"><span><?php echo $data4['pro_short_description']; ?></span></a>
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
                                            <li class="old-price">₹ <?php echo $data4['price']; ?></li>
                                            <li class="current-price">₹ <?php

                                                if ($offer_status > 0) {
                                                    echo $data4['offer_price'];
                                                } else {
                                                    echo $data4['price'];
                                                } ?></li>
                                            <li class="discount-price"><?php

                                                if ($offer_status > 0) {
                                                    echo $dis_per;
                                                } else {
                                                    echo $simpale_per;
                                                }
                                                ?>%
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="add-to-link">
                                    <ul>

                                        <li class="cart"><a class="cart-btn"
                                                            onclick="add_to_cart(<?php echo $data4['pro_id']; ?>)">ADD
                                                TO CART </a></li>


                                        <!--                          <?php
                                        //if (isset($_SESSION['cust_id']))
                                        {
                                            ?>
                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php //echo $data4['pro_id'];
                                            ?>)">ADD TO CART </a></li>
                                                <?php
                                        }
                                        //else
                                        {
                                            ?>
                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<?php //echo $data4['pro_id'];
                                            ?>">ADD TO CART </a></li>
                                                <?php
                                        }
                                        ?> -->

                                    </ul>
                                </div>
                            </article>

                        </div>
                        <?php
                    }
                    ?>


                </div>
                <!-- Product Slider End -->
            </div>
        </div>
    </div>
</section>
<!-- Hot Deal Area End -->


<!-- Banner Area Start -->
<div class="banner-area">
    <div class="container">
        <div class="row">


            <?php

            $select5 = "SELECT * FROM banner";
            $run5 = mysqli_query($conn, $select5);
            while ($data5 = mysqli_fetch_array($run5)) {
                ?>

                <div class="col-md-6 col-xs-12 mt-res-sx-30px mt-5">
                    <div class="banner-wrapper">
                        <a href="<?php echo $data5['banner_url']; ?>"><img
                                    src="admin/upload/mini_banner/<?php echo $data5['banner_image']; ?>" alt=""
                                    style="width: 100%; height: 50vh"/></a>
                    </div>
                </div>


            <?php } ?>


        </div>
    </div>
</div>
<!-- Banner Area End -->


<!-- Feature Area Start -->
<section class="feature-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>Featured Products</h2>
                    <p>Add products to weekly line up</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Feature Slider Start -->
        <div class="feature-slider owl-carousel owl-nav-style">
            <!-- Single Item -->


            <?php

            $select6 = "SELECT * FROM product ORDER BY pro_id DESC";
            $run6 = mysqli_query($conn, $select6);
            while ($data6 = mysqli_fetch_array($run6)) {
                $offer_status = $data6['offer_status'];
                $product_rating = $data6['product_rating'];
                ?>
                <div class="feature-slider-item">

                    <article class="list-product">
                        <div class="img-block">
                            <a href="single_product.php?pro_id=<?php echo $data6['pro_id']; ?>" class="thumbnail">
                                <img class="first-img" src="admin/upload/product/<?php echo $data6['pro_image']; ?>"
                                     alt=""/>
                                <img class="second-img" src="admin/upload/product/<?php echo $data6['pro_image2']; ?>"
                                     alt=""/>
                            </a>

                        </div>
                        <div class="product-decs">
                            <h2><a href="single_product.php?pro_id=<?php echo $data6['pro_id']; ?>"
                                   class="product-link"><?php echo $data6['pro_name']; ?></a></h2>
                            <a class="inner-link"
                               href="shop-4-column.html"><span><?php echo $data6['pro_short_description']; ?></span></a>
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
                                    <li class="old-price"> ₹ <?php echo $data6['price']; ?></li>
                                    <li class="current-price">₹ <?php

                                        if ($offer_status > 0) {
                                            echo $data6['offer_price'];
                                        } else {
                                            echo $data6['price'];
                                        }


                                        ?></li>
                                    <?php
                                    if ($offer_status > 0) {
                                        ?>
                                        <li class="discount-price"><?php
                                            echo $dis_per . '%'; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="add-to-link">
                            <ul>

                                <li class="cart"><a class="cart-btn"
                                                    onclick="add_to_cart(<?php echo $data6['pro_id']; ?>)">ADD TO
                                        CART </a></li>


                                <!--             <?php
                                //if (isset($_SESSION['cust_id']))
                                {
                                    ?>
                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php //echo $data6['pro_id'];
                                    ?>)">ADD TO CART </a></li>
                                                <?php
                                }
                                //else
                                {
                                    ?>
                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<? php// echo $data6['pro_id'];
                                    ?>">ADD TO CART </a></li>
                                                <?php
                                }
                                ?> -->


                            </ul>
                        </div>
                    </article>
                    <!-- Single Item -->
                </div>


            <?php } ?>


            <!-- Feature Slider End -->
        </div>
</section>
<!-- Feature Area End -->
<!-- Banner Area 2 Start -->
<div class="banner-area-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-inner">
                    <?php
                    $select8 = "SELECT * FROM long_banner ORDER BY long_banner_id DESC LIMIT 1";
                    $run8 = mysqli_query($conn, $select8);

                    while ($data8 = mysqli_fetch_array($run8)) {
                        ?>
                        <a href="<?php echo $data8['long_banner_url']; ?>"><img
                                    src="admin/upload/long_banner/<?php echo $data8['long_banner_image']; ?>"
                                    alt=""/></a>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area 2 End -->
<!-- Recent Add Product Area Start -->
<section class="recent-add-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>Recently Added</h2>
                    <p>Add products to weekly line up</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Recent Product slider Start -->
        <div class="recent-product-slider owl-carousel owl-nav-style">
            <?php

            $select4 = "SELECT * FROM product ORDER BY pro_id DESC";
            $run4 = mysqli_query($conn, $select4);
            while ($data4 = mysqli_fetch_array($run4)) {
                $offer_status = $data4['offer_status'];
                $price = $data4['price'];
                $offer_price = $data4['offer_price'];
                $product_rating = $data4['product_rating'];

                $per = ($offer_price * 100) / $price;
                $per = round($per);
                $tmp = 100 - $per;
                $simpale_per = ($price * 100) / $price;
                $tmp1 = 100 - $simpale_per;
                $simpale_per = $tmp1;
                $dis_per = $tmp;
                ?>
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single_product.php?pro_id=<?php echo $data4['pro_id']; ?>" class="thumbnail">
                                <img class="first-img" src="admin/upload/product/<?php echo $data4['pro_image']; ?>"
                                     alt=""/>
                                <img class="second-img" src="admin/upload/product/<?php echo $data4['pro_image2']; ?>"
                                     alt=""/>
                            </a>
                        </div>

                        <div class="product-decs">

                            <h2><a href="single_product.php?pro_id=<?php echo $data4['pro_id']; ?>"
                                   class="product-link"><?php echo $data4['pro_name']; ?></a></h2>
                            <a class="inner-link"
                               href="shop-4-column.html"><span><?php echo $data4['pro_short_description']; ?></span></a>
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
                                    <li class="old-price"> ₹ <?php echo $data4['price']; ?></li>
                                    <li class="current-price">₹ <?php

                                        if ($offer_status > 0) {
                                            echo $data4['offer_price'];
                                        } else {
                                            echo $data4['price'];
                                        }


                                        ?></li>
                                    <?php
                                    if ($offer_status > 0) {
                                        ?>
                                        <li class="discount-price"><?php
                                            echo $dis_per . '%'; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="add-to-link">
                            <ul>

                                <li class="cart"><a class="cart-btn"
                                                    onclick="add_to_cart(<?php echo $data4['pro_id']; ?>)">ADD TO
                                        CART </a></li>

                                <!--   <?php
                                //if (isset($_SESSION['cust_id']))
                                {
                                    ?>
                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php //echo $data4['pro_id'];
                                    ?>)">ADD TO CART </a></li>
                                                <?php
                                }
                                // else
                                {
                                    ?>
                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<?php //echo $data4['pro_id'];
                                    ?>">ADD TO CART </a></li>
                                                <?php
                                }
                                ?> -->


                            </ul>
                        </div>
                    </article>

                </div>
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
                        window.location.reload(2);
                    });

                } else {
                    swal({
                        title: "Something went wrong.!",
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

</body>
</html>
