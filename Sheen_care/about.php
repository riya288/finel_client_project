<?php

include('header.php');

include('admin/connection.php');







    $select7 ="SELECT * FROM about_us";

    $run7= mysqli_query($conn, $select7);

    while ($data7 = mysqli_fetch_array($run7)) 

    {

        $about_title = $data7['about_title'];

        $about_description = $data7['about_description'];

        $company_description = $data7['company_description'];

        $team_description = $data7['team_description'];

        $testimonial_description = $data7['testimonial_description'];

        $about_image = $data7['about_image'];



    }





?>



            <!-- Breadcrumb Area start -->

            <section class="breadcrumb-area">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="breadcrumb-content">

                                <h1 class="breadcrumb-hrading">About Page</h1>

                                <ul class="breadcrumb-links">

                                    <li><a href="index.php">Home</a></li>

                                    <li>About</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Breadcrumb Area End -->



            <!-- About Area Start -->

            <section class="about-area">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-4 mb-res-sm-50px">

                            <div class="about-left-image">

                                <img src="admin/upload/about_us/<?php echo $about_image; ?>" alt="" class="img-responsive" />

                            </div>

                        </div>

                        <div class="col-lg-8">

                            <div class="about-content">

                                <div class="about-title">

                                    <h2><?php echo $about_title; ?></h2>

                                </div>

                                <p class="mb-30px" style="text-align: justify;">

                                    <?php echo $about_description; ?>

                                </p>

                                

                            </div>

                        </div>

                    </div>

                    <div class="row mt-60px">

                        <div class="col-md-4 mb-res-sm-30px">

                            <div class="single-about">

                                <h4>Aim</h4>

                                <p>

                                  <?php echo $company_description; ?>

                                </p>

                            </div>

                        </div>

                        <div class="col-md-4 mb-res-sm-30px">

                            <div class="single-about">

                                <h4>Focus</h4>

                                <p>

                                    <?php echo $team_description; ?>

                                </p>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="single-about">

                                <h4>Mission</h4>

                                <p>

                                   <?php echo $testimonial_description; ?>

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            <!-- About Area End -->



            

         <?php include('includes/footer.php');?>       



 <?php include('includes/footerscript.php');?> 

    </body>



</html>

