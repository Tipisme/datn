<?php
include __DIR__ . '/lib/session.php';
Session::init();
include __DIR__ . '/classes/CV.php';
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
if (isset($_GET['cvId'])) {
    $cvId = $_GET['cvId'];
}
$class = new CV();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $insert = $class->updateCV($cvId, $title, $_FILES);
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

                                    <h5 class="card-title mb-0">Chỉnh sửa CV</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($insert)) {
                                        echo $insert;
                                    }
                                    ?>

                                    <?php
                                    $class = new CV();
                                    $show = $class->showCVById($cvId);
                                    if ($show) {
                                        $i = 0;
                                        while ($result = $show->fetch_assoc()) {
                                            $i++;

                                            ?>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <input type="hidden" name="userId" value="<?= Session::get('userId') ?>" />
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputUsername">Title</label>
                                                            <input type="text" name="title" class="form-control" value="<?= $result['cvTitle'] ?>"
                                                                placeholder="Ex. CV NGUYEN VAN TUNG">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputUsername">Tệp</label> <br>
                                                            <a href='./uploads/<?= $result['cvFile'] ?>' target="_blank">Xem CV cũ</a>
                                                            <input type="file" name="fileCV" class="form-control"
                                                                accept=".pdf,.docx">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                                            </form>
                                        <?php }
                                    } ?>
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

</html>