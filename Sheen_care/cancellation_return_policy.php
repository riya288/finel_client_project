<?php
include('header.php');
include('admin/connection.php');



    $select7 ="SELECT * FROM cancellation_return_policy";
    $run7= mysqli_query($conn, $select7);
    while ($data7 = mysqli_fetch_array($run7)) 
    {
        $cancellation_return_policy = $data7['cancellation_return_policy'];
        

    }


?>

            <!-- Breadcrumb Area start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">Cancellation Return Policy</h1>
                                <ul class="breadcrumb-links">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Cancellation Return Policy</li>
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
                            
                                <p class="mb-30px" style="text-align: justify;">
                                    <?php echo $cancellation_return_policy; ?>
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
