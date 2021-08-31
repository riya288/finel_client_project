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
								<h4>Header Text</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item active" aria-current="page">Header Text</li>
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
						<h4 class="text-blue h4">Header Text</h4>
					</div>

					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">No</th>
									<th>Header Text</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$select = "SELECT * FROM header_text";
								$run = mysqli_query($conn,$select);
								$i=1;
								while ($data = mysqli_fetch_array($run)) 
								{
								?>
								<tr>
									<td class="table-plus"><?php echo $i; ?></td>
									<td><?php echo $data['header_text']; ?></td>
								
									<td>
												<a class="dropdown-item" href="update_cus_header.php?header_text_id=<?php echo $data['header_text_id']; ?>"><i class="dw dw-edit2"></i> </a>
												
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