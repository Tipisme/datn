<?php
include '../lib/session.php';
Session::checkSessionRecruiter();
include '../classes/User.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
	Session::destroy();
}
?>

<?php
$class = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$userId = $_POST['userId'];
	$insert = $class->upgradeAvatar($userId, $_FILES);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change-password'])) {
	$userId = $_POST['userId'];
	$oldPass = md5($_POST['oldPass']);
	$newPass = md5($_POST['newPass']);
	$confirmPass = md5($_POST['confirmPass']);
	$insert = $class->changePassword($userId, $oldPass, $newPass, $confirmPass);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="./asset/img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

	<link href="./asset/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<div class="wrapper">
		<?php include('./inc/sidebar.php') ?>

		<div class="main">
			<?php include('./inc/header.php') ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Settings</h1>

					<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-bs-toggle="list"
										href="#account" role="tab">
										Account
									</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list"
										href="#password" role="tab">
										Password
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Public info</h5>
										</div>
										<div class="card-body">
											<?php
											if (isset($insert)) {
												echo $insert;
											}
											?>
											<form method="POST" action="profile.php" enctype="multipart/form-data">
												<input type="hidden" name="userId"
													value="<?= Session::get('userId') ?>" />
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<label class="form-label" for="inputUsername">Name</label>
															<input type="text" class="form-control"
																value="<?= Session::get('name') ?>" id="inputUsername"
																placeholder="Username" disabled>
														</div>
														<div class="mb-3">
															<label class="form-label" for="inputUsername">Email</label>
															<input type="text" class="form-control"
																value="<?= Session::get('email') ?>" id="inputUsername"
																placeholder="Username" disabled>
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">
															<img id="profileImage" alt="Charles Hall"
																src="../uploads/<?= Session::get('imageUrl') ? Session::get('imageUrl') : "avatar-2.jpg" ?>"
																class="rounded-circle img-responsive mt-2" width="128"
																height="128" />
															<div class="mt-2">
																<label for="uploadInput" class="btn btn-primary">
																	<i class="fas fa-upload"></i> Upload
																</label>
																<input type="file" name="uploadInput" id="uploadInput"
																	style="display: none;">
															</div>
															<small>For best results, use an image at least 128px by
																128px in .jpg format</small><br>
														</div>
													</div>
												</div>

												<button type="submit" name="submit" class="btn btn-primary">Save
													changes</button>
											</form>

										</div>
									</div>

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Private info</h5>
										</div>
										<div class="card-body">
											<form>
												<div class="mb-3">
													<label class="form-label" for="inputAddress">Address</label>
													<input type="text" class="form-control" id="inputAddress"
														value="<?= Session::get('address') ?>"
														placeholder="Ex. 1234 Main St" disabled>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputAddress2">Phone</label>
													<input type="text" class="form-control" id="inputAddress2"
														value="<?= Session::get('phone') ?>"
														placeholder="Ex. 0987654321" disabled>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputAddress2">Position</label>
													<input type="text" class="form-control" id="inputAddress2"
														value="<?= Session::get('position') ?>" placeholder="Ex. HR"
														disabled>
												</div>
											</form>

										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Password</h5>

											<form action="profile.php" method="POST">
												<input type="hidden" name="userId"
													value="<?= Session::get('userId') ?>" />
												<div class="mb-3">
													<label class="form-label" for="inputPasswordCurrent">Current
														password</label>
													<input type="password" name="oldPass" class="form-control"
														id="inputPasswordCurrent" required>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew">New
														password</label>
													<input type="password" name="newPass" class="form-control"
														id="inputPasswordNew" required>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew2">Verify
														password</label>
													<input type="password" name="confirmPass" class="form-control"
														id="inputPasswordNew2" required>
												</div>
												<button type="submit" name="change-password"
													class="btn btn-primary">Save
													changes</button>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<?php include('./inc/footer.php') ?>
		</div>
	</div>
	<script src="./asset/js/app.js"></script>
	<script src="./asset/js/datatables.js"></script>
	<script>
		$(document).ready(function () {
			// When the user selects an image
			$('#uploadInput').on('change', function (e) {
				var file = e.target.files[0];

				// Create a FileReader object
				var reader = new FileReader();

				// Set the callback function when the file is loaded
				reader.onload = function (e) {
					// Update the source of the profile image
					$('#profileImage').attr('src', e.target.result);
				};

				// Read the file as a data URL
				reader.readAsDataURL(file);
			});
		});
	</script>


	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Datatables with Multiselect
			var datatablesMulti = $("#datatables-multi").DataTable({
				responsive: true,
				select: {
					style: "multi"
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function (event) {
			setTimeout(function () {
				if (localStorage.getItem('popState') !== 'shown') {
					window.notyf.open({
						type: "success",
						message: "Get access to all 500+ components and 45+ pages with AdminKit PRO. <u><a class=\"text-white\" href=\"https://adminkit.io/pricing\" target=\"_blank\">More info</a></u> 🚀",
						duration: 10000,
						ripple: true,
						dismissible: false,
						position: {
							x: "left",
							y: "bottom"
						}
					});

					localStorage.setItem('popState', 'shown');
				}
			}, 15000);
		});
	</script>
</body>

</html>