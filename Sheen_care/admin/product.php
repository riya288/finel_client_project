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
								<h4>Product</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item active" aria-current="page">Product</li>
								</ol>
							</nav>
						</div>
							<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="add_product.php" role="button" >
									Add New Product
								</a>							
							</div>
						</div>						
					</div>
				</div>
				

				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Product</h4>
					</div>

					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">No</th>
									<th>Image 1</th>
									<th>Image 2</th>
									<th>Category Name</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>offer price</th>
									<th>Offer Status</th>
									<th>Short Description</th>
									<th>Long Description</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$select = "SELECT * FROM product JOIN root_category ON product.root_category_id = root_category.root_category_id ORDER BY pro_id  DESC";
								$run = mysqli_query($conn,$select);
								$i=1;
								while ($data = mysqli_fetch_array($run)) 
								{ $offer_status = $data['offer_status'];
								?>
								<tr>
									<td class="table-plus"><?php echo $i; ?></td>
									<td><img src="upload/product/<?php echo $data['pro_image']; ?>" style="width: 50px; height: 50px;"></td>
									<td><img src="upload/product/<?php echo $data['pro_image2']; ?>" style="width: 50px; height: 50px;"></td>
									<td><?php echo $data['root_category']; ?></td>
									<td><?php echo $data['pro_name']; ?></td>
									
									<td><?php echo $data['price']; ?></td>
									<td><?php echo $data['offer_price']; ?></td>


									<?php 
										if ($offer_status == 1) 
										{
										?>
										<td style="color: green;">Active</td>
										<?php
										}
										else
										{
										?>
										<td style="color: red;">Deactive</td>
										<?php
										}

									?>

									<td><?php echo $data['pro_short_description']; ?></td>
									<td><textarea style="border:none; overflow-y: hidden; background-color: rgba(0,0,0,0);"><?php echo $data['pro_long_description']; ?></textarea></td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="update_product.php?pro_id=<?php echo $data['pro_id']; ?>"><i class="dw dw-edit2"></i> Edit</a>
												<a class="dropdown-item" href="delete.php?pro_id=<?php echo $data['pro_id']; ?>" onClick="return confirm('Are you sure you want to delete this record');"><i class="dw dw-delete-3"></i> Delete</a>
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