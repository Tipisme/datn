<?php
include __DIR__ . '/classes/Account.php';
?>

<?php
$class = new Account();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $login_check = $class->loginAccount($email, $password);

    $_SESSION['form_data'] = [
        'email' => $email
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/signin-image.jpg" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link">Tạo tài khoản</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Đăng nhập <a href="index.php" style="text-decoration: none; ">
                            </a></h2>
                        <?php
                        if (isset($login_check)) {
                            echo $login_check;
                        }
                        ?>
                        <form method="POST" action="login.php" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="your_name" placeholder="Email"
                                    value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Ghi nhớ tài khoản</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/auth.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>