<?php
include '../lib/session.php';
Session::checkSessionRecruiter();
include '../classes/Recruitment.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php
$recruitment = new Recruitment();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="./asset/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Admin</title>

    <link href="./asset/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
</head>

<body>
    <div class="wrapper">
        <?php include('./inc/sidebar.php') ?>

        <div class="main">
            <?php include('./inc/header.php') ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Recruitment</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Recruitment Management</h5>
                                    <h6 class="card-subtitle text-muted">Show all recruitment in system.
                                </div>
                                <div class="card-body">
                                    <div id="datatables-multi_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row dt-row">
                                            <div class="col-sm-12">
                                            <?php 
                                                if(isset($delete)) {
                                                echo $delete;
                                                }
                                            ?>
                                                <table id="datatables-multi"
                                                    class="table table-striped dataTable no-footer dtr-inline"
                                                    style="width: 100%;" aria-describedby="datatables-multi_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 224px;" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending">
                                                                Serial No.</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 334px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Job Title</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 334px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Jobseeker Name</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 334px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Jobseeker Email</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 334px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Jobseeker Phone</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 36px;"
                                                                aria-label="Office: activate to sort column ascending" >
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $recruitmentList = $recruitment->showAllRecruimentRecruiterId(Session::get('userId'));
                                                            $i = 0;
                                                            if ($recruitmentList) {
                                                            while ($r = $recruitmentList->fetch_assoc()) {
                                                            $i++
                                                        ?>

                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1" tabindex="0">
                                                            <?= $i ?></td>
                                                            <td><a href="job-detail.php?jobId=<?= $r['jobId'] ?>" target="_blank"><?= $r['title'] ?></a></td>

                                                            <td><?= $r['name'] ?></td>
                                                            <td><?= $r['email'] ?></td>
                                                            <td><?= $r['phone'] ?></td>
                                                            <td class="table-action">
                                                                <a href="sendemail.php?userId=<?= $r['jobseekerId'] ?>">
                                                                <i class="align-middle" data-feather="mail"></i>
                                                                </a>
											                </td>
                                                        </tr>
                                                        <?php }}?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php include('./inc/footer.php') ?>
        </div>
    </div>

    <script src="./asset/js/app.js"></script>
    <script src="./asset/js/datatables.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Datatables with Multiselect
            var datatablesMulti = $("#datatables-multi").DataTable({
                responsive: true,
                select: {
                    style: "multi"
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            setTimeout(function () {
                if (localStorage.getItem('popState') !== 'shown') {
                    window.notyf.open({
                        type: "success",
                        message: "Get access to all 500+ components and 45+ pages with AdminKit PRO. <u><a class=\"text-white\" href=\"https://adminkit.io/pricing\" target=\"_blank\">More info</a></u> 🚀",
                        duration: 10000,
                        ripple: true,
                        dismissible: false,
                        position: {
                            x: "left",
                            y: "bottom"
                        }
                    });

                    localStorage.setItem('popState', 'shown');
                }
            }, 15000);
        });
    </script>
</body>

</html>