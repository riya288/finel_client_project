<?php
include('include/header.php');
include('connection.php');

?>
<?php

if (isset($_REQUEST['submit'])) {
    $category_id = $_REQUEST['category_id'];
    $sub_category_id = $_REQUEST['sub_category_id'];
    $child_category_id = $_REQUEST['child_category_id'];
    $hot_deal = $_REQUEST['hot_deal'];

    $pro_name = $_REQUEST['pro_name'];
    $price = $_REQUEST['price'];
    // $weight = $_REQUEST['weight'];
    $attribute = $_REQUEST['attribute'];

    $offer_price = $_REQUEST['offer_price'];
    $stock = $_REQUEST['stock'];

    $offer_status = $_REQUEST['offer_status'];

    $pro_short_description = $_REQUEST['pro_short_description'];
    $pro_long_description = $_REQUEST['pro_long_description'];
    $product_rating = $_REQUEST['review_rating'];
    $total_rating = $_REQUEST['total_rating'];
    $ingredients = $_REQUEST['ingredients'];
    $key_benefits = $_REQUEST['key_benefits'];

    $product_profile = $_REQUEST['product_profile'];
    $iconimage = $_REQUEST['iconimage'];
    $directions_to_use = $_REQUEST['directions_to_use'];
    $certifications = $_REQUEST['certifications'];
    $general_info = $_REQUEST['general_info'];

// for image upload

    $image_name1 = basename($_FILES['pro_image1']['name']);
    $tmp_name = $_FILES['pro_image1']['tmp_name'];
    if (isset($image_name1)) {
        $location = 'upload/product/';
        $move = move_uploaded_file($tmp_name, $location . $image_name1);
    }

// for image upload

    $image_name2 = basename($_FILES['pro_image2']['name']);
    $tmp_name = $_FILES['pro_image2']['tmp_name'];
    if (isset($image_name2)) {
        $location = 'upload/product/';
        $move = move_uploaded_file($tmp_name, $location . $image_name2);
    }

// for image upload

    $single_image1 = basename($_FILES['single_image1']['name']);
    $tmp_name = $_FILES['single_image1']['tmp_name'];
    if (isset($single_image1)) {
        $location = 'upload/product/';
        $move = move_uploaded_file($tmp_name, $location . $single_image1);
    }

// for image upload

    $single_image2 = basename($_FILES['single_image2']['name']);
    $tmp_name = $_FILES['single_image2']['tmp_name'];
    if (isset($single_image2)) {
        $location = 'upload/product/';
        $move = move_uploaded_file($tmp_name, $location . $single_image2);
    }

// for image upload

    $single_image3 = basename($_FILES['single_image3']['name']);
    $tmp_name = $_FILES['single_image3']['tmp_name'];
    if (isset($single_image3)) {
        $location = 'upload/product/';
        $move = move_uploaded_file($tmp_name, $location . $single_image3);
    }

// for image upload

    $single_image4 = basename($_FILES['single_image4']['name']);
    $tmp_name = $_FILES['single_image4']['tmp_name'];
    if (isset($single_image4)) {
        $location = 'upload/product/';
        $move = move_uploaded_file($tmp_name, $location . $single_image4);
    }
    $insert = "INSERT INTO product(root_category_id, sub_category_id, child_category_id, pro_name, pro_short_description, pro_long_description, ingredients, key_benefits, product_profile, directions_to_use, certifications, general_info,
price, offer_price,weight,attribute, offer_status, pro_image, pro_image2, product_rating, total_rating, single_image1, single_image2, single_image3, single_image4, hot_deal, iconimage) VALUES
  ('{$category_id}','{$sub_category_id}','{$child_category_id}','{$pro_name}','{$pro_short_description}','{$pro_long_description}','{$ingredients}','{$key_benefits}',
  '{$product_profile}','{$directions_to_use}','{$certifications}','{$general_info}','{$price}','{$offer_price}','','{$attribute}','{$offer_status}','{$image_name1}','{$image_name2}',
  '{$product_rating}','{$total_rating}','{$single_image1}','{$single_image2}','{$single_image3}','{$single_image4}','{$hot_deal}','{$iconimage}')";
    $run = mysqli_query($conn, $insert);

    if ($run) {
        $select3 = "SELECT MAX(pro_id) FROM product";
        $run3 = mysqli_query($conn, $select3);
        while ($data3 = mysqli_fetch_array($run3)) {
            $max_pro_id = $data3['MAX(pro_id)'];
        }

        if ($run3) {

            $insert1 = "INSERT INTO stock(pro_id,stock) VALUES ('{$max_pro_id}','{$stock}')";
            $run1 = mysqli_query($conn, $insert1);

            if ($run1) {

                echo "<script> alert('Product Added..!!'); 
				      window.location='product.php';
				      </script>";
            } else {
                echo "<script> alert('Something went wrong..!!'); 
				      window.location='product.php';
				      </script>";
            }

        }

    }

// }

}
?>

<style type="text/css">
    @import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .ta-editor {
        min-height: 300px;
        height: auto;
        overflow: auto;
        font-family: inherit;
        font-size: 100%;
    }

