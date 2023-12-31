<?php
include __DIR__ . '/lib/session.php';
Session::init();
include __DIR__ . '/classes/JobStores.php';
include __DIR__ . '/classes/Job.php';
if (Session::get('level') != false) {
    Session::destroy();
}
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php
$class = new JobStores();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DATN-NGUYỄN VĂN TÙNG</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <?php include('./inc/navbar.php') ?>
        <!-- Navbar End -->
        <div class="wrapper">
            <?php include('./inc/sidebar.php') ?>
            <link href="./asset/css/app.css" rel="stylesheet">
            <div class="main">

                <main class="content">
                    <div class="container-fluid p-0">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Cửa hàng việc làm</h5>
                                </div>
                                <div class="card-body">
                                    <div id="datatables-multi_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row dt-row">
                                            <div class="col-sm-12">
                                            <?php 
                                                if(isset($delete)) {
                                                echo $delete;
                                                }
                                            ?>
                                                <table id="datatables-multi"
                                                    class="table table-striped dataTable no-footer dtr-inline"
                                                    style="width: 100%;" aria-describedby="datatables-multi_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending">
                                                                STT</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Tiêu đề công việc</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending" style="width: 200px">
                                                                Địa chỉ</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending" style="width: 200px">
                                                                Cấp độ</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending" style="width: 200px">
                                                                Lương</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $show = $class->getJobStoreByUserId(Session::get('userId'));
                                                        if ($show) {
                                                            $i = 0;
                                                            while ($result = $show->fetch_assoc()) {
                                                                $i++;
                                                                ?>
                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1" tabindex="0"> <?= $i ?>
                                                            </td>
                                                            <td><a href="job-detail.php?jobId=<?= $result['id'] ?>" target="_blank"><?= $result['title'] ?></a></td>
                                                            <td><?= $result['address'] ?></td>
                                                            <td><?= $result['level'] ?></td>
                                                            <td><?= number_format($result['min_salary']).'đ' ?> -
                                                            <?= number_format($result['max_salary']).'đ' ?></td></td>
                                                        </tr>
                                                        <?php }} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </main>
            </div>
        </div>



        <?php include('./inc/footer.php') ?>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="./asset/js/app.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

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

</html>