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
    $time = $_POST['time'];
    $deadline = $_POST['deadline'];
    $language = $_POST['language'];
    $companyId = $_POST['company'];

    $add_job = $class->addJob($title, $typeOfCv, $level, $address, $minSalary, $maxSalary, $description, $requireJob, $welfare, $userId, $categoryId, $deadline, $language, $time, $companyId);

    $_SESSION['form_data'] = [
        'title' => $title,
        'typesOfCV' => $typeOfCv,
        'level' => $level,
        'address' => $address,
        'minSalary' => $minSalary,
        'maxSalary' => $maxSalary,
        'description' => $description,
        'requireJob' => $requireJob,
        'welfare' => $welfare,
        'categoryId' => $categoryId,
        'deadline' => $deadline,
        'language' => $language
    ];
}

// Check if form data exists in session
if (isset($_SESSION['form_data'])) {
    $form_data = $_SESSION['form_data'];
    unset($_SESSION['form_data']); // Remove form data from session
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

                    <main className="content">
                        <div className="container-fluid p-0">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Add new job</h5>
                                    <h6 class="card-subtitle text-muted">Add new job in system.</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($add_job)) {
                                        echo $add_job;
                                    }
                                    ?>
                                    <form method="POST" action="addjob.php">
                                        <input type="hidden" name="userId"
                                            value="<?php echo Session::get('userId') ?>" />
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputEmail4">Job Title</label>
                                                <input type="text" class="form-control" id="inputEmail4" name='title' placeholder="Ex: Java , Sale Management"  value="<?php echo isset($form_data['title']) ? $form_data['title'] : ''; ?>" required/>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputPassword4">Level</label>
                                                <input type="text" class="form-control" id="inputPassword4"
                                                    name='level' placeholder="Ex: Junior, Senior, ..."  value="<?php echo isset($form_data['title']) ? $form_data['title'] : ''; ?>" required/>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputAddress">Type Of CV</label>
                                            <input type="text" class="form-control" id="inputAddress"
                                                name='typesOfCV' placeholder="Ex: PDF, WORD,..."  value="<?php echo isset($form_data['typesOfCV']) ? $form_data['typesOfCV'] : ''; ?>" required />
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputEmail4">Address</label>
                                                <input type="text" class="form-control" id="inputEmail4"
                                                    name='address' placeholder="Ex: Hoàn Kiếm, Hà Nội"  value="<?php echo isset($form_data['address']) ? $form_data['address'] : ''; ?>" required/>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputEmail4">Language</label>
                                                <input type="text" class="form-control" id="inputEmail4"
                                                    name='language' placeholder="Ex: Tiếng Việt"  value="<?php echo isset($form_data['language']) ? $form_data['language'] : ''; ?>" required/>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputPassword4">Description</label>
                                                <input type="text" class="form-control" id="inputPassword4"
                                                    name='description' placeholder="Ex: Asus Company,....."  value="<?php echo isset($form_data['description']) ? $form_data['description'] : ''; ?>" required/>
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
                                                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
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
                                                    name='minSalary' placeholder="Ex: 100000"  value="<?php echo isset($form_data['minSalary']) ? $form_data['minSalary'] : ''; ?>" required/>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputPassword4">Max Salary</label>
                                                <input type="number" class="form-control" id="inputPassword4"
                                                    name='maxSalary' placeholder="Ex: 1000000"  value="<?php echo isset($form_data['maxSalary']) ? $form_data['maxSalary'] : ''; ?>" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputEmail4">Request</label>
                                                <input type="text" class="form-control" id="inputEmail4"
                                                    name='requireJob' placeholder="Ex: Asus Company,...."  value="<?php echo isset($form_data['requireJob']) ? $form_data['requireJob'] : ''; ?>" required/>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputPassword4">Welfare</label>
                                                <input type="text" class="form-control" id="inputPassword4"
                                                    name='welfare' placeholder="Ex: Asus Company,..."  value="<?php echo isset($form_data['welfare']) ? $form_data['welfare'] : ''; ?>" required/>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputPassword4">Deadline</label>
                                                <input type="datetime-local" class="form-control" id="inputPassword4"
                                                    name='deadline'  value="<?php echo isset($form_data['deadline']) ? $form_data['deadline'] : ''; ?>" required/>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputPassword4">Time Request</label>
                                                <select name="time" class="form-control mb-3">
                                                    <option selected="" value="Full Time">--Chọn--</option>
                                                    <option  value="Full Time">Full Time</option>
                                                    <option  value="Part Time">Part Time</option>
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
                                                            <option value="<?php echo $c['companyId'] ?>"><?php echo $c['companyName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
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