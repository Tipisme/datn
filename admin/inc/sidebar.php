<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Admin Pro</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="index.php">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="accountmanagement.php">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Account Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="jobmanagement.php">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Job Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                <i class="align-middle" data-feather="bookmark"></i><span class="align-middle">Category</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="addcategory.php">&nbsp;&nbsp;-> Add Category</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="categorylist.php">&nbsp;&nbsp;-> Category Management</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Advertisement
            </li>

            <li class="sidebar-item">
            <a href="#adv" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                  <span class="align-middle">Advertisement</span>
                </a>
                <ul id="adv" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="addadvertise.php">&nbsp;&nbsp;-> Add Advertisement</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="advertiselist.php">&nbsp;&nbsp;-> Advertisement Management</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item">
            <a href="#ban" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                  <span class="align-middle">Banners</span>
                </a>
                <ul id="ban" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="add-banner.php">&nbsp;&nbsp;-> Add Banners</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="banner-management.php">&nbsp;&nbsp;-> Banners Management</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>