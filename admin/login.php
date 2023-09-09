<?php 
    include '../classes/AdminLogin.php';
?>
<?php 
    $class = new AdminLogin();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $adminUser = $_POST['adminUser'];
      $adminPass = md5($_POST['adminPass']);

      $login_check = $class->loginAdmin($adminUser, $adminPass);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="./asset/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./asset/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="./asset/images/signin-image.jpg" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Admin Login</h2>
                        <span style="color: red;">
                        <?php 
                        if(isset($login_check)) {
                          echo $login_check;
                        }
                        ?>
                        </span>
                        <br>
                        <form method="POST" action="login.php" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="adminUser" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="adminPass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="./asset/vendor/jquery/jquery.min.js"></script>
    <script src="./asset/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>