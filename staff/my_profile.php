<?php

session_start();

if (isset($_SESSION["u"])) {

	$email = $_SESSION["u"]["email"];

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

		$s_details_rs = Database::search("SELECT * FROM `staff_details` WHERE `staff_email` = '" . $email . "' ");
		$s_details_data = $s_details_rs->fetch_assoc();
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

								$staff_img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $email . "'");
								$staff_img_num = $staff_img_rs->num_rows;

								if ($staff_img_num == 0) {
								?>
									<img src="../assets/images/no-image-available.jpg" alt="">
								<?php
								} else {
									$staff_img_data = $staff_img_rs->fetch_assoc();
								?>
									<img src="<?php echo $staff_img_data["path"]; ?>" alt="">
								<?php

								}

								?>
							</span>
							<span class="user-name"><?php echo $s_details_data["first_name"] . " " . $s_details_data["last_name"]; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="my_profile.php"><i class="dw dw-user1"></i> Profile</a>
							<a class="dropdown-item" href="#" onclick="usignout();"><i class="dw dw-logout"></i> sign Out</a>
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

					$staff_rs = Database::search("SELECT * FROM `staff` WHERE `email` = '" . $email . "' ");
					$staff_data = $staff_rs->fetch_assoc();

					?>

					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
							<div class="pd-20 card-box height-100-p">

								<!-- Profile Photo -->

								<div class="profile-photo">
									<?php

									$staff_img2_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $staff_data["email"] . "'");
									$staff_img2_num = $staff_img2_rs->num_rows;

									if ($staff_img2_num == 0) {
									?>
										<img src="../assets/images/no-image-available.jpg" id="viewStaffuImg2" class="avatar-photo" />
									<?php
									} else {
										$staff_img2_data = $staff_img2_rs->fetch_assoc();
									?>
										<img src="<?php echo $staff_img2_data["path"]; ?>" id="viewStaffuImg2" class="avatar-photo">
									<?php

									}

									?>
									<input type="file" class="d-none" id="staffuimg2" accept="image/*" />
									<label for="staffuimg2" class="edit-avatar" onclick="updateStaffImage2();"><i class="fa fa-pencil"></i></label>
								</div>

								<!-- Profile Photo End -->

								<h5 class="text-center h5 mb-0"><?php echo $s_details_data["first_name"] . " " . $s_details_data["last_name"]; ?></h5>

								<div class="d-flex justify-content-center align-items-center mb-10 star">
									<?php

									// Review and rating process

									$staff_review_rs = Database::search("SELECT * FROM review INNER JOIN uploaded_project ON review.uploaded_project_id = uploaded_project.id WHERE staff_email = '" . $email . "'");
									$staff_review_num = $staff_review_rs->num_rows;

									if ($staff_review_num == 0) {

									?>
										<i class="fa fa-star"></i>&nbsp;
										<i class="fa fa-star"></i>&nbsp;
										<i class="fa fa-star"></i>&nbsp;
										<i class="fa fa-star"></i>&nbsp;
										<i class="fa fa-star"></i>&nbsp;&nbsp;
										<span class="h7" style="font-weight: 600;">0</span>&nbsp;<span class="h7 text-black-50">(0 reviews)</span>
										<?php

									} else {

										$rate_count = 0;

										for ($rr = 0; $rr < $staff_review_num; $rr++) {

											$staff_review_data = $staff_review_rs->fetch_assoc();
											$rate_count = $rate_count + (int)$staff_review_data["rate"];
										}

										$totalRate = $staff_review_num * 5;

										$percentage = ($rate_count / $totalRate) * 100;

										if ($percentage > 80) {
											$starCount = 5;
										} else if ($percentage > 60) {
											$starCount = 4;
										} else if ($percentage > 40) {
											$starCount = 3;
										} else if ($percentage > 20) {
											$starCount = 2;
										} else if ($percentage > 0) {
											$starCount = 1;
										} else {
											$starCount = 0;
										}

										$totalStar = 5;
										$notselectCount = $totalStar - $starCount;

										for ($sc = 0; $sc < $starCount; $sc++) {
										?>
											<i class="fa fa-star active"></i>&nbsp;
										<?php
										}

										for ($dsc = 0; $dsc < $notselectCount; $dsc++) {
										?>
											<i class="fa fa-star"></i>&nbsp;
											<?php
										}
											?>&nbsp;
											<span class="h7" style="font-weight: 600;"><?php echo $starCount; ?>.0</span>&nbsp;<span class="h7 text-black-50">(<?php echo $staff_review_num; ?> reviews)</span>

										<?php

									}

										?>
								</div>

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
											<?php echo $s_details_data["mobile"]; ?>
										</li>
										<li>
											<span>Role:</span>
											<?php

											$staff_position_rs = Database::search("SELECT * FROM position WHERE id ='" . $staff_data["position_id"] . "' ");
											$staff_position_data = $staff_position_rs->fetch_assoc();

											echo $staff_position_data["position"];

											?>

										</li>
										<li>
											<span>Address:</span><?php echo $s_details_data["address_line1"] . ", " . $s_details_data["address_line2"]; ?>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- Contact Information Section End -->

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
														<label for="fname">First Name</label>
														<input name="firstname" id="fname" class="form-control form-control-lg" type="text" autocomplete="off" value="<?php echo $s_details_data["first_name"]; ?>" placeholder="Enter First Name" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="lname">Last Name</label>
														<input name="lastname" id="lname" class="form-control form-control-lg" type="text" autocomplete="off" value="<?php echo $s_details_data["last_name"]; ?>" placeholder="Enter Last Name" />
													</div>
												</div>
												<div class="weight-500 col-12">
													<div class="form-group">
														<label for="email">Email Address</label>
														<input name="email" id="email" class="form-control form-control-lg" disabled type="text" autocomplete="off" value="<?php echo $email; ?>" placeholder="Enter Email Address" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="pwd">Password :</label>
														<div class="input-group">
															<input type="password" id="pwd" class="form-control" autocomplete="off" placeholder="Enter Password" value="<?php echo $staff_data["password"]; ?>" placeholder="Enter Password" />
															<div class="input-group-prepend">
																<span class="input-group-text bg-primary" onclick="showPassword10();">
																	<i class="fa fa-eye-slash text-white" id="e10"></i>
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="mobile">Phone Number</label>
														<input name="phonenumber" id="mobile" class="form-control form-control-lg" type="text" autocomplete="off" value="<?php echo $s_details_data["mobile"]; ?>" placeholder="Enter Phone Number" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="dob">Date Of Birth</label>

														<?php

														$date = $s_details_data["birthday"];
														$formatted_date = date("d F Y", strtotime($date));

														?>

														<input name="dob" id="dob" class="form-control form-control-lg date-picker" type="text" autocomplete="off" value="<?php echo $formatted_date; ?>" placeholder="** ******* 2***" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="gender">Gender</label>
														<select name="gender" id="gender" class="custom-select form-control" autocomplete="off">
															<option value="0">Select Gender</option>
															<?php
															$gender_rs = Database::search("SELECT * FROM `gender`");
															$gender_num = $gender_rs->num_rows;

															for ($y = 0; $y < $gender_num; $y++) {

																$gender_data =  $gender_rs->fetch_assoc();
															?>

																<option value="<?php echo $gender_data["id"]; ?>" <?php if (!empty($staff_data["gender_id"])) {
																														if ($gender_data["id"] == $staff_data["gender_id"]) {
																													?>selected<?php
																															}
																														} ?>><?php echo $gender_data["gender"]; ?></option>

															<?php
															}
															?>
														</select>
													</div>
												</div>
												<div class="weight-500 col-12">
													<div class="form-group">
														<label for="line1">Address Line 1 :</label>
														<input name="address" id="line1" type="text" class="form-control" autocomplete="off" value="<?php echo $s_details_data["address_line1"]; ?>" placeholder="Enter Address" />
													</div>
												</div>
												<div class="weight-500 col-12">
													<div class="form-group">
														<label for="line2">Address Line 2 :</label>
														<input name="address" id="line2" type="text" class="form-control" autocomplete="off" value="<?php echo $s_details_data["address_line2"]; ?>" placeholder="Enter Address" />
													</div>
												</div>
												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="district">District :</label>
														<select name="district" id="district" class="custom-select form-control" autocomplete="off">
															<option value="0">Select District</option>
															<?php
															$district_rs = Database::search("SELECT * FROM `district`");
															$district_num = $district_rs->num_rows;

															for ($y = 0; $y < $district_num; $y++) {

																$district_data =  $district_rs->fetch_assoc();
															?>

																<option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($s_details_data["district_id"])) {
																														if ($district_data["id"] == $s_details_data["district_id"]) {
																													?>selected<?php
																															}
																														} ?>><?php echo $district_data["district"]; ?></option>

															<?php
															}
															?>
														</select>
													</div>
												</div>

												<div class="weight-500 col-md-6">
													<div class="form-group">
														<label for="position">Position :</label>
														<select name="position" id="position" class="custom-select form-control" autocomplete="off">
															<option value="0">Select Position</option>

															<?php
															$position_rs = Database::search("SELECT * FROM `position`");
															$position_num = $position_rs->num_rows;

															for ($y = 0; $y < $position_num; $y++) {

																$position_data =  $position_rs->fetch_assoc();
															?>

																<option value="<?php echo $position_data["id"]; ?>" <?php if (!empty($staff_data["position_id"])) {
																														if ($position_data["id"] == $staff_data["position_id"]) {
																													?>selected<?php
																															}
																														} ?>><?php echo $position_data["position"]; ?></option>

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
															<button class="btn btn-primary" onclick="updateStaff2();">Update</button>
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
	header("Location:../index.php");
}

?>