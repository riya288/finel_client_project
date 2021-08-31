<?php
include('include/header.php');
include('connection.php');
$order_id = $_REQUEST['order_id'];
?>



	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				
				

				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					
					<div class="pb-20">
						<table class="table">
							<thead>
							    <?php
							    $select_detail=mysqli_query($conn,"SELECT DISTINCT * FROM order_detail WHERE order_id  = '{$order_id}'");
							    $data3 = mysqli_fetch_array($select_detail);

								$select ="SELECT DISTINCT * FROM invoice JOIN order_master ON invoice.order_id = order_master.order_id JOIN payment ON order_master.order_id = payment.order_id  WHERE order_master.order_id = '{$order_id}' ";
								$run = mysqli_query($conn,$select);
								$i=1;
								while ($data = mysqli_fetch_array($run)) 
								{
								?>
								<tr>
									<th>Order Status</th>
									<td style="color: red;"><?php echo $data['order_status']; ?></td>
								</tr>
								<tr>
									<th>Order Date</th>
									<td><?php echo $data['order_date']; ?></td>
								</tr>
								<tr>
									<th>Order ID</th>
									<td><?php echo $data['uniq_order_id']; ?></td>
								</tr>

								<tr>
									<th>Customer Name</th>
									<td><?php echo $data3['o_first_name']." ".$data2['o_last_name']; ?></td>
								</tr>
								<tr>
									<th>Customer Phone</th>
									<td><?php echo $data3['o_phone']; ?></td>
								</tr>
								<tr>
									<th>Customer Email</th>
									<td><?php echo $data3['o_email']; ?></td>
								</tr>
								<tr>
									<th>Customer Address</th>
									 <td><?php echo $data3['o_address']; ?></td>
								</tr>
								<tr>
									<th>Payment Mode</th>
									<td><?php echo $data['payment_mode']; ?></td>
								</tr>
								<tr>
									<th>Payment Status</th>

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
								</tr>
								<tr>
									<th>Product Detail</th>
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
									            $allPro .= $data2['pro_name'].'(RS'.$data2['offer_price'].')'.'%0D%0A';

									            $j++;
									            }?>
									        </tbody>
									    </table>
									</td>
								</tr>
								<tr>
									<th>Total Amount</th>
									<td><?php echo $data['total_amount']; ?></td>
								</tr>
								<tr>
									<th>Total Quantity</th>
									<td><?php echo $data['total_quantity']; ?></td>
								</tr>
								<tr>
									<th>Send Inquiry On Watsapp</th>
									<td><div class="btn btn-success"><a href="https://api.whatsapp.com/send?phone=+91<?=$data3['o_phone']?>&text=Thank%20 You%20 For%20 Shopping%20 on %20SHEEN%20 CARE %0D%0A%0D%0A Your%20Order%20is%20 Confirm%20 by%20 SHEEN%20 CARE%0D%0AYour%20 Order%20 ID%20 is%20 :%20<?php echo $data['uniq_order_id']; ?>%0D%0ACustomer%20 Name %20:%20<?php echo $data3['o_first_name']." ".$data2['o_last_name']; ?>%0D%0AAddress%20 :%20<?php echo $data3['o_address']; ?>%0D%0AProduct :<?=str_replace("&","And",$allPro)?>%0D%0ATotal %20Quantity%20:%20<?php echo $data['total_quantity']; ?>%0D%0ATotal%20 Amount%20:%20<?php echo $data['total_amount']; ?> ">Send</a></div></td>
								</tr>
							</thead>
								<?php
								$i++;
								}
								?>

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