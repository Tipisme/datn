<?php
include '../lib/session.php';
Session::checkSessionRecruiter();
include '../classes/Company.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>


<?php
$class = new Company();
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $description = $_POST['description'];
    $userId = $_POST['userId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $insert = $class->insertCompany($userId,$name, $description, $email, $phone, $_FILES);
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

                    <h1 class="h3 mb-3">Company</h1>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Add Company</h5>
                                <h6 class="card-subtitle text-muted">Add new company in system.</h6>
                            </div>
                            <div class="card-body">
                            <?php 
                                if(isset($insert)) {
                                    echo $insert;
                                }
                                ?>
                                <form action="addcompany.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="userId" value="<?= Session::get('userId') ?>" />
                                    <div class="mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control" placeholder="Ex: Asus Company" name='name' required
                                             />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="Ex: Recrutiment for company,...." rows="1" style="height: 65px" name='description' required
                                            ></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Uppload Logo</label>
                                        <input class="form-control" type="file" name='image' required/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company Email</label>
                                        <input type="email" class="form-control" placeholder="Ex: your-email@gmail.com" name='email' required
                                             />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company Phone</label>
                                        <input type="text" class="form-control" placeholder="Ex: 0987654321" name='phone' required
                                             />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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