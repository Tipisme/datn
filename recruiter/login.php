<?php 
   include '../classes/Account.php';
?>

<?php 
    $class = new Account();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = md5($_POST['password']);

      $login_check = $class->loginRecruiterAccount($email, $password);

      $_SESSION['form_data'] = [
        'email' => $email
    ];
}

// Check if form data exists in session
if(isset($_SESSION['form_data'])) {
    $form_data = $_SESSION['form_data'];
    unset($_SESSION['form_data']); // Remove form data from session
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="asset-login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="asset-login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset-login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="asset-login/css/style.css">

    <title>Đăng nhập</title>
</head>

<body>


    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 py-5">
                        <h3>Đăng nhập tài khoản Nhà tuyển dụng <a href="/topcv/index.php" style="text-decoration: none;"></a></h3>
                        <p class="mb-4">Bạn vẫn chưa có tài khoản? <a href="signup.php">Đăng ký ngay</a></p>
                        </p>
                        <br>
                        <?php 
                        if(isset($login_check)) {
                          echo $login_check;
                        }
                        ?>
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="e.g. john@your-domain.com"
                                            id="email" value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group first">
                                        <label for="email">Mật khẩu</label>
                                        <input type="password" class="form-control"
                                            placeholder="Your password" name="password" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mb-5 mt-4 align-items-center">
                                <div class="d-flex align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Ghi nhớ mật khẩu.</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            </div>

                            <input type="submit" value="Đăng nhập" class="btn px-5 btn-primary">
                    </div>



                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>



    <script src="asset-login/js/jquery-3.3.1.min.js"></script>
    <script src="asset-login/js/popper.min.js"></script>
    <script src="asset-login/js/bootstrap.min.js"></script>
    <script src="asset-login/js/main.js"></script>
</body>

</html>