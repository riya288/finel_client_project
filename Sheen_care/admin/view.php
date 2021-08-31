<?php
include('include/header.php');
include('connection.php');
$cname = 0;
$mobile = '';
$from = '';
$to = '';
if (isset($_POST['submit'])) {
    $cname = $_POST['cname'];
    $mobile = $_POST['mobile'];
    $from = $_POST['from'];
    $to = $_POST['to'];
}
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>All Order</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">All Order</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                    </div>
                </div>
            </div>
            <div class="pd-20 card-box mb-30">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Customer Name</label>
                        <div class="col-sm-12 col-md-10">

                            <select name="cname" id="cname" class="form-control">
                                <option value="0">------- Select Customer Name-------</option>
                                <?php
                                $select_root_category = "SELECT * FROM customer";
                                $run_root_category = mysqli_query($conn, $select_root_category);
                                while ($root_category_data = mysqli_fetch_array($run_root_category)) {
                                    ?>
                                    <option value="<?php echo $root_category_data['customer_id']; ?>" <?php if ($root_category_data['customer_id'] == $cname) { ?> selected <?php } ?>><?php echo $root_category_data['first_name'] . ' ' . $root_category_data['last_name']; ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Customer Mobile Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="mobile" id="mobile" type="text"
                                   placeholder="Enter  Customer Mobile Number" value="<?= $mobile ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">From</label>
                        <div class="col-sm-6 col-md-4">
                            <input class="form-control" name="from" id="from" type="date" value="<?= $from ?>">
                        </div>
                        <label class="col-sm-12 col-md-2 col-form-label" align="center">To</label>
                        <div class="col-sm-6 col-md-4">
                            <input class="form-control" name="to" id="to" type="date" value="<?= $to ?>">
                        </div>
                    </div>

                    <div class="text-center">
                        <input class="btn btn-success" type="submit" name="submit" value="Search Record">
                    </div>

                </form>

            </div>
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">All Order</h4>
                </div>
                <div class="pb-20" id="addhere">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Order Status</th>
                            <th>Order Date</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Customer Email</th>
                            <th>Customer Address</th>
                            <th>Payment Mode</th>
                            <th>Payment Status</th>
                            <th>Product Detail</th>
                            <th>Total Amount</th>
                            <th>Total Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($from) && !empty($from)) {
                            if (isset($cname) && !empty($cname) && intval($cname) > 0) {
                                $select = "SELECT DISTINCT * FROM invoice RIGHT JOIN order_master ON invoice.order_id = order_master.order_id LEFT JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.customer_id = '{$cname}' AND STR_TO_DATE(order_master.order_date,'%d-%m-%Y') BETWEEN '{$from}' AND '{$to}' ORDER BY order_master.order_id DESC";
                            } else {
                                $select = "SELECT DISTINCT * FROM invoice RIGHT JOIN order_master ON invoice.order_id = order_master.order_id LEFT JOIN payment ON order_master.order_id = payment.order_id WHERE STR_TO_DATE(order_master.order_date,'%d-%m-%Y')  BETWEEN '{$from}' AND '{$to}' ORDER BY order_master.order_id DESC";
                            }
                        } elseif (isset($cname) && !empty($cname) && intval($cname) > 0) {
                            $select = "SELECT DISTINCT * FROM invoice RIGHT JOIN order_master ON invoice.order_id = order_master.order_id LEFT JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.customer_id = '{$cname}' ORDER BY order_master.order_id DESC";
                        } else {
                            $select = "SELECT DISTINCT * FROM invoice RIGHT JOIN order_master ON invoice.order_id = order_master.order_id LEFT JOIN payment ON order_master.order_id = payment.order_id ORDER BY order_master.order_id DESC";
                        }
                        $run = mysqli_query($conn, $select);
                        $i = 1;
                        while ($data = mysqli_fetch_array($run)) {
                            $order_id2 = $data['order_id'];
                            if (isset($mobile) && !empty($mobile)) {
                                $select2 = "SELECT DISTINCT * FROM order_detail JOIN product ON product.pro_id = order_detail.pro_id  WHERE order_detail.order_id = '{$order_id2}' AND order_detail.o_phone = '{$mobile}'";
                            } else {
                                $select2 = "SELECT DISTINCT * FROM order_detail JOIN product ON product.pro_id = order_detail.pro_id  WHERE order_detail.order_id = '{$order_id2}'";
                            }
                            $run2 = mysqli_query($conn, $select2);
//                            $customer_data = mysqli_fetch_assoc($run2);
                            $product_details = "<table>
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>";
                            $j = 1;
                            while ($data2 = mysqli_fetch_array($run2)) {
                                $customer_name = $data2['o_first_name'] . " " . $data2['o_last_name'];
                                $customer_phone = $data2['o_phone'];
                                $customer_email = $data2['o_email'];
                                $customer_add = $data2['o_address'];
                                $product_details .= "<tr>
                                                        <td>" . $j . "</td>
                                                        <td>" . $data2['pro_name'] . "</td>
                                                        <td>" . $data2['quantity'] . "</td>
                                                        <td>" . $data2['offer_price'] . "</td>
                                                     </tr>";
                                $j++;
                            }
                            $product_details .= "</tbody>
                                    </table>";
                            ?>
                            <tr>
                                <td><a class="dropdown-item"
                                       href="view_order.php?order_id=<?php echo $data['order_id']; ?>"><i
                                                class="dw dw-view"></i></a></td>
                                <td style="color: red;"><?php echo $data['order_status']; ?></td>
                                <td><?php echo $data['order_date']; ?></td>
                                <td><?php echo $data['uniq_order_id']; ?></td>
                                <td><?php echo $customer_name ?></td>
                                <td><?php echo $customer_phone ?></td>
                                <td><?php echo $customer_email ?></td>
                                <td><?php echo $customer_add ?></td>
                                <td><?php echo $data['payment_mode']; ?></td>
                                <?php
                                $ckstatus = $data['payment_status'];
                                if ($ckstatus == 1) {
                                    ?>
                                    <td style="color: green;">Success</td>
                                    <?php
                                } else {
                                    ?>
                                    <td style="color: red;">Pending</td>
                                    <?php
                                }
                                ?>
                                <td><?php echo $product_details ?></td>
                                <td><?php echo $data['total_amount']; ?></td>
                                <td><?php echo $data['total_quantity']; ?></td>

                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Export Datatable End -->
        </div>
    </div>
</div>
<!-- js -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- buttons for Export datatable -->
<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<script src="vendors/scripts/datatable-setting.js"></script>
<script>
    // $('#submit').click(function(e) {
    //       e.preventDefault();
    //       var cname = $('#cname').val();
    //      //alert(emp_name);
    //      var mobile= $('#mobile').val();
    //      var from = $('#from').text();
    //      var to = $('#to').text();
    //      // alert(from);
    //      // alert(to);
    //      $.ajax({
    //        url: "get_available.php",
    //        type: "POST",
    //        data: {
    //           cname:cname,
    //          mobile:mobile,
    //          from:from,
    //          to:to
    //        },
    //        cache: false,
    //        success: function(dataResult){
    //          $("#addhere").html(dataResult);
    //        }
    //      });
    //  });
</script></body>
</html>