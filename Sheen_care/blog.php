
<?php
include('header.php');
include('admin/connection.php');
?>

            <!-- Breadcrumb Area start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">Blog Post</h1>
                                <ul class="breadcrumb-links">
                                    <li><a href="index.html">Home</a></li>
                                    <li>Blog List</li>
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
                            

                            
                            


                     <?php
                        $select ="SELECT * FROM blog";
                        $run = mysqli_query($conn, $select);
                         while ($data = mysqli_fetch_array($run)) 
                          {
                      ?>


                            <!-- single blog post -->
                            <div class="row mt-50">
                                <div class="col-lg-5 col-md-6">
                                    <div class="single-blog-post blog-grid-post">
                                        <div class="blog-post-media">
                                            <div class="blog-image">
                                                <a href="blog_description.php?blog_id=<?php echo $data['blog_id']; ?>"><img src="admin/upload/blog/<?php echo $data['blog_image']; ?>" alt="blog" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 align-self-center align-items-center">
                                    <div class="blog-post-content-inner">
                                        <h4 class="blog-title"><a href="blog_description.php?blog_id=<?php echo $data['blog_id']; ?>"><?php echo $data['blog_title']; ?></a></h4>
                                        <ul class="blog-page-meta">
                                            <li>
                                                <a href="#"><i class="ion-person"></i> Admin</a>
                                            </li>
                                          
                                        </ul>
                                        <p>
                                            <?php echo $data['blog_short_description']; ?>
                                        </p>
                                        <a class="read-more-btn" href="blog_description.php?blog_id=<?php echo $data['blog_id']; ?>"> Read More <i class="ion-android-arrow-dropright-circle"></i></a>
                                    </div>
                                </div>
                             
                            </div>
                               <!-- single blog post -->
                            <?php
                            }
                            ?>














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
             
                    </div>
                </div>
            </div>
            <!-- Shop Category Area End -->
           
         <?php include('includes/footer.php');?>       

 <?php include('includes/footerscript.php');?> 
    </body>

</html>
