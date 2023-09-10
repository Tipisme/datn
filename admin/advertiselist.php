<?php
include '../lib/session.php';
Session::checkSession();
include '../classes/Advertisement.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php 
    $class = new Advertisement();
    if(isset($_GET['delId'])) {
        $id = $_GET['delId'];
        $delete = $class->deleteAdvertisementById($id);
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
                                                                aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending">
                                                                Serial No.</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Advertisement Name</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Description</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending" style="width: 200px">
                                                                Image</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 36px;"
                                                                aria-label="Office: activate to sort column ascending" >
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $showAdv = $class->showAllAdvertisment();
                                                        if($showAdv) {
                                                            $i = 0;
                                                            while($result = $showAdv->fetch_assoc()){
                                                                $i++;
                                                        
                                                        ?>
                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1" tabindex="0"><?php echo $i ?>
                                                            </td>
                                                            <td><?php echo $result['title'] ?></td>
                                                            <td><?php echo $result['description'] ?></td>
                                                            <td><img src="../uploads/<?php echo $result['image'] ?>" style="width: 30%"></td>
                                                            <td class="table-action">
												                <a href="editadvertise.php?advId=<?php echo $result['id']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
												                <a href="?delId=<?php echo $result['id']?>" onclick="return confirm('Are you want to delete?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
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