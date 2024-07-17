<?php

session_start();

if (isset($_SESSION["a"])) {

	$email = $_SESSION["a"]["email"];

	include('includes/header.php');

?>

	<body>

		<!-- Page Loding Process -->

		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
				<div class='loader-progress' id="progress_div">
					<div class='bar' id='bar1'></div>
				</div>
				<div class='percent' id='percent1'>0%</div>
				<div class="loading-text">
					Loading...
				</div>
			</div>
		</div>

		<!-- Page Loding Process End -->

		<?php

		$a_details_rs = Database::search("SELECT * FROM `admin_details` WHERE `admin_email` = '" . $email . "' ");
		$a_details_data = $a_details_rs->fetch_assoc();
		?>

		<!-- Header Section -->

		<div class="header">
			<div class="header-left">
				<div class="menu-icon dw dw-menu"></div>
				<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>

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
								<?php

								$admin_img_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $email . "'");
								$admin_img_num = $admin_img_rs->num_rows;

								if ($admin_img_num == 0) {
								?>
									<img src="../assets/images/no-image-available.jpg" alt="">
								<?php
								} else {
									$admin_img_data = $admin_img_rs->fetch_assoc();
								?>
									<img src="<?php echo $admin_img_data["path"]; ?>" alt="">
								<?php

								}

								?>
							</span>
							<span class="user-name"><?php echo $a_details_data["first_name"] . " " . $a_details_data["last_name"]; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="my_profile.php"><i class="dw dw-user1"></i> Profile</a>
							<a class="dropdown-item" href="#" onclick="signout();"><i class="dw dw-logout"></i> sign Out</a>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- Header Section End -->

		<?php include('includes/right_sidebar.php') ?>

		<?php include('includes/left_sidebar.php') ?>

		<div class="mobile-menu-overlay"></div>

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">

				<div class="min-height-200px">

					<!-- Breadcrumb Section -->

					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Add Staff</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Add Staff</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<!-- Breadcrumb Section End -->

					<!-- Profile Photo -->

					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
								<div class="pd-20 card-box">
									<div class="profile-photo">
										<img src="../assets/images/no-image-available.jpg" id="viewStaffImg" class="avatar-photo">
										<input type="file" class="d-none" id="staffimg" accept="image/*" />
										<label for="staffimg" class="edit-avatar" onclick="addStaffImage()"><i class="fa fa-pencil"></i></label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Profile Photo End -->

					<!-- Project Details Section -->

					<div class="pd-20 card-box mb-30">
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Staff Form</h4>
								<p class="mb-20"></p>
							</div>
						</div>
						<div class="wizard-content">
							<section>
								<div class="row">
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="sfname">First Name :</label>
											<input name="firstname" id="sfname" type="text" class="form-control wizard-required" autocomplete="off" placeholder="Enter First Name" />
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="slname">Last Name :</label>
											<input name="lastname" id="slname" type="text" class="form-control" autocomplete="off" placeholder="Enter Last Name" />
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="smobile">Phone Number :</label>
											<input name="phonenumber" id="smobile" type="text" class="form-control" autocomplete="off" placeholder="Enter Phone Number" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 col-sm-12">
										<div class="form-group">
											<label for="semail">Email Address :</label>
											<input name="email" id="semail" type="email" class="form-control" autocomplete="off" placeholder="Enter Email Address" />
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="spi">Password :</label>
											<div class="input-group">
												<input type="password" id="spi" class="form-control" autocomplete="off" placeholder="Enter Password" />
												<div class="input-group-prepend">
													<span class="input-group-text bg-primary" onclick="showPassword1();">
														<i class="fa fa-eye-slash text-white" id="e1"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 col-sm-12">
										<div class="form-group">
											<label for="saline1">Address Line 1 :</label>
											<input name="address" id="saline1" type="text" class="form-control" autocomplete="off" placeholder="Enter Address" />
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="sdob">Date Of Birth :</label>
											<input name="dob" id="sdob" type="text" class="form-control date-picker" autocomplete="off" placeholder="** ******* 2***" />
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-8 col-sm-12">
										<div class="form-group">
											<label for="saline2">Address Line 2 :</label>
											<input name="address" id="saline2" type="text" class="form-control" autocomplete="off" placeholder="Enter Address" />
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="sgender">Gender :</label>
											<select name="gender" id="sgender" class="custom-select form-control" autocomplete="off">
												<option value="0">Select Gender</option>
												<?php

												$gender = Database::search("SELECT * FROM `gender`");
												$gen_num = $gender->num_rows;

												for ($y = 0; $y < $gen_num; $y++) {

													$gen_data =  $gender->fetch_assoc();
												?>

													<option value="<?php echo $gen_data["id"]; ?>"><?php echo $gen_data["gender"]; ?></option>

												<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="sdistrict">District :</label>
											<select name="district" class="custom-select form-control" autocomplete="off" id="sdistrict">
												<option value="0">Select District</option>
												<?php
												$district = Database::search("SELECT * FROM `district`");
												$dis_num = $district->num_rows;

												for ($x = 0; $x < $dis_num; $x++) {

													$dis_data =  $district->fetch_assoc();
												?>

													<option value="<?php echo $dis_data["id"]; ?>"><?php echo $dis_data["district"]; ?></option>

												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="sposition">Position :</label>
											<select name="position" id="sposition" class="custom-select form-control" autocomplete="off">
												<option value="0">Select Position</option>
												<?php
												$position = Database::search("SELECT * FROM `position`");
												$pos_num = $position->num_rows;

												for ($d = 0; $d < $pos_num; $d++) {

													$pos_data =  $position->fetch_assoc();
												?>

													<option value="<?php echo $pos_data["id"]; ?>"><?php echo $pos_data["position"]; ?></option>

												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" onclick="addStaff();">Add&nbsp;Staff</button>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>

					<!-- Project Details Section End -->

				</div>
				<?php include('includes/footer.php'); ?>
			</div>
		</div>

		<!-- Alert Modal -->
		<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="weight-500 col-md-12 pd-20">
						<div class="col-12 text-center">
							<h3 class="h3" id="alertMsg"></h3>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="alertBtn" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Alert Modal End -->

		<!-- js -->
		<?php include('includes/scripts.php') ?>

	</body>

	</html>

<?php

} else {
	header("Location:index.php");
}

?>