<?php
include('include/header.php');
include('connection.php');
?>



	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-4 col-sm-12">
							<div class="title">
								<h4>Location</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item active" aria-current="page">Location</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-4 col-sm-12">
						     <?php
						            $select=mysqli_query($conn,"SELECT * FROM discount");
                                    $row = mysqli_fetch_assoc($select);
                                    $dis_old = $row['dis'];
                                    $id= $row['id'];
                              	$dis = $_REQUEST['dis'];
            					if (isset($_REQUEST['getit'])) 
            					{
                                    if (mysqli_num_rows($select) > 0) {
                                        $queryUpdate = mysqli_query($conn,"UPDATE discount SET dis = '$dis' WHERE id = '$id'");
                                    }else{
    								    $insert_sub = "INSERT INTO discount(dis) VALUES('$dis')";
    								    $run_sub = mysqli_query($conn,$insert_sub);
                                    }
            					}
            				
            					?>
						    <form method="post" action="">
    							<h4>Discount</h4>
                                <input type="text" name="dis" class="form-control" value="<?php if(isset($dis_old) && !empty($dis_old)){ echo $dis_old; } ?>">
                                <button type="submit" class="btn btn-primary" name="getit">Update</button>
							</form>
						</div>
							<div class="col-md-4 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="add_location.php" role="button" >
									Add New Location
								</a>							
							</div>
						</div>						
					</div>
				</div>
				

				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Location</h4>
					</div>

					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">No</th>
									<th>Area</th>
									<th>Pincode</th>
									<th>standard charge</th>
									<th>express charge</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$select = "SELECT * FROM location ORDER BY loc_id  DESC";
								$run = mysqli_query($conn,$select);
								$i=1;
								while ($data = mysqli_fetch_array($run)) 
								{
								?>
								<tr>
									<td class="table-plus"><?php echo $i; ?></td>
									<td><?php echo $data['area']; ?></td>
									<td><?php echo $data['pincode']; ?></td>
									<td><?php echo $data['standard_charge']; ?></td>
									<td><?php echo $data['express_charge']; ?></td>

									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="update_location.php?loc_id=<?php echo $data['loc_id']; ?>"><i class="dw dw-edit2"></i> Edit</a>
												<a class="dropdown-item" href="delete.php?loc_id=<?php echo $data['loc_id']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
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