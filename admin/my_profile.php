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
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Profile</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Profile</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<!-- Breadcrumb Section End -->

					<?php
					$admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' ");
					$admin_data = $admin_rs->fetch_assoc();

					?>

					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
							<div class="pd-20 card-box height-100-p">

							<!-- Profile Photo -->

								<div class="profile-photo">
									<?php

									$admin_img2_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $admin_data["email"] . "'");
									$admin_img2_num = $admin_img2_rs->num_rows;

									if ($admin_img2_num == 0) {
									?>
										<img src="../assets/images/no-image-available.jpg" id="viewAdminImg" class="avatar-photo" />
									<?php
									} else {
										$admin_img2_data = $admin_img2_rs->fetch_assoc();
									?>
										<img src="<?php echo $admin_img2_data["path"]; ?>" id="viewAdminImg" class="avatar-photo">
									<?php

									}

									?>
									<input type="file" class="d-none" id="adminimg" accept="image/*" />
									<label for="adminimg" class="edit-avatar" onclick="updateAdminImage();"><i class="fa fa-pencil"></i></label>
								</div>

								<!-- Profile Photo End -->

								<h5 class="text-center h5 mb-0"><?php echo $a_details_data["first_name"] . " " . $a_details_data["last_name"]; ?></h5>
								<p class="text-center text-muted font-14">Admin</p>

								<!-- Contact Information Section -->

								<div class="profile-info">
									<h5 class="mb-20 h5 text-blue">Contact Information</h5>
									<ul>
										<li>
											<span>Email Address:</span>
											<?php echo $email; ?>
										</li>
										<li>
											<span>Phone Number:</span>
											<?php echo $a_details_data["mobile"]; ?>
										</li>
									</ul>
								</div>

								<!-- Contact Information Section End -->

							</div>
						</div>

						<!-- Profile Setting Section -->

						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
							<div class="card-box height-100-p overflow-hidden">
								<div class="profile-tab height-100-p">
									<div class="tab height-100-p">
										<div class="profile-setting">
											<div class="profile-edit-list row">
												<div class="col-md-12">
													<h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="afname">First Name</label>
														<input name="firstname" id="afname" class="form-control form-control-lg" type="text" autocomplete="off" placeholder="Enter First Name" value="<?php echo $a_details_data["first_name"] ?>" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="alname">Last Name</label>
														<input name="lastname" id="alname" class="form-control form-control-lg" type="text" autocomplete="off" placeholder="Enter Last Name" value="<?php echo $a_details_data["last_name"] ?>" />
													</div>
												</div>
												<div class="weight-500 col-12">
													<div class="form-group">
														<label for="aemail2">Email Address</label>
														<input name="email" id="aemail2" class="form-control form-control-lg" disabled type="text" autocomplete="off" placeholder="Enter Email Address" value="<?php echo $admin_data["email"] ?>" />
													</div>
												</div>
												<div class="col-md-4 col-md-6">
													<div class="form-group">
														<label for="apassword2">Password :</label>
														<div class="input-group">
															<input type="password" id="apassword2" class="form-control" autocomplete="off" placeholder="Enter Password" value="<?php echo $admin_data["password"] ?>" />
															<div class="input-group-prepend">
																<span class="input-group-text bg-primary" onclick="showPassword6();">
																	<i class="fa fa-eye-slash text-white" id="e6"></i>
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="amobile">Phone Number</label>
														<input name="phonenumber" id="amobile" class="form-control form-control-lg" type="text" autocomplete="off" placeholder="Enter Phone Number" value="<?php echo $a_details_data["mobile"] ?>" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="adob">Date Of Birth</label>
														<?php

														$date = $a_details_data["birthday"];
														$formatted_date = date("d F Y", strtotime($date));

														?>
														<input name="dob" id="adob" class="form-control form-control-lg date-picker" type="text" autocomplete="off" placeholder="** ******* 2***" value="<?php echo $formatted_date ?>" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="agender">Gender</label>
														<select name="gender" id="agender" class="custom-select form-control" autocomplete="off">
															<option value="0">Select Gender</option>
															<?php
															$gender_rs = Database::search("SELECT * FROM `gender`");
															$gender_num = $gender_rs->num_rows;

															for ($y = 0; $y < $gender_num; $y++) {

																$gender_data =  $gender_rs->fetch_assoc();
															?>

																<option value="<?php echo $gender_data["id"]; ?>" <?php if (!empty($admin_data["gender_id"])) {
																														if ($gender_data["id"] == $admin_data["gender_id"]) {
																													?>selected<?php
																																}
																															} ?>><?php echo $gender_data["gender"]; ?></option>

															<?php
															}
															?>
														</select>
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label></label>
														<div class="modal-footer justify-content-center">
															<button class="btn btn-primary" onclick="updateAProfile();">Update</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>

						<!-- Profile Setting Section End -->

					</div>
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