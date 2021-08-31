<?php 

include('header.php');

include('admin/connection.php');



$child_category_id = $_REQUEST['child_category_id'];



if (isset($_REQUEST['child_category_id'])) 

{



}



?>



            <!-- Breadcrumb Area start -->

            <section class="breadcrumb-area">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="breadcrumb-content">

                                <h1 class="breadcrumb-hrading">Product </h1>

                                <ul class="breadcrumb-links">

                                    <li><a href="index.php">Home</a></li>

                                    <li>Product</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Breadcrumb Area End -->

            <!-- Shop Category Area End -->

            <div class="shop-category-area">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-12 col-md-12">

                            <!-- Shop Top Area Start -->

                            <div class="shop-top-bar">



                                            <?php

                                            if (isset($_REQUEST['child_category_id'])) 

                                            {

                                                $select ="SELECT * FROM product WHERE child_category_id  = '{$child_category_id}'";

                                            }

                                            else

                                            {

                                                $select ="SELECT * FROM product";

                                            }

                                            

                                            $run = mysqli_query($conn, $select);

                                            $num = mysqli_num_rows($run);

                                            ?>

                                <!-- Left Side start -->

                                <div class="shop-tab nav mb-res-sm-15">

                                    <a class="active" href="#shop-1" data-toggle="tab">

                                        <i class="fa fa-th show_grid"></i>

                                    </a>

                                    <a href="#shop-2" data-toggle="tab">

                                        <i class="fa fa-list-ul"></i>

                                    </a>

                                    <p>There Are <?php echo $num; ?> Products.</p>

                                </div>

                                <!-- Left Side End -->

                         

                            </div>

                            <!-- Shop Top Area End -->



                            <!-- Shop Bottom Area Start -->

                            <div class="shop-bottom-area mt-35">

                                <!-- Shop Tab Content Start -->

                                <div class="tab-content jump">

                                    <!-- Tab One Start -->

                                    <div id="shop-1" class="tab-pane active">

                                        <div class="row">

                                            

                                            <?php

                                            while ($data = mysqli_fetch_array($run)) 

                                            { 

                                            $offer_status = $data['offer_status'];

                                            $price= $data['price'];

                                            $offer_price= $data['offer_price'];

                                            $product_rating = $data['product_rating'];



                                              $per = ($offer_price * 100) / $price;

                                              $per=round($per);

                                              $tmp=100-$per;

                                              $simpale_per = ($price * 100) /$price;

                                              $tmp1=100-$simpale_per;

                                              $simpale_per = $tmp1;

                                              $dis_per = $tmp;

                                            ?>

                                                        <div class="col-xl-3 col-md-4 col-sm-6">

                                                            <article class="list-product">

                                                                <div class="img-block">

                                                                    <a href="single_product.php?pro_id=<?php echo $data['pro_id']; ?>" class="thumbnail">

                                                                        <img class="first-img" src="admin/upload/product/<?php echo $data['pro_image'];?>" alt=""/>

                                                                        <img class="second-img" src="admin/upload/product/<?php echo $data['pro_image2'];?>" alt=""/>

                                                                    </a>

                                                                    <!-- <div class="quick-view">

                                                                       



                                                                        <a class="quick_view" href="single_product.php?pro_id=<?php echo $data['pro_id']; ?>" >

                                                                            <i id="model_view" class="ion-ios-search-strong"></i>

                                                                        </a>

                                                                    </div> -->

                                                                </div>

                                                              

                                                               <!--  <ul class="product-flag">

                                                                    <li class="new">New</li>

                                                                </ul>
 -->
                                                                <div class="product-decs">

                                                                   

                                                                    <h2><a href="single_product.php?pro_id=<?php echo $data['pro_id']; ?>" class="product-link"><?php echo $data['pro_name'];?></a></h2>

                                                                     <a class="inner-link" href="single_product.php?pro_id=<?php echo $data['pro_id']; ?>"><span><?php echo $data['pro_short_description'];?></span></a>

                                                                    <div class="rating-product">

                                                                        <?php 

                                                                    if ($product_rating == 1) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>      

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>  

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 2) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 3) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 4) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>      

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>                                                                    

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 5) 

                                                                    {

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

                                                                            <li class="old-price">₹ <?php echo $data['price'];?></li>

                                                                            <li class="current-price">₹ <?php 



                                                                            if ($offer_status > 0) 

                                                                            {

                                                                                echo $data['offer_price'];

                                                                            }

                                                                            else

                                                                            {

                                                                                echo $data['price'];

                                                                            }

                                                                            



                                                                            ?></li>
                                                                            <?php 
                                                                              if ($offer_status > 0) 

                                                                              {
                                                                               ?>
                                                                            <li class="discount-price"><?php 
                                                                                echo $dis_per.'%';?></li>
                                                                            <?php } ?>

                                                                        </ul>

                                                                    </div>

                                                                </div>

                                                                <div class="add-to-link">

                                                                    <ul>



                                                                        <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php echo $data['pro_id']; ?>)">ADD TO CART </a></li>





                                                      <!--                            <?php

                                                                //if (isset($_SESSION['cust_id'])) 

                                                                {

                                                                ?>

                                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php //echo $data['pro_id']; ?>)">ADD TO CART </a></li>

                                                                <?php

                                                                }

                                                                //else

                                                                {

                                                                ?>

                                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<?php// echo $data['pro_id']; ?>">ADD TO CART </a></li>

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

                                    </div>

                                    <!-- Tab One End -->



                                  <!-- Tab Two Start -->

                                    <div id="shop-2" class="tab-pane">

                                       



                                          <?php





                                            if (isset($_REQUEST['child_category_id'])) 

                                            {

                                                $select ="SELECT * FROM product WHERE child_category_id  = '{$child_category_id}'";

                                            }

                                            else

                                            {

                                                $select ="SELECT * FROM product";

                                            }



                                            $run = mysqli_query($conn, $select);

                                            while ($data = mysqli_fetch_array($run)) 

                                            {   $offer_status = $data['offer_status'];

                                        $product_rating = $data['product_rating'];

                                            ?>

                                        <div class="shop-list-wrap mb-30px scroll-zoom">

                                            <div class="row list-product m-0px">

                                                <div class="col-md-12">

                                                    <div class="row">

                                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                                                            <div class="left-img">

                                                                <div class="img-block">

                                                                    <a href="single_product.php?pro_id=<?php echo $data['pro_id']; ?>" class="thumbnail">

                                                                        <img class="first-img" src="admin/upload/product/<?php echo $data['pro_image'];?>" alt=""  style="width: 100%; height: 30vh;"/>

                                                                        <img class="second-img" src="admin/upload/product/<?php echo $data['pro_image2'];?>" alt="" style="width: 100%; height: 30vh;"/>

                                                                    </a>

                                                                   <!--  <div class="quick-view">

                                                                        <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal?pro_id">

                                                                            <i class="ion-ios-search-strong"></i>

                                                                        </a>

                                                                    </div> -->

                                                                </div>

                                                               <!--  <ul class="product-flag">

                                                                    <li class="new">New</li>

                                                                </ul> -->

                                                            </div>

                                                        </div>

                                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                                                            <div class="product-desc-wrap">

                                                                <div class="product-decs">

                                                                

                                                                    <h2><a href="single_product.php?pro_id=<?php echo $data['pro_id']; ?>" class="product-link"><?php echo $data['pro_name'];?></a></h2>



                                                                      <div class="product-intro-info">

                                                                        <p><?php echo $data['pro_short_description'];?></p>

                                                                    </div>



                                                             

                                                                    <div class="pricing-meta">

                                                                        <ul>

                                                                            <li class="old-price not-cut">₹



                                                                              <?php 



                                                                            if ($offer_status > 0) 

                                                                            {

                                                                                echo $data['offer_price'];

                                                                            }

                                                                            else

                                                                            {

                                                                                echo $data['price'];

                                                                            }

                                                                            



                                                                            ?>

                                                                                

                                                                            </li>

                                                                        </ul>

                                                                    </div>

                                                                 

                                                                        <div class="rating-product">

                                                                        <?php 

                                                                    if ($product_rating == 1) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>      

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>  

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 2) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 3) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>    

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 4) 

                                                                    {

                                                                    ?>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>

                                                                        <i class="ion-android-star" style="color: orange;"></i>      

                                                                        <i class="ion-android-star-outline" style="color: orange;"></i>                                                                    

                                                                    <?php

                                                                    }

                                                                    elseif ($product_rating == 5) 

                                                                    {

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

                                                                <div class="add-to-link">

                                                                    <ul>



                                                                         <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php echo $data['pro_id']; ?>)">ADD TO CART </a></li>







                                                                                <!--  <?php

                                                                //if (isset($_SESSION['cust_id'])) 

                                                                {

                                                                ?>

                                                                    <li class="cart"><a class="cart-btn" onclick="add_to_cart(<?php// echo $data['pro_id']; ?>)">ADD TO CART </a></li>

                                                                <?php

                                                                }

                                                                //else

                                                                {

                                                                ?>

                                                                <li class="cart"><a class="cart-btn" href="single_product.php?pro_id=<?php// echo $data['pro_id']; ?>">ADD TO CART </a></li>

                                                                <?php

                                                                }

                                                                ?> -->

                                                                

                                                                     

                                                                    </ul>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                       

                                            <?php

                                            }

                                            ?>

                                    <!-- Tab Two End -->

                                </div>

                                <!-- Shop Tab Content End -->

                                <!--  Pagination Area Start -->

                                <div class="pro-pagination-style text-center">

                                    <ul>

                                        <li>

                                            <a class="prev" href="#"><i class="ion-ios-arrow-left"></i></a>

                                        </li>

                                        <li><a class="active" href="#">1</a></li>

                                        <li><a href="#">2</a></li>

                                        <li>

                                            <a class="next" href="#"><i class="ion-ios-arrow-right"></i></a>

                                        </li>

                                    </ul>

                                </div>

                                <!--  Pagination Area End -->

                            </div>

                            <!-- Shop Bottom Area End -->

                        </div>

                    </div>

                </div>

            </div>

            <!-- Shop Category Area End -->

             <?php include('includes/footer.php');?>       



 <?php include('includes/footerscript.php');?>      









 <script type="text/javascript">

     

     function add_to_cart(pro_id) 

     {

        var pro_id = pro_id;

         



          $.ajax({ 

              url : 'ajax.php',

              type : 'GET',

              data: 'pro_id=' + pro_id,

              success : function(data)

              {

                   

                       if (data == "true") 

                       {

                                      

                            swal({

                              title: "Item Added",

                              text: "",

                              icon: "success",

                              button: "Ok",

                            }).then(function() {

                              window.location.reload();

                              });

                           

                       }

               } 

           });

     }

 </script> 

    </body>

</html>

