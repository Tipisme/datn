<?php
include __DIR__ . '/lib/session.php';
Session::init();
include __DIR__ . '/classes/Advertisement.php';
include __DIR__ . '/classes/Job.php';
include __DIR__ . '/classes/Company.php';
include __DIR__ . '/classes/Category.php';
include __DIR__ . '/classes/Banner.php';
include __DIR__ . '/classes/JobStores.php';
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
$class = new Advertisement();
$job = new Job();
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobEntry - Job Portal Website Template</title>
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
        .chat-wrapper {
            height: 65%;
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


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
        <div class="owl-carousel header-carousel position-relative">
        <?php 
        $banner = new Banner();
        $showAdv = $banner->showAllBanner();
            if($showAdv) {
                $i = 0;
                while($b = $showAdv->fetch_assoc()){
                $i++;
                                                        
        ?>
            
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="./uploads/<?php echo $b['bannerImage'] ?>" style="width: 1320px; height: 682px;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4"><?php echo $b['bannerTitle'] ?></h1>
                                    <p class="fs-5 fdium text-whitw-mee mb-4 pb-2" style="color: whitesmoke;"><?php echo $b['bannerDescription'] ?></p>
                                    <a href="job-list.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search
                                        A Job</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
        <?php }}?>
        </div>
        </div>
        <!-- Carousel End -->


        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
            <form method="GET" action="job-list.php">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control border-0" placeholder="Keyword" />
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="salary" min="0" class="form-control border-0" placeholder="Salary" />
                            </div>
                            <div class="col-md-4">
                            <select name="category" class="form-select border-0">
                                                    <option selected="" value="0">Category</option>
                                                    <?php
                                                    $cat = new Category();
                                                    $catList = $cat->showAllCategory();

                                                    if ($catList) {
                                                        while ($result = $catList->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100">Search</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                            <h6 class="mb-3">Marketing</h6>
                           
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                            <h6 class="mb-3">Customer Service</h6>
                         
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                            <h6 class="mb-3">Human Resource</h6>
                            
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-tasks text-primary mb-4"></i>
                            <h6 class="mb-3">Project Management</h6>
                        
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-chart-line text-primary mb-4"></i>
                            <h6 class="mb-3">Business Development</h6>
                         
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-hands-helping text-primary mb-4"></i>
                            <h6 class="mb-3">Sales & Communication</h6>
                          
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-book-reader text-primary mb-4"></i>
                            <h6 class="mb-3">Teaching & Education</h6>
                        
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item rounded p-4" href="job-list.php">
                            <i class="fa fa-3x fa-drafting-compass text-primary mb-4"></i>
                            <h6 class="mb-3">Design & Creative</h6>
                       
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-6 text-start">
                                <img class="img-fluid w-100" src="img/about-1.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid" src="img/about-2.jpg" style="width: 85%; margin-top: 15%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid" src="img/about-3.jpg" style="width: 85%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">We Help To Get The Best Job And Find A Talent</h1>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet
                            diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                            dolore erat amet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-1">
                                <h6 class="mt-n1 mb-0">Featured</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill"
                                href="#tab-2">
                                <h6 class="mt-n1 mb-0">Full Time</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                                href="#tab-3">
                                <h6 class="mt-n1 mb-0">Part Time</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <?php
                            $show = $job->showJobFeater();
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
                                                    <a class="btn btn-primary" href="job-detail.php?jobId=<?= $item['id'] ?>">Apply Now</a>
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
                            <a class="btn btn-primary py-3 px-5" href="job-list.php">Browse More Jobs</a>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                        <?php
                            $show = $job->showAllJobByFullTime();
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
                                                    <a class="btn btn-primary" href="job-detail.php?jobId=<?= $item['id'] ?>">Apply Now</a>
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
                            <a class="btn btn-primary py-3 px-5" href="job-list.php">Browse More Jobs</a>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                        <?php
                            $show = $job->showAllJobByPartTime();
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
                                                    <a class="btn btn-primary" href="job-detail.php?jobId=<?= $item['id'] ?>">Apply Now</a>
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
                            <a class="btn btn-primary py-3 px-5" href="job-list.php">Browse More Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <h1 class="text-center mb-5">Advertisment 🎈✨</h1>
                <div class="owl-carousel testimonial-carousel">
                    <?php
                    $showAdv = $class->showAllAdvertisment();
                    if ($showAdv) {
                        $i = 0;
                        while ($result = $showAdv->fetch_assoc()) {
                            $i++;

                            ?>
                            <div class="testimonial-item bg-light rounded p-4">
                                <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                                <p>
                                    <?php echo $result['description'] ?>
                                </p>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid flex-shrink-0 rounded" src="./uploads/<?php echo $result['image'] ?>"
                                        style="width: 50px; height: 50px;">
                                    <div class="ps-3">
                                        <h5 class="mb-1">
                                            <?php echo $result['title'] ?>
                                        </h5>
                                        <small>Profession</small>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Testimonial End -->

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
        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
        <df-messenger
            chat-title="Job-Searching"
            agent-id="cc4f4592-4c34-403e-992e-3425df6168f2"
            language-code="en"
        ></df-messenger>

        <script>
        $(document).ready(function() {
            
            // YOUR CODE (NOT RELATED TO DIALOGFLOW MESSENGER)

            window.addEventListener('dfMessengerLoaded', function (event) {
                $r1 = document.querySelector("df-messenger");
                $r2 = $r1.shadowRoot.querySelector("df-messenger-chat");
                $r3 = $r2.shadowRoot.querySelector("df-messenger-user-input"); //for other mods

                var sheet = new CSSStyleSheet;
                sheet.replaceSync( `div.chat-wrapper[opened="true"] { height: 65% }`);
                $r2.shadowRoot.adoptedStyleSheets = [ sheet ];

                // MORE OF YOUR DIALOGFLOW MESSENGER CODE
            });
        });
        </script>
</body>

</html>