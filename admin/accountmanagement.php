<?php
include '../lib/session.php';
Session::checkSession();
include '../classes/Advertisement.php';
include '../classes/User.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php
$class = new User();
if (isset($_GET['lock'])) {
    $id = $_GET['lock'];
    $lock = $class->lockedAccount($id);
}

if (isset($_GET['open'])) {
    $id = $_GET['open'];
    $lock = $class->openAccount($id);
}
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

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

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

                    <h1 class="h3 mb-3">Advertisement</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Advertisement Management</h5>
                                    <h6 class="card-subtitle text-muted">Show all advertisement in system.
                                </div>
                                <div class="card-body">
                                    <div id="datatables-multi_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row dt-row">
                                            <div class="col-sm-12">
                                                <?php
                                                if (isset($lock)) {
                                                    echo $lock;
                                                }
                                                ?>
                                                <table id="datatables-multi"
                                                    class="table table-striped dataTable no-footer dtr-inline"
                                                    style="width: 100%;" aria-describedby="datatables-multi_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending">
                                                                Serial No.</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Account</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Email</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Phone</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Authority</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Lock Account</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $user = new User();
                                                        $showUser = $user->showAllAccount();
                                                        if ($showUser) {
                                                            $i = 0;
                                                            while ($result = $showUser->fetch_assoc()) {
                                                                $i++;

                                                                ?>
                                                                <tr class="odd">
                                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                                        <?php echo $i ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result['name'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result['email'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result['phone'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if ($result['level'] == false) {
                                                                            echo "Jobseeker";
                                                                        } else {
                                                                            echo "Recruiter";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($result['is_locked']) && $result['is_locked'] == true) {
                                                                            ?>
                                                                            <button type="button"
                                                                                class="btn btn-outline-danger"><a
                                                                                href="?open=<?php echo $result['userId'] ?>"
                                                                                onclick="return confirm('Are you want to open this account?')"
                                                                                style="text-decoration: none; color: red;">Locked</a></button>
                                                                        <?php } else { ?>
                                                                            <button type="button" class="btn btn-outline-danger"><a
                                                                                href="?lock=<?php echo $result['userId'] ?>"
                                                                                onclick="return confirm('Are you want to lock this account?')"
                                                                                style="text-decoration: none; color: red;">Lock</a></button>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
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