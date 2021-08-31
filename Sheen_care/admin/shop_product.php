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
								<h4>Product Of Shop By Consern</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item active" aria-current="page">Product Of Shop By Consern</li>
								</ol>
							</nav>
						</div>
							<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="add_shop_product.php" role="button" >
									Add New Product
								</a>							
							</div>
						</div>						
					</div>
				</div>
				

				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Product Of Shop By Consern</h4>
					</div>

					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">No</th>
									<th>Product Name</th>
									<th>Category</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$select = "SELECT * FROM shop_product JOIN category ON shop_product.category_id = category.category_id JOIN product ON shop_product.pro_id = product.pro_id ORDER BY shop_product.shop_product_id  DESC";
								$run = mysqli_query($conn,$select);
								$i=1;
								while ($data = mysqli_fetch_array($run)) 
								{
								?>
								<tr>
									<td class="table-plus"><?php echo $i; ?></td>
									<td><?php echo $data['pro_name']; ?></td>
									<td><?php echo $data['category']; ?></td>

									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="update_shop_product.php?shop_product_id=<?php echo $data['shop_product_id']; ?>"><i class="dw dw-edit2"></i> Edit</a>
												<a class="dropdown-item" href="delete.php?shop_product_id=<?php echo $data['shop_product_id']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
											</div>
										</div>
									</td>
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