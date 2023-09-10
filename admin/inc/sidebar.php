<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Admin</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Trang
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="index.php">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Tổng quan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="accountmanagement.php">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Quản lý tài khoản</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="jobmanagement.php">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Quản lý công việc</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                <i class="align-middle" data-feather="bookmark"></i><span class="align-middle">Danh mục</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="addcategory.php">&nbsp;&nbsp;-> Thêm danh mục</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="categorylist.php">&nbsp;&nbsp;-> Quản lý danh mục</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Quảng cáo
            </li>

            <li class="sidebar-item">
            <a href="#adv" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                  <span class="align-middle">Quảng cáo</span>
                </a>
                <ul id="adv" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="addadvertise.php">&nbsp;&nbsp;-> Thêm quảng cáo</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="advertiselist.php">&nbsp;&nbsp;-> Quản lý quảng cáo</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Banners
            </li>

            <li class="sidebar-item">
            <a href="#ban" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                  <span class="align-middle">Banners</span>
                </a>
                <ul id="ban" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="add-banner.php">&nbsp;&nbsp;-> Thêm Banners</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="banner-management.php">&nbsp;&nbsp;-> Quản lý banners</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>