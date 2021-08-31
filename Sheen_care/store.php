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

                    <h1 class="breadcrumb-hrading">Our Store</h1>

                    <ul class="breadcrumb-links">

                        <li><a href="index.php">Home</a></li>

                        <li>Our Store</li>

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
            <?php
            $select = "SELECT * FROM store ORDER BY store_id  DESC";
            $run = mysqli_query($conn, $select);
            $i = 1;
            while ($data = mysqli_fetch_array($run)) {
                ?>
                <div class="col-md-6 col-sm-6">
                    <div class="serviceBox">

                        <h3 class="title"><?php echo $data['name']; ?></h3>
                        <p class="description">Address: <?php echo $data['address']; ?></p>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>

    </div>

</section>


<!-- About Area End -->


<?php include('includes/footer.php'); ?>



<?php include('includes/footerscript.php'); ?>

</body>


</html>

