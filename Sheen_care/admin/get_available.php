<?php
    include('connection.php');
    $cname=$_POST["cname"];
    $mobile=$_POST["mobile"]; 
    // $from=$_POST["from"];
    // // $from = date("d-m-Y", strtotime($from));
    // $to=$_POST["to"];
    // // $to =date("d-m-Y", strtotime($tot));
    // echo "<script>alert(".$from.");</script>";
    ?>
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
        if(isset($mobile) && !empty($mobile)){
            $select_detail=mysqli_query($conn,"SELECT DISTINCT * FROM order_detail WHERE o_phone = '{$mobile}' ORDER BY order_id DESC");
        }else{
            $select_detail=mysqli_query($conn,"SELECT DISTINCT * FROM order_detail ORDER BY order_id DESC");
        }
        $j=1;
        while ($data3 = mysqli_fetch_array($select_detail)){
            $detailid = $data3['order_id'];

        if(isset($cname) && !empty($cname)){
            if(isset($from) && !empty($from)){
                $select ="SELECT DISTINCT * FROM invoice JOIN order_master ON invoice.order_id = order_master.order_id JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.order_id = '{$detailid}' AND order_master.customer_id = '{$cname}' AND order_date BETWEEN '{$from}' AND '{$to}' ORDER BY order_master.order_id DESC";
            }else{
                 $select ="SELECT DISTINCT * FROM invoice JOIN order_master ON invoice.order_id = order_master.order_id JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.order_id = '{$detailid}' AND order_master.customer_id = '{$cname}' ORDER BY order_master.order_id DESC";
            }

        }elseif(isset($from) && !empty($from)){
             $select ="SELECT DISTINCT * FROM invoice JOIN order_master ON invoice.order_id = order_master.order_id JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.order_id = '{$detailid}' AND  order_date BETWEEN '{$from}' AND '{$to}' ORDER BY order_master.order_id DESC";
        }

        // $select ="SELECT DISTINCT * FROM invoice JOIN order_master ON invoice.order_id = order_master.order_id JOIN payment ON order_master.order_id = payment.order_id WHERE order_master.order_id = '{$detailid}' ORDER BY order_master.order_id DESC";
        $run = mysqli_query($conn,$select);
        $i=1;
        while ($data = mysqli_fetch_array($run)) 
        {
        ?>
        <tr>
            <td><a class="dropdown-item" href="view_order.php?order_id=<?php echo $data['order_id']; ?>"><i class="dw dw-view"></i></a></td>
            <td style="color: red;"><?php echo $data['order_status']; ?></td>
            <td><?php echo $data['order_date']; ?></td>
            <td><?php echo $data['uniq_order_id']; ?></td>
            <td><?php echo $data3['o_first_name']." ".$data['o_last_name']; ?></td>
            <td><?php echo $data3['o_phone']; ?></td>
            <td><?php echo $data3['o_email']; ?></td>
            <td><?php echo $data3['o_address']; ?></td>
            <td><?php echo $data['payment_mode']; ?></td>
            <?php 

            $ckstatus = $data['payment_status']; 
            if ($ckstatus == 1) 
            {
            ?>
            <td style="color: green;">Success</td>
            <?php   
            }
            else
            {
            ?>
            <td style="color: red;">Pending</td>
            <?php   
            }
            ?>
            <td>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $order_id2=  $data['order_id'];
                        $select2 ="SELECT DISTINCT * FROM order_detail JOIN product ON product.pro_id = order_detail.pro_id  WHERE order_detail.order_id = '{$order_id2}'";
                            $run2 = mysqli_query($conn, $select2);
                            $j=1;
                            while ($data2 = mysqli_fetch_array($run2))
                            { ?> 
                        <tr>
                            <td><?=$j?></td>
                            <td><?=$data2['pro_name']?></td>
                            <td><?=$data2['quantity']?></td>
                            <td><?=$data2['offer_price']?></td>
                        </tr>
                        <?php 
                        $j++;
                        } ?>
                    </tbody>
                </table>
            </td>
            <td><?php echo $data['total_amount']; ?></td>
            <td><?php echo $data['total_quantity']; ?></td>
            

        </tr>

       <?php
        $i++;
        }
        $j++;
    }

?>
                            </tbody>
                        </table>
    