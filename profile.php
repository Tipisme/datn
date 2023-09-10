<?php
include __DIR__ . '/lib/session.php';
Session::init();
include __DIR__ . '/classes/User.php';
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
$class = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $insert = $class->upgradeInfoAndAvatar($address, $phone, $userId, $_FILES);
}
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

                                    <h5 class="card-title mb-0">Thông tin công khai</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($insert)) {
                                        echo $insert;
                                    }
                                    ?>
                                    <form method="POST" action="profile.php" enctype="multipart/form-data">
                                        <input type="hidden" name="userId" value="<?= Session::get('userId') ?>" />
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputUsername">Họ và Tên</label>
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
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputAddress">Địa chỉ</label>
                                                    <input type="text" class="form-control" id="inputAddress"
                                                        name="address" value="<?= Session::get('address') ?>"
                                                        placeholder="Ex. 1234 Main St">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputAddress2">số điện thoại</label>
                                                    <input type="text" class="form-control" id="inputAddress2"
                                                        name="phone" value="<?= Session::get('phone') ?>"
                                                        placeholder="Ex. 0987654321">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <?php
                                                    if (strpos(Session::get('imageUrl'), "https://") !== false) {
                                                        ?>
                                                    <img id="profileImage" alt="Charles Hall"
                                                        src="<?= Session::get('imageUrl') ? Session::get('imageUrl') : "avatar-2.jpg" ?>"
                                                        class="rounded-circle img-responsive mt-2" width="128"
                                                        height="128" />
                                                    <?php
                                                    } else {
                                                        ?>
                                                    <img id="profileImage" alt="Charles Hall"
                                                        src="./uploads/<?= Session::get('imageUrl') ? Session::get('imageUrl') : "avatar-2.jpg" ?>"
                                                        class="rounded-circle img-responsive mt-2" width="128"
                                                        height="128" />
                                                        <?php
                                                    }
                                                    ?>


                                                    <div class="mt-2">
                                                        <label for="uploadInput" class="btn btn-primary">
                                                            <i class="fas fa-upload"></i> Tải lên
                                                        </label>
                                                        <input type="file" name="uploadInput" id="uploadInput"
                                                            style="display: none;">
                                                    </div>
                                                    <small>Để có kết quả tốt nhất, hãy sử dụng hình ảnh có kích thước tối thiểu 128px
                                                        128px ở định dạng .jpg</small>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </form>

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