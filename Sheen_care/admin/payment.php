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
								<h4>Payment</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item active" aria-current="page">Payment</li>
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
						<h4 class="text-blue h4">Payment</h4>
					</div>

					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">No</th>
									<th>Payment Status</th>
									<th>Date</th>
									<th>Order ID</th>
									<th>Amount</th>
									<th>Payment Mode</th>
									<th>Transaction ID</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$select = "SELECT * FROM payment JOIN order_master ON payment.order_id = order_master.order_id ORDER BY payment.payment_id  DESC";
								$run = mysqli_query($conn,$select);
								$i=1;
								while ($data = mysqli_fetch_array($run)) 
								{
								?>
								<tr>
									<td class="table-plus"><?php echo $i; ?></td>

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
									<td><?php echo $data['payment_date']; ?></td>
									<td><?php echo $data['uniq_order_id']; ?></td>
									<td><?php echo $data['total_amount']; ?></td>
									<td><?php echo $data['payment_mode']; ?></td>
									<td><?php echo $data['insta_tran_id']; ?></td>

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