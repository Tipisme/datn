<?php
include '../lib/session.php';
Session::checkSession();
include '../classes/Category.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php 
    $class = new Category();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $catName = $_POST['catName'];

      $insert = $class->insertCategory($catName);
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
</head>

<body>
    <div class="wrapper">
        <?php include('./inc/sidebar.php') ?>

        <div class="main">
            <?php include('./inc/header.php') ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Danh mục</h1>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Thêm danh mục</h5>
                                <h6 class="card-subtitle text-muted">Thêm một danh mục mới vào hệ thống.</h6>
                            </div>
                            <div class="card-body">
                                <?php 
                                if(isset($insert)) {
                                    echo $insert;
                                }
                                ?>
                                <form method="POST" action="addcategory.php">

                                    <div class="mb-3">
                                        <label class="form-label">Tên danh mục</label>
                                        <input type="text" class="form-control" name="catName" placeholder="Tên danh mục">
                                    </div>
                            
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php include('./inc/footer.php') ?>
        </div>
    </div>

    <script src="./asset/js/app.js"></script>

</body>

</html>