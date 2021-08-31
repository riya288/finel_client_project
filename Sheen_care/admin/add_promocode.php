<?php
include('include/header.php');
include('connection.php');

if (isset($_REQUEST['submit'])) {

    $promocode = $_REQUEST['promocode'];
    $discount = $_REQUEST['discount'];


    $insert = "INSERT INTO promocode(promocode,discount) VALUES ('{$promocode}','{$discount}')";
    $run = mysqli_query($conn, $insert);

    if ($run) {
        echo "<script> alert('New Promocode Added..!!'); 
      window.location='promocode.php';
      </script>";
    } else {
        echo "<script> alert('Something went wrong..!!'); 
      window.location='promocode.php';
      </script>";
    }


}
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Add Promocode</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">Add Promocode</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">

                <form action="" method="POST">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Promocode</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="promocode" type="text" placeholder="Enter Promocode">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Discount Price</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="discount" type="text" placeholder="Enter Blog Title">
                        </div>
                    </div>

                    <div class="text-center">
                        <input class="btn btn-success" type="submit" name="submit" value="Add New Promocede">
                    </div>


                </form>


            </div>


        </div>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="editor-ckeditor.min.js" type="text/javascript"></script>

    </body>
    </html></div>