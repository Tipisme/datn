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
if($_GET['comId'] != null || isset($_GET['comId'])) {
    $id = $_GET['comId'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $description = $_POST['description'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $insert = $class->updateCompany($id, $name, $description, $email, $phone, $_FILES);
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
                                <?php
                                    $companyList = $class->showCompanyById($id);
                                    if ($companyList) {
                                                while ($c = $companyList->fetch_assoc()) {
                                            ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control" placeholder="Ex: Asus Company" value="<?=  $c['companyName'] ?  $c['companyName']  : "" ?>" name='name' required
                                             />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="Ex: Recrutiment for company,...." rows="1" style="height: 65px" name='description' required
                                            ><?=  $c['description'] ?  $c['description']  : "" ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Uppload Logo</label><br>
                                        <img class="flex-shrink-0 img-fluid border rounded" src="../uploads/<?php echo $c['image'] ?>"
                                                    alt="" style="width: 80px; height: 80px;">
                                        <input class="form-control" type="file" name='image' />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company Email</label>
                                        <input type="email" class="form-control" placeholder="Ex: your-email@gmail.com" value="<?=  $c['companyEmail'] ?  $c['companyEmail']  : "" ?>" name='email' required
                                             />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company Phone</label>
                                        <input type="text" class="form-control" placeholder="Ex: 0987654321" value="<?=  $c['companyPhone'] ?  $c['companyPhone']  : "" ?>" name='phone' required
                                             />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <?php }} ?>
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