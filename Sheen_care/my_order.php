<?php

include('header.php');

include('admin/connection.php');

session_start();

$customer_id = $_SESSION['cust_id'];







?>





            <!-- Breadcrumb Area start -->

            <section class="breadcrumb-area">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="breadcrumb-content">

                                <h1 class="breadcrumb-hrading">Order History</h1>

                                <ul class="breadcrumb-links">

                                    <li><a href="index.php">Home</a></li>

                                    <li>History</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Breadcrumb Area End -->

            <!-- cart area start -->

            <div class="cart-main-area mtb-60px">

                <div class="container">

                    <h3 class="cart-page-title"><a class="btn btn-success" style="color: white;" href="track_order.php"> Track Order </a> </h3>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                            <form action="#">

                                <div class="table-content table-responsive cart-table-content">

                                    <table>

                                        <thead>

                                            <tr>

                                                <th>Order ID</th>

                                                <th>Product Name</th>

                                                <th>Until Price</th>

                                                <th>Subtotal</th>

                                                <th>Invoice</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                          <?php
                        $select = "SELECT DISTINCT * FROM invoice RIGHT JOIN order_master ON invoice.order_id = order_master.order_id LEFT JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.customer_id = '$customer_id' AND order_master.order_status = 'Dispatch' ORDER BY order_master.order_id DESC";
                        $run = mysqli_query($conn, $select);
                        $i = 1;
                        while ($data = mysqli_fetch_array($run)) {
                            $order_id2 = $data['order_id'];
                            $select2 = "SELECT DISTINCT * FROM order_detail JOIN product ON product.pro_id = order_detail.pro_id  WHERE order_detail.order_id = '{$order_id2}'";
                            $run2 = mysqli_query($conn, $select2);
//                            $customer_data = mysqli_fetch_assoc($run2);
                            $product_details="";
                            $product_price=null;
                            $j = 1;
                            while ($data2 = mysqli_fetch_array($run2)) {
                                $customer_name = $data2['o_first_name'] . " " . $data2['o_last_name'];
                                $customer_phone = $data2['o_phone'];
                                $customer_email = $data2['o_email'];
                                $customer_add = $data2['o_address'];
                                $product_details .= $data2['pro_name']."<br>" ;
                                $product_price .= '₹ '.$data2['offer_price']."<br>" ;
                                $j++;
                            }

                            ?>
                                                 <tr>

                                                    <td class="product-name"><a href="#"><?php echo $data['uniq_order_id']; ?></a></td>

                                                 

                                                    <td class="product-name"><a href="#">
                                                         <?=$product_details ?>
                                                        </a></td>

                                                    <td class="product-price-cart"><span class="amount">
                                                    <?php echo $product_price;?> </span></td>

                                                   
                                                    <td class="product-subtotal">₹ <?php echo $data['total_amount']; ?></td>

                                                    <td class="product-remove">

                                                        <a href="invoice.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-danger" style="color: white; border-radius: 50%;">Print</a>

                                                     

                                                    </td>

                                                </tr>


 <?php
                            $i++;
                        }
                        ?>      

                                        </tbody>

                                    </table>

                                </div>

                            </form>

                                

                                

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- cart area end -->

              <?php include('includes/footer.php');?>       



 <?php include('includes/footerscript.php');?>      

    </body>



</html>

