<?php
include '../lib/session.php';
Session::checkSessionRecruiter();
include '../classes/Job.php';
include '../classes/Category.php';
include '../classes/Company.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<?php
$class = new Job();

if ($_GET['jobId'] != null || isset($_GET['jobId'])) {
    $id = $_GET['jobId'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $typeOfCv = $_POST['typesOfCV'];
    $level = $_POST['level'];
    $address = $_POST['address'];
    $minSalary = $_POST['minSalary'];
    $maxSalary = $_POST['maxSalary'];
    $description = $_POST['description'];
    $requireJob = $_POST['requireJob'];
    $welfare = $_POST['welfare'];
    $userId = $_POST['userId'];
    $categoryId = $_POST['category'];
    $companyId = $_POST['company'];
    $time = $_POST['time'];
    $deadline = $_POST['deadline'];
    $language = $_POST['language'];

    $add_job = $class->updateJob($id, $title, $typeOfCv, $level, $address, $minSalary, $maxSalary, $description, $requireJob, $welfare, $userId, $categoryId, $deadline, $language, $time, $companyId);

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

                    <main className="content">
                        <div className="container-fluid p-0">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Edit info of job</h5>
                                    <h6 class="card-subtitle text-muted">Edit info of job in system.</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($add_job)) {
                                        echo $add_job;
                                    }
                                    ?>


                                    <?php
                                    $getJobById = $class->getJobById($id);
                                    if ($getJobById) {
                                        while ($job = $getJobById->fetch_assoc()) {



                                            ?>
                                            <form method="POST" action="">
                                                <input type="hidden" name="userId"
                                                    value="<?php echo Session::get('userId') ?>" />
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputEmail4">Job Title</label>
                                                        <input type="text" class="form-control" id="inputEmail4" name='title'
                                                            value="<?= $job['title'] ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Level</label>
                                                        <input type="text" class="form-control" id="inputPassword4" name='level'
                                                            value="<?= $job['level'] ?>" required />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputAddress">Type Of CV</label>
                                                    <input type="text" class="form-control" id="inputAddress" name='typesOfCV'
                                                        value="<?= $job['type_of_cv'] ?>" required />
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputEmail4">Address</label>
                                                        <input type="text" class="form-control" id="inputEmail4" name='address'
                                                            value="<?= $job['address'] ?>" required />
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputEmail4">Language</label>
                                                        <input type="text" class="form-control" id="inputEmail4" name='language'
                                                            value="<?= $job['language'] ?>" required />
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Description</label>
                                                        <input type="text" class="form-control" id="inputPassword4"
                                                            name='description' value="<?= $job['description'] ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Danh mục</label>
                                                        <select name="category" class="form-control mb-3">
                                                            <option selected="" value="0">--Chọn--</option>
                                                            <?php
                                                            $cat = new Category();
                                                            $catList = $cat->showAllCategory();

                                                            if ($catList) {
                                                                while ($result = $catList->fetch_assoc()) {
                                                                    ?>
                                                                    <option <?php if ($job['categoryId'] == $result['catId']) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputEmail4">Min Salary</label>
                                                        <input type="number" class="form-control" id="inputEmail4"
                                                            name='minSalary' value="<?= $job['min_salary'] ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Max Salary</label>
                                                        <input type="number" class="form-control" id="inputPassword4"
                                                            name='maxSalary' value="<?= $job['max_salary'] ?>" required />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputEmail4">Request</label>
                                                        <input type="text" class="form-control" id="inputEmail4"
                                                            name='requireJob' value="<?= $job['require_job'] ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Welfare</label>
                                                        <input type="text" class="form-control" id="inputPassword4"
                                                            name='welfare' value="<?= $job['welfare'] ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Deadline</label>
                                                        <input type="date" class="form-control" id="inputPassword4"
                                                            name='deadline' value="<?= $job['deadline'] ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Time Request</label>
                                                        <select name="time" class="form-control mb-3">
                                                            <option selected="" value="<?= $job['time'] ?>">
                                                                <?= $job['time'] ?>
                                                            </option>
                                                            <option value="Full Time">Full Time</option>
                                                            <option value="Part Time">Part Time</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputPassword4">Công Ty</label>
                                                        <select name="company" class="form-control mb-3">
                                                            <option selected="" value="0">--Chọn--</option>
                                                            <?php
                                                            $com = new Company();
                                                            $comList = $com->showAllCompanyByUserId(Session::get("userId"));

                                                            if ($comList) {
                                                                while ($c = $comList->fetch_assoc()) {
                                                                    ?>
                                                                    <option <?= $c['companyId'] == $job['companyId'] ? "selected" : "" ?>  value="<?php echo $c['companyId'] ?>"><?php echo $c['companyName'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>

                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </main>

                </div>
            </main>

            <?php include('./inc/footer.php') ?>
        </div>
    </div>

    <script src="./asset/js/app.js"></script>

</body>

</html>