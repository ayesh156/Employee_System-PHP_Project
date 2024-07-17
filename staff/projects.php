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

		<div class="main-container">
			<div class="pd-ltr-20">

			<!-- Breadcrumb Section -->

				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Projects History</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Projects History</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<!-- Breadcrumb Section End -->

				<!-- Project List -->

				<div class="card-box mb-30">
					<div class="pd-20">
						<h2 class="text-blue h4">ALL PROJECTS</h2>
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

								$project_rs = Database::search("SELECT project.id AS pid, project.name AS pname, project_type.name AS ptname, project.start_date, project.end_date, status.status FROM `project` INNER JOIN project_type ON project.project_type_id = project_type.id INNER JOIN `status` ON project.status_id = status.id WHERE `project`.`staff_email`='" . $email . "' ");
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
											<td><?php echo $project_data["status"]; ?></td>
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

				<!-- Project List End -->

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