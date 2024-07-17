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

		<?php

		include('includes/left_sidebar.php');

		// Rejected project update process in the database

		$d = new DateTime();
		$tz = new DateTimeZone("Asia/Colombo");
		$d->setTimezone($tz);
		$date = $d->format("Y-m-d");

		$project_details_rs = Database::search("SELECT * FROM `project` WHERE `staff_email`='" . $email . "'");
		$project_details_num = $project_details_rs->num_rows;

		if ($project_details_num > 0) {

			for ($pd = 0; $pd < $project_details_num; $pd++) {
				$project_details_data = $project_details_rs->fetch_assoc();

				if ($project_details_data["end_date"] < $date) {

					$u_project_details_rs = Database::search("SELECT * FROM `uploaded_project` WHERE `project_id` = '" . $project_details_data["id"] . "'");
					$u_project_details_num = $u_project_details_rs->num_rows;

					if ($u_project_details_num == 0) {

						Database::iud("UPDATE `project` SET `status_id`='3' WHERE `id`='" . $project_details_data["id"] . "'");
					}
				}
			}
		}

		?>

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20">

				<!-- Welcome Section -->

				<div class="card-box pd-20 height-100-p mb-30">
					<div class="row align-items-center">
						<div class="col-md-4 user-icon">
							<img src="../vendors/images/banner-img.png" alt="">
						</div>
						<div class="col-md-8">

							<?php
							$user_rs = Database::search("SELECT * FROM `staff_details` WHERE `staff_email` = '" . $email . "' ");
							$user_data = $user_rs->fetch_assoc();
							?>

							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Welcome back <div class="weight-600 font-30 text-blue"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?>,</div>
							</h4>
							<p class="font-18 max-width-600">you are in the employee management system of the best software company in Sri Lanka.</p>
						</div>
					</div>
				</div>

				<!-- Welcome Section End -->

				<!-- Project Details Card Section -->

				<div class="row pb-10">

					<?php

					$c_project_rs = Database::search("SELECT * FROM `project` WHERE `staff_email`='" . $email . "' AND `status_id` = '2'");
					$c_project_num = $c_project_rs->num_rows;

					?>

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

				</div>

				<!-- Project Details Card Section End -->

				<div class="row">

					<!-- Company Heads List -->

					<div class="col-lg-4 col-md-6 mb-20">
						<div class="card-box height-100-p pd-20 min-height-200px">
							<div class="d-flex justify-content-between pb-10">
								<div class="h5 mb-0">Company Heads</div>
							</div>
							<div class="user-list">
								<ul>

									<?php

									$head_rs = Database::search("SELECT * FROM staff INNER JOIN staff_details ON staff.email = staff_details.staff_email WHERE `position_id` = '1'");
									$head_num = $head_rs->num_rows;

									for ($h = 0; $h < $head_num; $h++) {
										$head_data = $head_rs->fetch_assoc();
									?>

										<li class="d-flex align-items-center justify-content-between mt-05">
											<div class="name-avatar d-flex align-items-center pr-2">
												<div class="avatar mr-2 flex-shrink-0">
													<?php

													$head_img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $head_data["email"] . "'");
													$head_img_num = $head_img_rs->num_rows;

													if ($head_img_num == 0) {
													?>
														<img src="../assets/images/no-image-available.jpg" class="border-radius-100 box-shadow" width="50" height="50" alt="">
													<?php
													} else {
														$head_img_data = $head_img_rs->fetch_assoc();
													?>
														<img src="<?php echo $head_img_data["path"]; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
													<?php

													}

													?>
												</div>
												<div class="txt">
													<div class="font-14 weight-600"><?php echo $head_data["first_name"] . " " . $head_data["last_name"]; ?></div>
													<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $head_data["email"]; ?></div>
												</div>
											</div>
											<div class="font-12 weight-500" data-color="#17a2b8"><?php echo $head_data["mobile"]; ?></div>
										</li>

									<?php
									}
									?>

								</ul>
							</div>
						</div>
					</div>

					<!-- Company Heads List End -->

					<!-- Company Information Chart -->

					<div class="col-lg-4 col-md-6 mb-20">
						<div class="card-box height-100-p pd-20 min-height-200px">
							<div class="d-flex justify-content-between">
								<div class="h5 mb-0">Application Setup</div>
							</div>

							<div id="application-chart"></div>
						</div>
					</div>

					<!-- Company Information Chart End -->

					<!-- Company Employee List -->

					<div class="col-lg-4 col-md-6 mb-20">
						<div class="card-box height-100-p pd-20 min-height-200px">
							<div class="d-flex justify-content-between">
								<div class="h5 mb-0">Staff</div>
							</div>

							<div class="user-list">
								<ul>

									<?php

									$employee_rs = Database::search("SELECT * FROM staff INNER JOIN staff_details ON staff.email = staff_details.staff_email WHERE `position_id` = '2'");
									$employee_num = $employee_rs->num_rows;

									for ($e = 0; $e < $employee_num; $e++) {
										$employee_data = $employee_rs->fetch_assoc();
									?>

										<li class="d-flex align-items-center justify-content-between mt-05">
											<div class="name-avatar d-flex align-items-center pr-2">
												<div class="avatar mr-2 flex-shrink-0">
													<?php

													$employee_img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $employee_data["email"] . "'");
													$employee_img_num = $employee_img_rs->num_rows;

													if ($employee_img_num == 0) {
													?>
														<img src="../assets/images/no-image-available.jpg" class="border-radius-100 box-shadow" width="50" height="50" alt="">
													<?php
													} else {
														$employee_img_data = $employee_img_rs->fetch_assoc();
													?>
														<img src="<?php echo $employee_img_data["path"]; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
													<?php

													}

													?>
												</div>
												<div class="txt">
													<div class="font-14 weight-600"><?php echo $employee_data["first_name"] . " " . $employee_data["last_name"]; ?></div>
													<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $employee_data["email"]; ?></div>
												</div>
											</div>
											<div class="font-12 weight-500" data-color="#17a2b8"><?php echo $employee_data["mobile"]; ?></div>
										</li>

									<?php
									}
									?>

								</ul>
							</div>
						</div>
					</div>

					<!-- Company Employee List End -->

				</div>

				<!-- Active Projects Section -->

				<div class="card-box mb-30">
					<div class="pd-20">
						<h2 class="text-blue h4">ACTIVE PROJECTS</h2>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th>PROJECT NAME</th>
									<th>PROJECT TYPE</th>
									<th>START DATE</th>
									<th>END DATE</th>
									<th>STATUS</th>
									<th class="datatable-nosort">ACTION</th>
								</tr>
							</thead>
							<tbody>

								<?php

								$project_rs = Database::search("SELECT project.id AS pid, project.name AS pname, project_type.name AS ptname, project.start_date, project.end_date FROM `project` INNER JOIN project_type ON project.project_type_id = project_type.id WHERE `status_id` = '1' AND `project`.`staff_email`='" . $email . "' ");
								$project_num = $project_rs->num_rows;

								if ($project_num == 0) {

								?>

									<tr>
										<td colspan="6" class="text-center"><span class="h5">Currently there is no active project..</span></td>
									</tr>

									<?php

								} else {

									for ($a = 0; $a < $project_num; $a++) {
										$project_data = $project_rs->fetch_assoc();
									?>

										<tr>

											<td><?php echo $project_data["pname"]; ?></td>
											<td><?php echo $project_data["ptname"]; ?></td>
											<td><?php echo $project_data["start_date"]; ?></td>
											<td><?php echo $project_data["end_date"]; ?></td>
											<td>Not Uploaded</td>
											<td>
												<div class="table-actions">
													<a title="VIEW" href="project_details.php?id=<?php echo $project_data["pid"]; ?>" data-color="#265ed7"><i class="icon-copy dw dw-eye"></i></a>
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

				<!-- Active Projects Section End -->

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