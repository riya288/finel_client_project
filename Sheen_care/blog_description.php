<?php

include('header.php');

include('admin/connection.php');

$blog_id = $_REQUEST['blog_id'];



$select="SELECT * FROM blog WHERE blog_id = '{$blog_id}'";

$run = mysqli_query($conn, $select);



while ($data = mysqli_fetch_array($run)) 

{

    $blog_image = $data['blog_image'];    

    $blog_title = $data['blog_title'];    

    $blog_long_description = $data['blog_long_description'];    

   



}



?>





            <!-- Breadcrumb Area start -->

            <section class="breadcrumb-area">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="breadcrumb-content">

                                <h1 class="breadcrumb-hrading">Blog Post</h1>

                                <ul class="breadcrumb-links">

                                    <li><a href="index.php">Home</a></li>

                                    <li><?php echo $blog_title; ?></li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Breadcrumb Area End -->

            <!-- Shop Category Area End -->

            <div class="shop-category-area single-blog">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-12 col-md-12">

                            <div class="blog-posts">

                                <div class="single-blog-post blog-grid-post">

                                    <div class="blog-post-media">

                                        <div class="blog-image single-blog">

                                            <a href="blog.php"><img src="admin/upload/blog/<?php echo $blog_image; ?>"  style="height:300px;" alt="blog" /></a>

                                        </div>

                                    </div>

                                    <div class="blog-post-content-inner">

                                        <h4 class="blog-title"><a href="#"><?php echo $blog_title; ?></a></h4>

                                        <ul class="blog-page-meta">

                                            <li>

                                                <a href="#"><i class="ion-person"></i> Admin</a>

                                            </li>

                                        

                                        </ul>

                                        <p>

                                           <?php echo $blog_long_description; ?></p>

                                    </div>

                                    <div class="single-post-content">

                                       

                                    </div>

                                </div>

                                <!-- single blog post -->

                            </div>

 

                        <!-- Sidebar Area Start -->

                        <!--<div class="col-lg-3 col-md-12 mb-res-md-60px mb-res-sm-60px">-->

                        <!--    <div class="left-sidebar">-->

                                <!-- Sidebar single item -->

                        <!--        <div class="sidebar-widget">-->

                        <!--            <div class="main-heading">-->

                        <!--                <h2>Search</h2>-->

                        <!--            </div>-->

                        <!--            <div class="search-widget">-->

                        <!--                <form action="#">-->

                        <!--                    <input placeholder="Search entire store here ..." type="text" />-->

                        <!--                    <button type="submit"><i class="ion-ios-search-strong"></i></button>-->

                        <!--                </form>-->

                        <!--            </div>-->

                        <!--        </div>-->

                                <!-- Sidebar single item -->

                                <!-- Sidebar single item -->

                        <!--        <div class="sidebar-widget mt-40">-->

                        <!--            <div class="main-heading">-->

                        <!--                <h2>Categories</h2>-->

                        <!--            </div>-->

                        <!--            <div class="category-post">-->

                        <!--                <ul>-->

                        <!--                    <li><a href="#">Dresses (20)</a></li>-->

                        <!--                    <li><a href="#">Jackets & Coats (9)</a></li>-->

                        <!--                    <li><a href="#">Sweaters (5)</a></li>-->

                        <!--                    <li><a href="#">Jeans (11)</a></li>-->

                        <!--                    <li><a href="#">Blouses & Shirts (3)</a></li>-->

                        <!--                    <li><a href="#">Electronic Cigarettes (6)</a></li>-->

                        <!--                    <li><a href="#">Bags & Cases (4)</a></li>-->

                        <!--                </ul>-->

                        <!--            </div>-->

                        <!--        </div>-->

                                <!-- Sidebar single item -->

                        <!--        <div class="sidebar-widget mt-40">-->

                        <!--            <div class="main-heading">-->

                        <!--                <h2>Recent Post</h2>-->

                        <!--            </div>-->

                        <!--            <div class="recent-post-widget">-->

                                        

                        



                        <!--            </div>-->

                        <!--        </div>-->

                                <!-- Sidebar single item -->

                        <!--        <div class="sidebar-widget mt-40">-->

                        <!--            <div class="main-heading">-->

                        <!--                <h2>Tag</h2>-->

                        <!--            </div>-->

                        <!--            <div class="sidebar-widget-tag">-->

                        <!--                <ul>-->

                        <!--                    <li><a href="#">Fresh Fruit</a></li>-->

                        <!--                    <li><a href="#"> Fresh Vegetables</a></li>-->

                        <!--                    <li><a href="#">Fresh Salad</a></li>-->

                        <!--                    <li><a href="#"> Butter & Eggs</a></li>-->

                        <!--                </ul>-->

                        <!--            </div>-->

                        <!--        </div>-->

                                <!-- Sidebar single item -->

                        <!--    </div>-->

                        <!--</div>-->

                        <!-- Sidebar Area End -->

                    </div>

                </div>

            </div>

            <!-- Shop Category Area End -->

            

         <?php include('includes/footer.php');?>       



 <?php include('includes/footerscript.php');?> 

    </body>



</html>

