<?php
include '../lib/session.php';
Session::checkSession();
include '../classes/Job.php';
include '../classes/Category.php';
include '../classes/User.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php
$class = new Job();
if(isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $remove = $class->removeForJob($id);
  }

if(isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $approve = $class->approveForJob($id);
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

                    <h1 class="h3 mb-3">Việc làm</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Quản lý việc làm</h5>
                                    <h6 class="card-subtitle text-muted">Hiển thị tất cả việc làm.
                                </div>
                                <div class="card-body">
                                    <div id="datatables-multi_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row dt-row">
                                            <div class="col-sm-12">
                                                <?php
                                                if (isset($remove)) {
                                                    echo $remove;
                                                }
                                                if (isset($approve)) {
                                                    echo $approve;
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
                                                                STT</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Tiêu đề</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Địa chỉ</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Level</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Danh mục</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Tên nhà tuyển dụng</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Đồng ý</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending">
                                                                Xóa</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatables-multi" rowspan="1" colspan="1"
                                                                style="width: 46px;"
                                                                aria-label="Office: activate to sort column ascending">
                                                                Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $show = $class->showAllJob();
                                                        if ($show) {
                                                            $i = 0;
                                                            while ($result = $show->fetch_assoc()) {
                                                                $i++;

                                                                ?>
                                                                <tr class="odd">
                                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                                        <?php echo $i ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result['title'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result['address'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result['level'] ?>
                                                                    </td>
                                                                    <?php
                                                                    $cat = new Category();
                                                                    $catList = $cat->getCateById($result['categoryId']);

                                                                    if ($catList) {
                                                                        while ($c = $catList->fetch_assoc()) {
                                                                            ?>
                                                                            <td><?php echo $c['catName'] ?></td>
                                            
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>


                                                                    
                                                                    <td>
                                                                        <?php 
                                                                        $user = new User();
                                                                        $userById = $user->getAccountById($result['userId']);
                                                                        if ($userById) {
                                                                            while ($u = $userById->fetch_assoc()) {
                                                                                echo $u['name'];
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($result['is_approve']) && $result['is_approve'] == true) {
                                                                            ?>
                                                                            <button type="button"
                                                                                class="btn btn-outline-success">Đã chấp thuận</button>
                                                                        <?php } else { ?>
                                                                            <button type="button"
                                                                                class="btn btn-outline-success"><a href="?approve=<?php echo $result['id'] ?>" onclick="return confirm('Bạn có muốn chấp thuận công việc này?')" style="text-decoration: none; color: #1cbb8c;">Chấp thuận</a></button>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($result['is_remove']) && $result['is_remove'] == true) {
                                                                            ?>
                                                                            <button type="button"
                                                                                class="btn btn-outline-danger">Đã xóa</button>
                                                                        <?php } else { ?>
                                                                            <button type="button"
                                                                                class="btn btn-outline-danger"><a href="?remove=<?php echo $result['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" style="text-decoration: none; color: red;">Xóa</a></button>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="table-action">
                                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Xem chi tiết">📃</a>
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