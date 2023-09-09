<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Recruiter Pro</span>
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
                <a class="sidebar-link" href="recruitment-management.php">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Recruitment Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Job</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="addjob.php">&nbsp;&nbsp;-> Add Job</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="jobmanagement.php">&nbsp;&nbsp;-> Job Management</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#com" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Company</span>
                </a>
                <ul id="com" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" >
                    <li class="sidebar-item"><a class="sidebar-link" href="addcompany.php">&nbsp;&nbsp;-> Add Company</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="companymanagement.php">&nbsp;&nbsp;-> Company Management</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>