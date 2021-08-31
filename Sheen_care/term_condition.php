<?php
include('header.php');
include('admin/connection.php');



    $select7 ="SELECT * FROM term_condition";
    $run7= mysqli_query($conn, $select7);
    while ($data7 = mysqli_fetch_array($run7)) 
    {
        $term_condition = $data7['term_condition'];
        

    }


?>

            <!-- Breadcrumb Area start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">Term & Condition</h1>
                                <ul class="breadcrumb-links">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Term & Condition</li>
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
                        <div class="col-lg-12">
                            <div class="about-content">
                                <div class="about-title">
                                    <h2>Our Term & Condition</h2>
                                </div>
                                <p class="mb-30px" style="text-align: justify;">
                                    <?php echo $term_condition; ?>
                                </p>
                                
                            </div>
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
