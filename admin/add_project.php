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
			<div class="pb-20">
				<div class="min-height-200px">

					<!-- Breadcrumb Section -->

					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Add Project</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Add Project</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<!-- Breadcrumb Section End -->

					<!-- Add Project Details Section -->

					<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Project Form</h4>
								<p class="mb-20"></p>
							</div>
						</div>
						<div class="wizard-content">
							<section>

								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label for="pstaff">Staff :</label>
											<select name="project_type" id="pstaff" class="custom-select form-control" autocomplete="off" />
											<option value="0">Select Staff...</option>

											<?php
											$staff_rs = Database::search("SELECT * FROM `staff_details`");
											$staff_num = $staff_rs->num_rows;

											for ($y = 0; $y < $staff_num; $y++) {

												$staff_data =  $staff_rs->fetch_assoc();
											?>

												<option value="<?php echo $staff_data["staff_email"]; ?>"><?php echo $staff_data["first_name"] . " " . $staff_data["last_name"]; ?>&nbsp;-&nbsp;<?php echo $staff_data["staff_email"]; ?></option>

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
											<label for="pname">Project Name :</label>
											<input name="project_name" id="pname" type="text" class="form-control" autocomplete="off" placeholder="Enter Project Name" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label for="ptype">Project Type :</label>
											<select name="project_type" id="ptype" class="custom-select form-control" autocomplete="off">
												<option value="0">Select project type...</option>
												<?php
												$project_type_rs = Database::search("SELECT * FROM `project_type`");
												$project_type_num = $project_type_rs->num_rows;

												for ($x = 0; $x < $project_type_num; $x++) {

													$project_type_data =  $project_type_rs->fetch_assoc();
												?>

													<option value="<?php echo $project_type_data["id"]; ?>"><?php echo $project_type_data["name"]; ?></option>

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
											<label for="pstart">Start Date :</label>
											<input name="date_from" id="pstart" type="text" class="form-control date-picker" autocomplete="off" placeholder="Enter Project Start Date" />
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label for="pend">End Date :</label>
											<input name="date_to" id="pend" type="text" class="form-control date-picker" autocomplete="off" placeholder="Enter Project End Date" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="preq">Project Requirements :</label>
											<textarea name="requirements" id="preq" class="form-control" placeholder="Describe project requirements in detail.." autocomplete="off"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label>(Upload all resources as a zip file)</label> <br />
											<input type="file" class="d-none" id="assFile" accept="application/zip,application/x-zip,application/x-zip-compressed,application/octet-stream" />
											<label for="assFile" style="display: inline;" class="btn btn-primary" onclick="uploadResources()"><i class="fa fa-cloud-upload"></i> Upload Resources</label>
											<h5 style="display: inline;" id="assFileName"></h5>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" onclick="addProject();">Submit&nbsp;project</button>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>

					<!-- Add Project Details Section End -->

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