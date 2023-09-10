<?php
include __DIR__ . '/lib/session.php';
Session::init();
if (Session::get('level') != false) {
    Session::destroy();
}
include __DIR__ . '/classes/Job.php';
include __DIR__ . '/classes/Company.php';
include __DIR__ . '/classes/CV.php';
include __DIR__ . '/classes/Recruitment.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>
<?php
$class = new Job();
$recruitment = new Recruitment();

if ($_GET['jobId'] != null || isset($_GET['jobId'])) {
    $id = $_GET['jobId'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$jobId = $_GET['jobId'];
    $cvId = $_POST['cvId'];
    $userId = Session::get('userId');
    $date = date("Y-m-d");
	$insert = $recruitment->applyJob($jobId, $cvId, $date, $userId);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="fb-root"></div>
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


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Job Detail</h1>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <?php
        $getJobById = $class->getJobById($id);
        if ($getJobById) {
            while ($job = $getJobById->fetch_assoc()) {
                ?>
                <!-- Job Detail Start -->
                <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="row gy-5 gx-4">
                            <div class="col-lg-8">
                                <div class="d-flex align-items-center mb-5">
                                <?php
                                $company = new Company();
                                $companyList = $company->showCompanyById($job['companyId']);
                                if ($companyList) {
                                                while ($c = $companyList->fetch_assoc()) {
                                            ?>
                                                <img class="flex-shrink-0 img-fluid border rounded" src="./uploads/<?php echo $c['image'] ?>"
                                                    alt="" style="width: 80px; height: 80px;">
                                                    <?php
                                                }
                                                    } 
                                                ?>
                                    <div class="text-start ps-4">
                                        <h3 class="mb-3"><?= $job['title'] ?></h3>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i><?= $job['address'] ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $job['time'] ?></span>
                                        <span class="text-truncate me-0"><i
                                                class="far fa-money-bill-alt text-primary me-2"></i><?= number_format($job['min_salary']).'đ' ?> -
                                                            <?= number_format($job['max_salary']).'đ' ?></span>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <h4 class="mb-3">Mô tả công việc</h4>
                                    <p><?= $job['description'] ?></p>
                                    <h4 class="mb-3">Yêu cầu</h4>
                                    <p><?= $job['require_job'] ?></p>

                                    <h4 class="mb-3">Chế độ & quyền lợi</h4>
                                    <p><?= $job['welfare'] ?></p>
                                </div>

                                <div class="mb-5">
                                    <h4>Ứng tuyển công việc này</h4>
                                    <?php
                                    if (isset($insert)) {
                                        echo $insert;
                                    }
                                    ?>
                                    <?php if(Session::get('login_customer')){ ?>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" data-toggle="modal" data-target="#exampleModal" type="submit">Ứng tuyển ngay</button>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <div>Vui lòng đăng nhập để có thể ứng tuyển</div>
                                    <?php } ?>
                                </div>

                                <div class="mb-5">
                                    <h4>Bình luận</h4>
                                    <div class="fb-comments" data-href="http://127.0.0.1/topcv/job-detail.php?jobId=<?= $_GET['jobId']?>" data-width="100%" data-numposts="5"></div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                                    <h4 class="mb-4">Tóm tắt công việc</h4>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Vị trí: <?= $job['title'] ?></p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Tính chất: <?= $job['time'] ?></p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Lương: <?= number_format($job['min_salary']).'đ' ?> -
                                                            <?= number_format($job['max_salary']).'đ' ?></p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Địa chỉ: <?= $job['address'] ?></p>
                                    <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Hạn nộp: <?= $job['deadline'] ?>
                                    </p>
                                </div>
                                <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                                    <h4 class="mb-4">Thông tin công ty</h4>
                                    <?php 
                                    $company = new Company();
                                    $companyList = $company->showCompanyById($job['companyId']);
                                    if ($companyList) {
                                                while ($c = $companyList->fetch_assoc()) {
                                            ?>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Tên công ty: <?php echo $c['companyName'] ?></p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Mô tả: <?php echo $c['description'] ?></p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Email: <?php echo $c['companyEmail'] ?></p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Số điện thoại: <?php echo $c['companyPhone'] ?></p>
                                    <?php
                                                }
                                                    } 
                                                ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Detail End -->
            <?php }
        } ?>

        <?php if(Session::get('login_customer')){ ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Chose Your CV</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <form action="" method="POST">
                                            <div class="modal-body">
                                            <?php
                                                    $class = new CV();
                                                    $show = $class->showAllCVByUserId(Session::get('userId'));
                                                    if ($show) {
                                                            while ($result = $show->fetch_assoc()) {
                                                    ?> 
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cvId" value="<?= $result['cvId']?>" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        <?= $result['cvTitle']?>
                                                    </label>
                                                </div>
                                                <?php }} ?>
                                                
                                                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Apply</button>
                                            </div>
                                            </form> 
                                    </div>
                </div>
            </div>
        <?php } ?>

        <?php include('./inc/footer.php') ?>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0&appId=785175989962153&autoLogAppEvents=1" nonce="sUdQaeyP"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>