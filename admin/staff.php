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

		<div class="main-container">
			<div class="pd-ltr-20">

			<!-- Breadcrumb Section -->

				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>All Staff</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Staff</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<!-- Breadcrumb Section End -->

				<!-- Staff List -->

				<div class="card-box mb-30">
					<div class="pd-20">
						<h2 class="text-blue h4">ALL STAFF</h2>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus">FULL NAME</th>
									<th>EMAIL</th>
									<th>MOBILE</th>
									<th>POSITION</th>
									<th>DONE PROJECTS</th>
									<th class="datatable-nosort">ACTION</th>
								</tr>
							</thead>
							<tbody>


								<?php

								$staff = Database::search("SELECT * FROM staff INNER JOIN staff_details ON staff.email = staff_details.staff_email INNER JOIN `position` ON `position`.id = staff.position_id");
								$staff_num = $staff->num_rows;

								for ($d = 0; $d < $staff_num; $d++) {

									$staff_data =  $staff->fetch_assoc();
								?>
									<tr>
										<td class="table-plus">
											<div class="name-avatar d-flex align-items-center">
												<div class="avatar mr-2 flex-shrink-0">
													<?php

													$staff_img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $staff_data["email"] . "'");
													$staff_img_num = $staff_img_rs->num_rows;

													if ($staff_img_num == 0) {
													?>
														<img src="../assets/images/no-image-available.jpg" class="border-radius-100 shadow" width="40" height="40" alt="">
													<?php
													} else {
														$staff_img_data = $staff_img_rs->fetch_assoc();
													?>
														<img src="<?php echo $staff_img_data["path"]; ?>" class="border-radius-100 shadow" width="40" height="40" alt="">
													<?php

													}

													?>

												</div>
												<div class="txt">
													<div class="weight-600"><?php echo $staff_data["first_name"] . " " . $staff_data["last_name"]; ?></div>
												</div>
											</div>
										</td>
										<td><?php echo $staff_data["email"]; ?></td>
										<td><?php echo $staff_data["mobile"]; ?></td>
										<td><?php echo $staff_data["position"]; ?></td>

										<?php

										$project = Database::search("SELECT * FROM project WHERE `staff_email` = '" . $staff_data["email"] . "' AND `status_id` = '2' ");

										?>

										<td><?php echo $project->num_rows; ?></td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="edit_staff.php?email=<?php echo $staff_data["email"]; ?>"><i class="dw dw-edit2"></i> Edit</a>

													<?php
													if ($staff_data["option_id"] == 2) {
													?>
														<a class="dropdown-item" onclick="blockStaff('<?php echo $staff_data['email']; ?>')"><i id="sbi<?php echo $staff_data['email']; ?>" class="fa fa-lock" style="font-size: 22px;"></i> <span class="cpointer" id="sbw<?php echo $staff_data['email']; ?>">Block</span></a>
													<?php
													} else {
													?>
														<a class="dropdown-item" onclick="blockStaff('<?php echo $staff_data['email']; ?>')"><i id="sbi<?php echo $staff_data['email']; ?>" class="fa fa-unlock" style="font-size: 22px;"></i> <span class="cpointer" id="sbw<?php echo $staff_data['email']; ?>">Unblock</span></a>
													<?php
													}
													?>

													<a class="dropdown-item" href="#" onclick="deleteStaff('<?php echo $staff_data['email']; ?>');"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>

								<?php
								}
								?>


							</tbody>
						</table>
					</div>
				</div>

				<!-- Staff List End -->

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