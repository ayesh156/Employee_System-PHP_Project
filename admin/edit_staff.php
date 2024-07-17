<?php

session_start();

if (isset($_SESSION["a"])) {

	$aemail = $_SESSION["a"]["email"];

	include('includes/header.php');

	if (isset($_GET["email"]) && !empty($_GET["email"])) {

		$email = $_GET["email"];

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

			$a_details_rs = Database::search("SELECT * FROM `admin_details` WHERE `admin_email` = '" . $aemail . "' ");
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

									$admin_img_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $aemail . "'");
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
										<h4>Staff Profile</h4>
									</div>
									<nav aria-label="breadcrumb" role="navigation">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
											<li class="breadcrumb-item active" aria-current="page">Staff Profile</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>

						<!-- Breadcrumb Section End -->

						<div class="row pb-10">

							<?php

							$c_project_rs = Database::search("SELECT * FROM `project` WHERE `staff_email`='" . $email . "' AND `status_id` = '2'");
							$c_project_num = $c_project_rs->num_rows;

							?>

							<!-- Project Details Card Section -->

							<div class="col-md-4 mb-20">
								<div class="card-box height-100-p widget-style3">

									<div class="d-flex flex-wrap">
										<div class="widget-data">
											<div class="weight-700 font-24 text-dark"><?php echo $c_project_num; ?></div>
											<div class="font-14 text-secondary weight-500">Completed Projects</div>
										</div>
										<div class="widget-icon">
											<div class="icon" data-color="#09cc06"><span class="icon-copy fa fa-hourglass"></span></div>
										</div>
									</div>
								</div>
							</div>

							<?php

							$p_project_rs = Database::search("SELECT * FROM `project` WHERE `staff_email`='" . $email . "' AND `status_id` = '1' ");
							$p_project_num = $p_project_rs->num_rows;

							?>

							<div class="col-md-4 mb-20">
								<div class="card-box height-100-p widget-style3">

									<div class="d-flex flex-wrap">
										<div class="widget-data">
											<div class="weight-700 font-24 text-dark"><?php echo $p_project_num; ?></div>
											<div class="font-14 text-secondary weight-500">Pending Projects</div>
										</div>
										<div class="widget-icon">
											<div class="icon"><i class="icon-copy fa fa-hourglass-end" aria-hidden="true"></i></div>
										</div>
									</div>
								</div>
							</div>

							<?php

							$r_project_rs = Database::search("SELECT * FROM `project` WHERE `staff_email`='" . $email . "' AND `status_id` = '3' ");
							$r_project_num = $r_project_rs->num_rows;

							?>

							<div class="col-md-4 mb-20">
								<div class="card-box height-100-p widget-style3">

									<div class="d-flex flex-wrap">
										<div class="widget-data">
											<div class="weight-700 font-24 text-dark"><?php echo $r_project_num; ?></div>
											<div class="font-14 text-secondary weight-500">Rejected Projects</div>
										</div>
										<div class="widget-icon">
											<div class="icon" data-color="#ff5b5b"><i class="icon-copy fa fa-hourglass-o" aria-hidden="true"></i></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Project Details Card Section End -->

						</div>

						<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
								<div class="pd-20 card-box height-100-p">

								<!-- Profile Photo -->

									<div class="profile-photo">
										<?php

										$staff_img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $email . "'");
										$staff_img_num = $staff_img_rs->num_rows;

										if ($staff_img_num == 0) {
										?>
											<img src="../assets/images/no-image-available.jpg" id="viewStaffuImg" class="avatar-photo">
										<?php
										} else {
											$staff_img_data = $staff_img_rs->fetch_assoc();
										?>
											<img src="<?php echo $staff_img_data["path"]; ?>" id="viewStaffuImg" class="avatar-photo">
										<?php

										}

										?>

										<input type="file" class="d-none" id="staffuimg" accept="image/*" />
										<label for="staffuimg" class="edit-avatar" onclick="updateStaffImage()"><i class="fa fa-pencil"></i></label>

									</div>

									<!-- Profile Photo End -->

									<?php

									$staff_details_rs = Database::search("SELECT * FROM staff INNER JOIN staff_details ON staff.email = staff_details.staff_email WHERE email='" . $email . "' ");
									$staff_details_data = $staff_details_rs->fetch_assoc();

									?>

									<h5 class="text-center h5 mb-10"><?php echo $staff_details_data["first_name"] . " " . $staff_details_data["last_name"]; ?></h5>
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
												<span>Email Address:</span><?php echo $email; ?>
											</li>
											<li>
												<span>Phone Number:</span><?php echo $staff_details_data["mobile"]; ?>
											</li>
											<li>
												<span>Role:</span>
												<?php

												$staff_position_rs = Database::search("SELECT * FROM position WHERE id='" . $staff_details_data["position_id"] . "' ");
												$staff_position_data = $staff_position_rs->fetch_assoc();

												echo $staff_position_data["position"];

												?>

											</li>
											<li>
												<span>Address:</span><?php echo $staff_details_data["address_line1"] . ", " . $staff_details_data["address_line2"]; ?>
											</li>
										</ul>
									</div>

									<!-- Contact Information Section End -->

								</div>
							</div>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
								<div class="card-box height-100-p overflow-hidden">
									<div class="profile-tab height-100-p">
										<div class="tab height-100-p">

										<!-- Nav Tabs Section -->

											<ul class="nav nav-tabs customtab" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Project History</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
												</li>
											</ul>

											<!-- Nav Tabs Section End -->


											<div class="tab-content">
												<!-- Timeline Tab start -->
												<div class="tab-pane fade show active" id="timeline" role="tabpanel">
													<div class="pd-20">
														<div class="pb-20">
															<table class="data-table table stripe hover nowrap">
																<thead>
																	<tr>
																		<th class="table-plus">PROJECT NAME</th>
																		<th>PROJECT TYPE</th>
																		<th>STATUS</th>
																		<th class="datatable-nosort">ACTION</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$staff_project_rs = Database::search("SELECT project.id, project.name AS `name`, project_type.name AS `ptname`, status_id FROM project INNER JOIN project_type ON project.project_type_id = project_type.id WHERE staff_email ='" . $email . "' ");
																	$staff_project_num = $staff_project_rs->num_rows;

																	if ($staff_project_num == 0) {
																	?>
																		<tr>
																			<td colspan="4" class="text-center"><span class="h5">Project has not been given yet.</span></td>
																		</tr>
																		<?php
																	} else {

																		for ($p = 0; $p < $staff_project_num; $p++) {

																			$staff_project_data = $staff_project_rs->fetch_assoc();

																		?>
																			<tr>

																				<td><?php echo $staff_project_data["name"]; ?></td>
																				<td><?php echo $staff_project_data["ptname"]; ?></td>
																				<td>

																					<?php

																					if ($staff_project_data["status_id"] == 1) {
																						echo "Pending";
																					} else if ($staff_project_data["status_id"] == 2) {

																						echo "Done";
																					} else {
																						echo "Reject";
																					}
																					?>
																				</td>
																				<td>
																					<div class="dropdown">
																						<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
																							<i class="dw dw-more"></i>
																						</a>
																						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
																							<a class="dropdown-item" href="project_details.php?id=<?php echo $staff_project_data["id"]; ?>"><i class="dw dw-eye"></i> View</a>
																							<a class="dropdown-item" href="#" onclick="deleteProject('<?php echo $staff_project_data['id']; ?>');"><i class="dw dw-delete-3"></i> Delete</a>
																						</div>
																					</div>
																				</td>
																			</tr>
																	<?php
																		}
																	}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- Timeline Tab End -->

												<!-- Setting Tab start -->
												<div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
													<div class="profile-setting">
														<div class="profile-edit-list row">
															<div class="col-md-12">
																<h4 class="text-blue h5 mb-20">Edit Personal Setting</h4>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="sufname">First Name</label>
																	<input name="firstname" id="sufname" class="form-control form-control-lg" type="text" autocomplete="off" value="<?php echo $staff_details_data["first_name"]; ?>" placeholder="Enter First Name" />
																</div>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="sulname">Last Name</label>
																	<input name="lastname" id="sulname" class="form-control form-control-lg" type="text" autocomplete="off" value="<?php echo $staff_details_data["last_name"]; ?>" placeholder="Enter Last Name" />
																</div>
															</div>
															<div class="weight-500 col-12">
																<div class="form-group">
																	<label for="suemail">Email Address</label>
																	<input name="email" id="suemail" class="form-control form-control-lg" disabled type="text" autocomplete="off" value="<?php echo $email; ?>" placeholder="Enter Email Address" />
																</div>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="supi">Password :</label>
																	<div class="input-group">
																		<input type="password" id="supi" class="form-control" autocomplete="off" placeholder="Enter Password" value="<?php echo $staff_details_data["password"]; ?>" placeholder="Enter Password" />
																		<div class="input-group-prepend">
																			<span class="input-group-text bg-primary" onclick="showPassword2();">
																				<i class="fa fa-eye-slash text-white" id="e2"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="sumobile">Phone Number</label>
																	<input name="phonenumber" id="sumobile" class="form-control form-control-lg" type="text" autocomplete="off" value="<?php echo $staff_details_data["mobile"]; ?>" placeholder="Enter Phone Number" />
																</div>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="sudob">Date Of Birth</label>

																	<?php

																	$date = $staff_details_data["birthday"];
																	$formatted_date = date("d F Y", strtotime($date));

																	?>

																	<input name="dob" id="sudob" class="form-control form-control-lg date-picker" type="text" autocomplete="off" value="<?php echo $formatted_date; ?>" placeholder="** ******* 2***" />
																</div>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="sugender">Gender</label>
																	<select name="gender" id="sugender" class="custom-select form-control" autocomplete="off">
																		<option value="0">Select Gender</option>
																		<?php
																		$gender_rs = Database::search("SELECT * FROM `gender`");
																		$gender_num = $gender_rs->num_rows;

																		for ($y = 0; $y < $gender_num; $y++) {

																			$gender_data =  $gender_rs->fetch_assoc();
																		?>

																			<option value="<?php echo $gender_data["id"]; ?>" <?php if (!empty($staff_details_data["gender_id"])) {
																																	if ($gender_data["id"] == $staff_details_data["gender_id"]) {
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
																	<label for="sualine1">Address Line 1 :</label>
																	<input name="address" id="sualine1" type="text" class="form-control" autocomplete="off" value="<?php echo $staff_details_data["address_line1"]; ?>" placeholder="Enter Address" />
																</div>
															</div>
															<div class="weight-500 col-12">
																<div class="form-group">
																	<label for="sualine2">Address Line 2 :</label>
																	<input name="address" id="sualine2" type="text" class="form-control" autocomplete="off" value="<?php echo $staff_details_data["address_line2"]; ?>" placeholder="Enter Address" />
																</div>
															</div>
															<div class="weight-500 col-md-6">
																<div class="form-group">
																	<label for="sudistrict">District :</label>
																	<select name="district" id="sudistrict" class="custom-select form-control" autocomplete="off">
																		<option value="0">Select District</option>
																		<?php
																		$district_rs = Database::search("SELECT * FROM `district`");
																		$district_num = $district_rs->num_rows;

																		for ($y = 0; $y < $district_num; $y++) {

																			$district_data =  $district_rs->fetch_assoc();
																		?>

																			<option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($staff_details_data["district_id"])) {
																																	if ($district_data["id"] == $staff_details_data["district_id"]) {
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
																	<label for="suposition">Position :</label>
																	<select name="position" id="suposition" class="custom-select form-control" autocomplete="off">
																		<option value="0">Select Position</option>

																		<?php
																		$position_rs = Database::search("SELECT * FROM `position`");
																		$position_num = $position_rs->num_rows;

																		for ($y = 0; $y < $position_num; $y++) {

																			$position_data =  $position_rs->fetch_assoc();
																		?>

																			<option value="<?php echo $position_data["id"]; ?>" <?php if (!empty($staff_details_data["position_id"])) {
																																	if ($position_data["id"] == $staff_details_data["position_id"]) {
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
																		<button class="btn btn-primary" onclick="updateStaff();">Update</button>
																	</div>
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
							</div>
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

		<?php

	} else {

		?>

			<h3>Please select user first!</h3>

		<?php
	}

		?>

		</body>

		</html>

	<?php

} else {
	header("Location:index.php");
}

	?>