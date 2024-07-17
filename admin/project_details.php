<?php

session_start();

if (isset($_SESSION["a"])) {

	$email = $_SESSION["a"]["email"];

	include('includes/header.php');

	if (isset($_GET["id"]) && !empty($_GET["id"])) {

		$id = $_GET["id"];

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
				<div class="pb-20">
					<div class="min-height-200px">

					<!-- Breadcrumb Section -->

						<div class="page-header">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="title">
										<h4>Project Details</h4>
									</div>
									<nav aria-label="breadcrumb" role="navigation">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
											<li class="breadcrumb-item active" aria-current="page">Project Details</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>

						<!-- Breadcrumb Section End -->

						<!-- Update Project Details Section -->

						<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
							<div class="clearfix">
								<div class="pull-left">
									<h4 class="text-blue h4">Project Form</h4>
									<p class="mb-20"></p>
								</div>
							</div>

							<?php

							$project_details_rs = Database::search("SELECT * FROM project WHERE id ='" . $id . "' ");
							$project_details_data = $project_details_rs->fetch_assoc();

							?>

							<div class="wizard-content">
								<section>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<label for="upstaff">Staff :</label>
												<select name="staff" id="upstaff" class="custom-select form-control" autocomplete="off">
													<option value="0">Select Staff...</option>

													<?php
													$staff_rs = Database::search("SELECT * FROM `staff_details`");
													$staff_num = $staff_rs->num_rows;

													for ($y = 0; $y < $staff_num; $y++) {

														$staff_data =  $staff_rs->fetch_assoc();
													?>

														<option value="<?php echo $staff_data["staff_email"]; ?>" <?php if (!empty($project_details_data["staff_email"])) {
																														if ($staff_data["staff_email"] == $project_details_data["staff_email"]) {
																													?>selected<?php
																															}
																														} ?>><?php echo $staff_data["first_name"] . " " . $staff_data["last_name"]; ?>&nbsp;-&nbsp;<?php echo $staff_data["staff_email"]; ?></option>

													<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<label for="upname">Project Name :</label>
												<input name="project_name" id="upname" type="text" class="form-control" autocomplete="off" placeholder="Enter Project Name" value="<?php echo $project_details_data["name"]; ?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<label for="uptype">Project Type :</label>
												<select name="project_type" id="uptype" class="custom-select form-control" autocomplete="off">
													<option value="0">Select project type...</option>
													<?php
													$project_type_rs = Database::search("SELECT * FROM `project_type`");
													$project_type_num = $project_type_rs->num_rows;

													for ($x = 0; $x < $project_type_num; $x++) {

														$project_type_data =  $project_type_rs->fetch_assoc();
													?>

														<option value="<?php echo $project_type_data["id"]; ?>" <?php if (!empty($project_details_data["project_type_id"])) {
																													if ($project_type_data["id"] == $project_details_data["project_type_id"]) {
																												?>selected<?php
																														}
																													} ?>><?php echo $project_type_data["name"]; ?></option>

													<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label for="upstart">Start Date :</label>
												<?php

												$date1 = $project_details_data["start_date"];
												$start_date = date("d F Y", strtotime($date1));

												?>
												<input name="start_date" id="upstart" type="text" class="form-control date-picker" autocomplete="off" placeholder="Enter Project Start Date" value="<?php echo $start_date; ?>" />
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label for="upend">End Date :</label>
												<?php

												$date2 = $project_details_data["end_date"];
												$end_date = date("d F Y", strtotime($date2));

												?>
												<input name="end_date" id="upend" type="text" class="form-control date-picker" autocomplete="off" placeholder="Enter Project End Date" value="<?php echo $end_date; ?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label for="upreq">Project Requirements :</label>
												<textarea name="requirements" id="upreq" class="form-control" placeholder="Describe project requirements in detail.." autocomplete="off"><?php echo $project_details_data["description"]; ?></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>(Upload all resources as a zip file)</label> <br />
												<input type="file" class="d-none" id="resFile" accept="application/zip,application/x-zip,application/x-zip-compressed,application/octet-stream" />
												<label for="resFile" style="display: inline;" class="btn btn-primary" onclick="reUploadResources()"><i class="fa fa-cloud-upload"></i> Re-upload Resources</label>
												<h5 style="display: inline;" id="resFileName"></h5>
											</div>
										</div>
										<div class="col-md-4 col-sm-12">
											<div class="form-group">
												<label style="font-size:16px;"><b></b></label>
												<div class="modal-footer justify-content-center">
													<button class="btn btn-primary" onclick="updateProject(<?php echo $id; ?>);">Update&nbsp;project</button>
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>

						</div>

						<!-- Update Project Details Section End -->

						<!-- Completed Project Details Section -->

						<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
							<div class="clearfix">
								<div class="pull-left">
									<h4 class="text-blue h4">Completed Project</h4>
									<p class="mb-20"></p>
								</div>
							</div>
							<div class="wizard-content">
								<section>
									<?php

									$u_project_details_rs = Database::search("SELECT * FROM uploaded_project WHERE project_id ='" . $id . "' ");
									$u_project_details_num = $u_project_details_rs->num_rows;

									$upid = 0;

									if ($u_project_details_num != 0) {
										$u_project_details_data = $u_project_details_rs->fetch_assoc();
										$upid = $u_project_details_data["id"];
									?>
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<h5 class="h6">Describe project :</h5>
													<p><?php echo $u_project_details_data["description"]; ?></p>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<a href="process/download.php?file=<?php echo $u_project_details_data["path"]; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Project</a>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="modal-footer justify-content-center">
														<a class="btn btn-primary" data-toggle="modal" data-target="#reviewModal" href="reviewModal"><i class="fa fa-star-o"></i> Review</a>
													</div>
												</div>
											</div>
										</div>
									<?php
									} else {
									?>
										<div class="row">
											<div class="col-12">
												<div class="form-group text-center">
													<h6 class="h6">No project uploaded yet.</h6>
												</div>
											</div>
										</div>

									<?php
									}
									?>
								</section>
							</div>
						</div>

						<!-- Completed Project Details Section End -->

						<!-- Review Section -->

						<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
							<div class="clearfix">
								<div class="pull-left">
									<h4 class="text-blue h4">Reviews</h4>
									<p class="mb-20"></p>
								</div>
							</div>

							<div class="wizard-content">

								<div class="row">

									<?php

									$review_rs = Database::search("SELECT * FROM review WHERE uploaded_project_id ='" . $upid . "' ");
									$review_num = $review_rs->num_rows;

									if ($review_num != 0) {

										for ($z = 0; $z < $review_num; $z++) {
											$review_data = $review_rs->fetch_assoc();

									?>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<div class="row">
														<div class="col-6">
															<h5 class="h6">Admin :</h5>
														</div>
														<div class="col-6">
															<div class="d-flex justify-content-end star">
																<?php

																$totalStar = 5;
																$starCount = $review_data["rate"];
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
																?>
															</div>
														</div>
													</div>

													<p><?php echo $review_data["comment"]; ?></p>
													<span class="h7 text-black-50 pull-right p-review-date"><?php echo $review_data["date"]; ?></span>
												</div>
											</div>
										<?php
										}
									} else {
										?>
										<div class="col-md-12 col-sm-12">
											<div class="form-group text-center">
												<h6 class="h6">This project has no reviews.</h6>
											</div>
										</div>
									<?php
									}
									?>

								</div>

							</div>
						</div>

						<!-- Review Section End -->

					</div>
					<?php include('includes/footer.php'); ?>
				</div>
			</div>

			<!-- Review Modal -->
			<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="weight-500 col-md-12 pd-20">
							<div class="form-group">
								<div class="row">
									<div class="col-12">
										<h4 class="h4">Review</h4>
										<div class="d-inline-flex">
											<label>Rate :</label>&nbsp;&nbsp;
											<div class="star2">
												<i class="fa fa-star"></i>&nbsp;
												<i class="fa fa-star"></i>&nbsp;
												<i class="fa fa-star"></i>&nbsp;
												<i class="fa fa-star"></i>&nbsp;
												<i class="fa fa-star"></i>&nbsp;
											</div>
										</div>
									</div>
									<div class="col-12">
										<label for="rcomment">Comment :</label>
										<textarea id="rcomment" name="description" class="form-control" placeholder="Give a review about the project..." autocomplete="off"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="saveReview(<?php echo $upid; ?>);">Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Review Modal End -->

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

			<script type="text/javascript">

				// Star icon color change process

				var stars = document.querySelectorAll('.star2 i');

				stars.forEach((item, index1) => {
					item.addEventListener('click', () => {
						stars.forEach((star, index2) => {
							if (index1 >= index2) {
								star.classList.add('activeStar');
							} else {
								star.classList.remove('activeStar');
							}
						})
					})
				});
			</script>

		<?php

	} else {

		?>

			<h3>Please select project first!</h3>

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