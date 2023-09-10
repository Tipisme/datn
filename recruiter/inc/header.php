<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="../uploads/<?= Session::get('imageUrl') ?  Session::get('imageUrl') : "59b96b9734.png" ?>" class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" /> <span class="text-dark">
                        <?php echo Session::get('name') ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="profile.php"><i class="align-middle me-1"
                            data-feather="user"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?action=logout">Log out</a>

                </div>
            </li>
        </ul>
    </div>
</nav>