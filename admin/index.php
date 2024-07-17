<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employee Portal</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">

	<?php

	include "../config/connection.php";

	?>

</head>

<body class="login-page">

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

	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">

				<!-- Background Image -->

				<div class="col-md-6 col-lg-7">
					<img src="../vendors/images/admin-login-page-img.png" alt="">
				</div>

				<!-- Background Image End -->

				<div class="col-md-6 col-lg-5">

					<!-- Logo Image -->

					<div class="d-flex justify-content-center align-items-center">
						<div class="brand-logo">
							<a href="index.php">
								<img src="../vendors/images/deskapp-logo-svg.png" alt="">
							</a>
						</div>
					</div>


					<!-- Logo Image End -->

					<!-- Login Form -->

					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Welcome To EmpSystem</h2>
							<h4 class="text-center pt-10 h4">Admin SignIn</h4>
						</div>

						<?php

						$email = "";
						$password = "";

						// Check cookies set or not

						if (isset($_COOKIE["email"])) {
							$email = $_COOKIE["email"];
						}

						if (isset($_COOKIE["password"])) {
							$password = $_COOKIE["password"];
						}

						?>

						<div class="input-group custom">
							<input type="text" class="form-control form-control-lg" autocomplete="off" placeholder="Email" name="email" id="aemail" value="<?php echo $email; ?>" />
							<div class="input-group-append custom">
								<span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
							</div>
						</div>
						<div class="input-group">
							<input type="password" class="form-control form-control-lg" autocomplete="off" placeholder="Password" name="password" id="apassword" value="<?php echo $password; ?>" />
							<div class="input-group-prepend">
								<span class="input-group-text bg-primary" onclick="showPassword3();">
									<i class="fa fa-eye-slash text-white" id="e3"></i>
								</span>
							</div>
						</div>
						<div class="pb-20">
							<div class="row">
								<div class="col-12 pb-10">
									<div class="row">
										<div class="col-md-6">
											<div class="remember-me">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="rememberme" />
													<label class="forgot-password" for="rememberme">
														Remember Me
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="forgot-password"><a href="#" class="text-md-right" onclick="forgotPassword();">Forgot Password?</a></div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button class="btn2" onclick="adminSignIn()">Sign In</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Login Form End -->

				</div>
			</div>
		</div>
	</div>

	<!-- Forgot Password Modal -->
	<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="weight-500 col-md-12 pd-20">
					<div class="login-title">
						<h3 class="text-center text-primary">Forgot Password</h3>
					</div>
					<div class="pnb-20">
						<div class="row">
							<div class="input-group">
								<input type="password" id="alp1" class="form-control" required="true" autocomplete="off" placeholder="Enter New Password" />
								<div class="input-group-prepend">
									<span class="input-group-text bg-primary" onclick="showPassword4();">
										<i class="fa fa-eye-slash text-white" id="e4"></i>
									</span>
								</div>
							</div>
							<div class="input-group">
								<input type="password" id="alp2" class="form-control" required="true" autocomplete="off" placeholder="Re-type Password" />
								<div class="input-group-prepend">
									<span class="input-group-text bg-primary" onclick="showPassword5();">
										<i class="fa fa-eye-slash text-white" id="e5"></i>
									</span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Enter Verification Code" name="vcode" id="vcode" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="text-red-50">Verification code has send to your Email. Please check your inbox</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Forgot Password Modal -->

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
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../assets/scripts/script.js"></script>

</body>

</html>