<?php
include('include/header.php');
include('connection.php');
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


            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                        <h4 class="text-blue h4">All Order</h4>
                    </div>

                <div class="pb-20">
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
                        $select = "SELECT DISTINCT * FROM invoice RIGHT JOIN order_master ON invoice.order_id = order_master.order_id LEFT JOIN payment ON order_master.order_id = payment.order_id ORDER BY order_master.order_id DESC";
                        $run = mysqli_query($conn, $select);
                        $i = 1;
                        while ($data = mysqli_fetch_array($run)) {
                            $order_id2 = $data['order_id'];
                            $select2 = "SELECT DISTINCT * FROM order_detail JOIN product ON product.pro_id = order_detail.pro_id  WHERE order_detail.order_id = '{$order_id2}'";
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
                                 <td><a class="dropdown-item" href="view_order.php?order_id=<?php echo $data['order_id']; ?>"><i class="dw dw-view"></i></a></td>
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
<script src="vendors/scripts/datatable-setting.js"></script></body>
</html>