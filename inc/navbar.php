<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <img src="./img/logo.png" width="160px" height="70px">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link">Trang chủ</a>
            <a href="job-list.php" class="nav-item nav-link">Việc làm</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trang</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="testimonial.php" class="dropdown-item">Quảng cáo</a>
                </div>
            </div>
            <a href="about.php" class="nav-item nav-link">Giới thiệu</a>
            <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
            
        </div>
        <?php
        $login_customer = Session::get('login_customer');
        if ($login_customer == true) { ?>
            <span>
                <div class="card-body text-black" style="margin-top: 10px; margin-right: 10px;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <?php
                            if (strpos(Session::get('imageUrl'), "https://") !== false) {
                            ?>
                            <img src="<?php echo Session::get('imageUrl'); ?>" alt="Generic placeholder image"
                                class="img-fluid rounded-circle border border-dark border-3" style="width: 70px;">
                            <?php    
                            } else {
                            ?>
                            <img src="./uploads/<?php echo Session::get('imageUrl'); ?>" alt="Generic placeholder image"
                                class="img-fluid rounded-circle border border-dark border-3" style="width: 70px;">
                            <?php
                            }
                            ?>
                        </div>
                        <div class="flex-grow-1 ms-3">

                            <div class="d-flex flex-row align-items-center mb-2">
                                <p class="mb-0 me-2">
                                    <?php echo Session::get('name') ?>
                                </p>

                            </div>
                            <div>
                                <div >
                                    <button type="button" class="btn btn-outline-dark btn-rounded btn-sm"
                                        data-mdb-ripple-color="dark"><a href="profile.php">Hồ sơ</a></button>
                                    <button type="button" class="btn btn-outline-dark btn-rounded btn-sm"
                                        data-mdb-ripple-color="dark"><a href="?action=logout">Đăng xuất</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </span>

        <?php } else { ?>
            <button type="button" class="btn btn-outline-success"><a href="login.php">Đăng nhập</a></button>&nbsp;&nbsp;
            <button type="button" class="btn btn-outline-success"><a href="signup.php">Đăng ký</a></button>&nbsp;&nbsp;
            <button type="button" class="btn btn-success"><a href="recruiter/login.php" style="color: white;">Đăng tuyển</a></button>&nbsp;&nbsp;
        <?php } ?>
    </div>
</nav>