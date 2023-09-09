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
    if($_GET['catId'] != null || isset($_GET['catId'])) {
      $id = $_GET['catId'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $catName = $_POST['catName'];

        $insert = $class->updateCategory($catName, $id);
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
</head>

<body>
    <div class="wrapper">
        <?php include('./inc/sidebar.php') ?>

        <div class="main">
            <?php include('./inc/header.php') ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Category</h1>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Edit Category</h5>
                                <h6 class="card-subtitle text-muted">Edit category in system.</h6>
                            </div>
                            <div class="card-body">
                                <?php 
                                if(isset($insert)) {
                                    echo $insert;
                                }
                                ?>

                                <?php 
                                    $getCateById = $class->getCateById($id);
                                    if ($getCateById) {
                                        while($result = $getCateById->fetch_assoc()){


                                
                                ?>
                                <form method="POST" action="">

                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" class="form-control" name="catName" value="<?php echo $result['catName'] ?>" placeholder="Category Name">
                                    </div>
                            
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <?php }
                                    } ?>
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