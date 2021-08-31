<?php
include('include/header.php');
include('connection.php');
?>
<?php

if (isset($_REQUEST['submit'])) {
    $sub_category_id = $_REQUEST['sub_category_id'];
    $child_category = $_REQUEST['child_category'];

    $insert = "INSERT INTO child_category(child_category,sub_category_id) VALUES ('{$child_category}','{$sub_category_id}')";
    $run = mysqli_query($conn, $insert);

    if ($run) {
        echo "<script> alert('child category Added..!!'); 
      window.location='child_category.php';
      </script>";
    } else {
        echo "<script> alert('Something went wrong..!!'); 
      window.location='add_child_category.php';
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
                            <h4>Add Child Category</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">Add Child Category</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Sub Category</label>
                        <div class="col-sm-12 col-md-10">

                            <select name="sub_category_id" class="form-control">
                                <option hidden="">------- Sub Category -------</option>

                                <?php
                                $select_root_category = "SELECT * FROM sub_category";
                                $run_root_category = mysqli_query($conn, $select_root_category);
                                while ($root_category_data = mysqli_fetch_array($run_root_category)) {
                                    ?>
                                    <option value="<?php echo $root_category_data['sub_category_id']; ?>"><?php echo $root_category_data['sub_category']; ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Child Category</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="child_category" type="text"
                                   placeholder="Enter Child Category Name">
                        </div>
                    </div>

                    <div class="text-center">
                        <input class="btn btn-success" type="submit" name="submit" value="Add New Child Category">
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
<!-- js -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>