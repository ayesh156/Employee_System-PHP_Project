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
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">

				<!-- Breadcrumb Section -->

					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Project Type List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Project Type List</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<!-- Breadcrumb Section End -->

					<!-- Project Type Section -->

					<div class="row">

						<!-- Add Project Type Section -->

						<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
							<div class="card-box pd-30 pt-10 height-100-p">
								<h2 class="mb-30 h4">New Project Type</h2>
								<section>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="ptname">Project Type</label>
												<input name="ptname" id="ptname" type="text" class="form-control" autocomplete="off" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="ptdec">Project Type Description</label>
												<textarea name="description" id="ptdec" type="text" style="height: 5em;" class="form-control text_area"></textarea>
											</div>
										</div>
									</div>

									<div class="col-sm-12 text-right">
										<div class="dropdown">
											<button class="btn btn-primary" onclick="addProjectType();">REGISTER</button>
										</div>
									</div>
								</section>
							</div>
						</div>

						<!-- Add Project Type Section End -->

						<!-- Project List -->

						<div class="col-lg-8 col-md-6 col-sm-12 mb-30">
							<div class="card-box pd-30 pt-10 height-100-p">
								<h2 class="mb-30 h4">Project Type List</h2>
								<div class="pb-20">
									<table class="data-table table stripe hover nowrap">
										<thead>
											<tr>
												<th class="table-plus">PROJECT TYPE</th>
												<th class="table-plus">DESCRIPTION</th>
												<th class="datatable-nosort">ACTION</th>
											</tr>
										</thead>
										<tbody>

											<?php

											$project_type_rs = Database::search("SELECT * FROM `project_type`");
											$project_type_num = $project_type_rs->num_rows;

											for ($y = 0; $y < $project_type_num; $y++) {

												$project_type_data = $project_type_rs->fetch_assoc();

											?>

												<tr>
													<td><?php echo $project_type_data["name"]; ?></td>
													<td><?php echo $project_type_data["description"]; ?></td>
													<td>
														<div class="table-actions">
															<a href="edit_project_type.php?id=<?php echo $project_type_data['id']; ?>" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
															<a href="#" data-color="#e95959" onclick="deleteProjectType(<?php echo $project_type_data['id']; ?>);"><i class="icon-copy dw dw-delete-3"></i></a>
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
						</div>

						<!-- Project List End -->

					</div>

					<!-- Project Type Section End -->

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