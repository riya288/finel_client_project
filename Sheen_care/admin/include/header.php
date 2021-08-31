<?php
session_start();

if (isset($_SESSION['admin'])) 
{

}
else
{
	echo "<script> alert('Please login again.!'); window.location='index.php'; </script>";
}
?>



<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>SHEEN</title>
	


	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="src/images/sheen_logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="src/images/sheen_logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="src/images/sheen_logo.png">

	<!-- extra function for form and tables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
		
	
	<link href="editor.css" type="text/css" rel="stylesheet"/>
	
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$(document).ready( function () {
    $('#myTable').DataTable();
	});
	</script>


	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="../../assets/images/logo/fav.png" alt="">
						</span>
						<span class="user-name">Hello, Admin</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark ">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="src/images/sheen_logo.png" alt="" class="dark-logo" s>
				<img src="src/images/sheen_logo.png" alt="" class="light-logo" >
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">


					<li>
						<a href="dashboard.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
					</li>

				

					<li>
						<a href="root_category.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-list3"></span><span class="mtext">Category</span>
						</a>
					</li>

					<li>
						<a href="sub_category.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-list3"></span><span class="mtext">Sub Category</span>
						</a>
					</li>

					<li>
						<a href="child_category.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-list3"></span><span class="mtext">Child Category</span>
						</a>
					</li>
				

					<li>
						<a href="product.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-library"></span><span class="mtext">Product</span>
						</a>
					</li>

                    	<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">Shop By Concern</span>
						</a>
						<ul class="submenu">
							<li><a href="category.php">Category</a></li>
							<li><a href="shop_product.php">Products</a></li>
							
						</ul>
					</li>
					<li>
						<a href="stock.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Manage Stock</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">Order</span>
						</a>
						<ul class="submenu">
							<li><a href="pending_order.php">Pending Order</a></li>
							<li><a href="delivery_order.php">Delivery Order</a></li>
							<li><a href="view.php">View Order</a></li>
								<li><a href="all_order.php">All Order</a></li>
							
						</ul>
					</li>
					
					<li>
						<a href="payment.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-browser2"></span><span class="mtext">Payment</span>
						</a>
					</li>

					<li>
						<a href="location.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-apartment"></span><span class="mtext">Location</span>
						</a>
					</li>
					
					<li>
						<a href="inquiry.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat3"></span><span class="mtext">Inquiry</span>
						</a>
					</li>

					<li>
						<a href="customer.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user-3"></span><span class="mtext">Customer</span>
						</a>
					</li>

					<li>
						<a href="blog.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Blog</span>
						</a>
					</li>

					<li>
						<a href="promocode.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-shopping-bag"></span><span class="mtext">Promocode</span>
						</a>
					</li>
				
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Banner</span>
						</a>
						<ul class="submenu">
							<li><a href="cus_header.php">Header</a></li>
							<li><a href="slider.php">Slider Banner</a></li>
							<li><a href="mini_banner.php">Mini Banner</a></li>
							<li><a href="long_banner.php">Long Banner</a></li>
							
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">CMS Page</span>
						</a>
						<ul class="submenu">
							<li><a href="privacy_policy.php">Privacy policy</a></li>
							<li><a href="term_condition.php">Term & Condition</a></li>
							<li><a href="payment_policy.php">Payment Policy</a></li>
							<li><a href="shipping_policy.php">Shipping Policy</a></li>
							<li><a href="medical_disclalmer.php">Medical Disclalmer</a></li>
							<li><a href="cancellation_return_policy.php">Cancellation & Return Policy</a></li>
							
						</ul>
					</li>

					<li>
						<a href="store.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-library"></span><span class="mtext">Our Stores</span>
						</a>
					</li>

					<li>
						<a href="about.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user"></span><span class="mtext">about us</span>
						</a>
					</li>




							<li>
						<a href="logout.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-settings2"></span><span class="mtext">Logout</span>
						</a>
					</li>

			
					
	
				
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>
