<?php
include __DIR__ . '/lib/session.php';
Session::init();
if (Session::get('level') != false) {
    Session::destroy();
}
include __DIR__ . '/classes/Job.php';
include __DIR__ . '/classes/Company.php';
include __DIR__ . '/classes/JobStores.php';
include __DIR__ . '/classes/Category.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php
$jobstores = new JobStores();
if (isset($_GET['follow'])) {
    $jobId = $_GET['follow'];
    $userId = Session::get('userId');
    $insert = $jobstores->saveJobs($userId, $jobId);
}

if (isset($_GET['unfollow'])) {
    $jobId = $_GET['unfollow'];
    $userId = Session::get('userId');
    $insert = $jobstores->unfollow($userId, $jobId);
}

$catId = "";
$keyword = "";
$salary = "";

if (isset($_GET['category'])) {
    $catId = $_GET['category'];
}
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
if(isset($_GET['salary'])){
    $salary = $_GET['salary'];
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
    <style>
        #pagination-links {
            margin-top: 10px;
            text-align: center;
        }

        #pagination-links a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #eaeaea;
            color: #333;
            text-decoration: none;
            border-radius: 3px;
        }

        #pagination-links a:hover {
            background-color: #ccc;
        }
    </style>
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


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Danh sách công việc</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Công việc</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <form method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control border-0" 
                                value="<?php 
                                if (isset($_GET['keyword'])) {
                                    echo $_GET['keyword'];
                                }
                                ?>" 
                                
                                placeholder="Từ khóa" />
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="salary"
                                min="0"
                                value="<?php 
                                if (isset($_GET['salary'])) {
                                    echo $_GET['salary'];
                                }
                                ?>" 
                                class="form-control border-0" placeholder="Mức lương" />
                            </div>
                            <div class="col-md-4">
                            <select name="category" class="form-select border-0">
                                                    <option selected="" value="">Danh mục</option>
                                                    <?php
                                                    $cat = new Category();
                                                    $catList = $cat->showAllCategory();

                                                    if ($catList) {
                                                        while ($result = $catList->fetch_assoc()) {
                                                            ?>
                                                            <option <?php

                                                            if ($_GET['category'] == $result['catId']) {
                                                                echo 'selected';
                                                            }

                                                            ?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark border-0 w-100">Tìm kiếm</button>
                    </div>
                </div>
                </form>
            </div>
        </div>


        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="job-items-container">
                        <?php
                        $job = new Job();
                            $show = $job->searchingJob($keyword, $salary, $catId);
                            if ($show) {
                                $i = 0;
                                while ($item = $show->fetch_assoc()) {
                                    $i++;

                                    ?>
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <?php
                                             $company = new Company();
                                             $companyList = $company->showCompanyById($item['companyId']);

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
                                                    <h5 class="mb-3"><?= $item['title'] ?></h5>
                                                    <span class="text-truncate me-3"><i
                                                            class="fa fa-map-marker-alt text-primary me-2"></i><?= $item['address'] ?></span>
                                                    <span class="text-truncate me-3"><i
                                                            class="far fa-clock text-primary me-2"></i><?= $item['time'] ?></span>
                                                    <span class="text-truncate me-0"><i
                                                            class="far fa-money-bill-alt text-primary me-2"></i><?= number_format($item['min_salary']).'đ' ?> -
                                                            <?= number_format($item['max_salary']).'đ' ?></span>
                                                </div>
                                            </div>
                                            <div
                                                class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <?php 
                                                    $getByJobstore = $jobstores->getJobStoreByJobId($item['id'], Session::get('userId'));
                                                    $flag = false;
                                                    if ($getByJobstore) {
                                                        while ($c = $getByJobstore->fetch_assoc()) {
                                                            if($c['is_followed'] == true) {
                                                            $flag = true;
                                                            } else {
                                                            $flag = false;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <?php if(Session::get('userId') && $flag == false){?>
                                                    <a class="btn btn-light btn-square me-3" href="?follow=<?= $item['id'] ?>"><i
                                                            class="far fa-heart text-primary"></i></a>
                                                    <?php } else if(Session::get('userId') && $flag == true) { ?>
                                                    <a class="btn btn-light btn-square me-3" href="?unfollow=<?= $item['id'] ?>"><i
                                                            class="fas fa-heart text-primary"></i></a>
                                                    <?php } ?>
                                                    <a class="btn btn-primary" href="job-detail.php?jobId=<?= $item['id'] ?>">Ứng tuyển ngay</a>
                                                </div>
                                                <small class="text-truncate"><i
                                                        class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?= $item['deadline'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <div id="pagination-links"></div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function () {
            var itemsPerPage = 5; // Number of items to display per page

            // Hide all job items initially
            $("#job-items-container .job-item").hide();

            // Show the first set of job items
            $("#job-items-container .job-item").slice(0, itemsPerPage).show();

            // Calculate the number of pages based on the total number of job items
            var totalPages = Math.ceil($("#job-items-container .job-item").length / itemsPerPage);

            // Generate pagination links
            for (var i = 1; i <= totalPages; i++) {
                var link = $("<a>", {
                    href: "#",
                    text: i,
                    "data-page": i
                });
                link.on("click", handlePaginationClick); // Add a click event handler to each pagination link
                $("#pagination-links").append(link); // Append the link to the pagination links container
            }

            function handlePaginationClick(e) {
                e.preventDefault();
                var page = $(this).data("page");

                // Hide all job items
                $("#job-items-container .job-item").hide();

                // Show the selected page's job items
                var startIndex = (page - 1) * itemsPerPage;
                var endIndex = page * itemsPerPage;
                $("#job-items-container .job-item").slice(startIndex, endIndex).show();
            }
        });
    </script>
</body>

</html>