<?php
include '../lib/session.php';
Session::checkSessionRecruiter();
include '../classes/User.php';
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}

if (isset($_GET['userId'])) {
    $jobseekerId = $_GET['userId'];
}
?>

<?php
$class = new User();
?>

<?php
// Get form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['title'];
    $email = $_POST['email'];
    $message = $_POST['description'];


    // Email body
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message: $message\n";

    // Recipient email address
    $recipient = 'dinhnam.nghiem.2611@gmail.com';

    // Set additional headers
    $headers = "From: Recruiter <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    $mailSent = mail($recipient, $subject, $body, $headers);
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

                    <h1 class="h3 mb-3">Recruitment</h1>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Contact with Jobseeker</h5>
                                <h6 class="card-subtitle text-muted">Sendemail contact with Jobseeker about get the job.
                                </h6>
                            </div>
                            <div class="card-body">
                                <span style="color : green;">
                                    <?php
                                    // Check if the email was sent successfully
                                    if (isset($mailSent)) {
                                        echo 'Email sent successfully';
                                    }
                                    ?>
                                </span>
                                <form method="POST" action="">
                                    <?php
                                    $user = new User();
                                    $userById = $user->getAccountById($jobseekerId);
                                    if ($userById) {
                                        while ($u = $userById->fetch_assoc()) {
                                            ?>


                                            <div class="mb-3">
                                                <label class="form-label">Jobseeker Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $u['email'] ?>"
                                                    placeholder="Ex. <jobseeker>@gmail.com">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Jobseeker Name</label>
                                                <input type="text" class="form-control" name="name" value="<?= $u['name'] ?>"
                                                    placeholder="Ex. Son Dinh">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Subject</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Ex. Apply get the job">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description"
                                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>

                                        <?php }
                                    } ?>

                                    <button type="submit" class="btn btn-primary">Submit</button>
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