</style>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Add Product</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Category</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="form-control" name="category_id" id="category">
                                <option hidden="">--Select Category --</option>
                                <?php
                                $select1 = "SELECT * FROM root_category";
                                $run1 = mysqli_query($conn, $select1);
                                while ($data1 = mysqli_fetch_array($run1)) {
                                    ?>
                                    <option value="<?php echo $data1['root_category_id']; ?>"><?php echo $data1['root_category']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <!-- <input class="form-control" name="category_name" type="text" placeholder="Enter Category Name"> -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Sub Category</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="form-control" name="sub_category_id" id="sub_category">

                                <option hidden="">--Select SubCategory --</option>

                            </select>
                            <!-- <input class="form-control" name="category_name" type="text" placeholder="Enter Category Name"> -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Child Category</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="form-control" name="child_category_id" id="child_category">

                                <option hidden="" value="">--Select Child Category --</option>
                                <option value="">None</option>

                            </select>
                            <!-- <input class="form-control" name="category_name" type="text" placeholder="Enter Category Name"> -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Product Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="pro_name" type="text" placeholder="Enter Product Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">MRP Price</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="price" type="text" placeholder="Enter Price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">offer Price</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="offer_price" type="text" placeholder="Enter Offer Price">
                        </div>
                    </div>
                    <!--	<div class="form-group row">-->
                    <!--	<label class="col-sm-12 col-md-2 col-form-label">Weight</label>-->
                    <!--	<div class="col-sm-12 col-md-10">-->
                    <!--		<input class="form-control" name="weight" type="text" placeholder="Enter Weight">-->
                    <!--	</div>-->
                    <!--</div>-->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Weight</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="attribute" type="text" placeholder="Enter Weight">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Offer ON / OFF</label>
                        <div class="col-sm-12 col-md-10">

                            <label class="switch">
                                <input type="checkbox" name="ck_status" id="ck_status">

                                <span class="slider"></span>
                        </div>
                    </div>
                    <input type="text" name="offer_status" id="offer_status" value="0" hidden="">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Short Description</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="textarea_editor1 form-control" name="pro_short_description"
                                      placeholder="Short Description.."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Long Description</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor2 form-control border-radius-0" name="pro_long_description"
                                      placeholder="Long Description ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Key Benefits</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor3 form-control border-radius-0" name="key_benefits"
                                      placeholder="key benefits ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Product Profile</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor4 form-control border-radius-0" name="product_profile"
                                      placeholder="Product Profile ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Directions to Use</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor5 form-control border-radius-0" name="directions_to_use"
                                      placeholder="Directions to Use ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Certifications</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor6 form-control border-radius-0" name="certifications"
                                      placeholder="Certifications ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">General Info</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor7 form-control border-radius-0" name="general_info"
                                      placeholder="General Info ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ingredients</label>
                        <div class="col-sm-12 col-md-10">

                            <textarea class="textarea_editor8 form-control border-radius-0" name="ingredients"
                                      placeholder="Ingredients ..."></textarea>

                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-12 col-md-2 col-form-label">Upload Image 1</label>
                        <div class="col-sm-12 col-md-10">
                            <span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
                            <input class="form-control" name="pro_image1" type="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Upload Image 2</label>
                        <div class="col-sm-12 col-md-10">
                            <span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
                            <input class="form-control" name="pro_image2" type="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Upload Single Product 1</label>
                        <div class="col-sm-12 col-md-10">
                            <span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
                            <input class="form-control" name="single_image1" type="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Upload Single Product 2</label>
                        <div class="col-sm-12 col-md-10">
                            <span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
                            <input class="form-control" name="single_image2" type="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Upload Single Product 3</label>
                        <div class="col-sm-12 col-md-10">
                            <span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
                            <input class="form-control" name="single_image3" type="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Upload Single Product 4</label>
                        <div class="col-sm-12 col-md-10">
                            <span style="color:red;font-size:12px">Enter 800*800 uplod image png/jpg/jpeg file</span>
                            <input class="form-control" name="single_image4" type="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Stock</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="stock" type="text" placeholder="Enter Total Quantity">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Total Rating</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="total_rating" type="text" placeholder="4 / 5 Like that..">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Product Rating</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="review_rating" type="text" placeholder="Show Total star ">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Hot Deal</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="form-control" name="hot_deal">

                                <option value="0">No</option>
                                <option value="1">Yes</option>

                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Show icon</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="form-control" name="iconimage">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-success" type="submit" name="submit" value="Add New Product"
                               style="background-color: green;">
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

    <script>

        $(document).ready(function () {

            $('#ck_status').on("change", function () {
                var x = $('#offer_status').val();

                if (x > 0) {
                    $('#offer_status').val('0');
                } else {
                    $('#offer_status').val('1');
                }

            });

            $('#category').on("change", function () {

                var root_category_id = $(this).val();

                $.ajax({

                    url: "ajax.php",
                    type: "POST",
                    data: {root_category_id: root_category_id},
                    success: function (data) {
                        if (data == "Not available") {
                            $("#sub_category").html(data);
                        } else {
                            $("#sub_category").html(data);
                        }

                    }
                });

            });

            $('#sub_category').on("change", function () {

                var sub_category_id = $(this).val();

                $.ajax({

                    url: "ajax.php",
                    type: "POST",
                    data: {sub_category_id: sub_category_id},
                    success: function (data) {
                        if (data == "Not available") {

                        } else {
                            $("#child_category").html(data);
                        }

                    }
                });

            });

        });

        jQuery(window).on("load", function () {
            "use strict";
            // bootstrap wysihtml5
            $('.textarea_editor1').wysihtml5({
                html: true
            });

            $('.textarea_editor2').wysihtml5({
                html: true
            });

            $('.textarea_editor3').wysihtml5({
                html: true
            });

            $('.textarea_editor4').wysihtml5({
                html: true
            });

            $('.textarea_editor5').wysihtml5({
                html: true
            });

            $('.textarea_editor6').wysihtml5({
                html: true
            });

            $('.textarea_editor7').wysihtml5({
                html: true
            });

            $('.textarea_editor8').wysihtml5({
                html: true
            });

            $('.textarea_editor9').wysihtml5({
                html: true
            });
        });

    </script>

    </body>
    </html>
</div>