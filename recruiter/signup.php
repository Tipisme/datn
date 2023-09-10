<?php 
   include '../classes/Account.php';
?>

<?php 
    $class = new Account();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $position = $_POST['position'];
      $password = md5($_POST['pass']);
      $re_pass = md5($_POST['re_pass']);

      $register_check = $class->registerRecruiterAccount($name, $email,$phone, $address, $position, $password, $re_pass);

      $_SESSION['form_data'] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'position' => $position
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

    <title>Đăng ký</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 py-5">
            <h3>Đăng ký tài khoản Nhà tuyển dụng với <a href="/topcv/index.php" style="text-decoration: none;"></a></h3>
            <p class="mb-4">Bạn đã có một tai khoản? <a href="login.php">Đăng nhập ngay</a>
            <br>        <?php 
                        if(isset($register_check)) {
                          echo $register_check;
                        }
                        ?>
            <form action="signup.php" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="fname">Họ và Tên</label>
                    <input type="text" class="form-control" placeholder="vd. Nguyễn Văn Tùng" name="name" id="fname" value="<?php echo isset($form_data['name']) ? $form_data['name'] : ''; ?>" required>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="0886647098" name="phone" id="lname" value="<?php echo isset($form_data['phone']) ? $form_data['phone'] : ''; ?>" required>
                  </div>    
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="vd. tung.nv182875@sis.hust.edu.vn" name="email" id="email" value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>" required>
                  </div>    
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="vd. Hoan Kiem, Hà Nội" name="address" id="lname" value="<?php echo isset($form_data['address']) ? $form_data['address'] : ''; ?>" required>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Chức danh</label>
                    <input type="text" class="form-control" placeholder="vd. HR or Sale" name="position" id="lname" value="<?php echo isset($form_data['position']) ? $form_data['position'] : ''; ?>" required>
                  </div>    
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
              
                  <div class="form-group last mb-3">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Mật khẩu của bạn" name="pass" id="password" required>
                  </div>
                </div>
                <div class="col-md-6">
              
                  <div class="form-group last mb-3">
                    <label for="re-password">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="re_pass" id="re-password" required>
                  </div>
                </div>
              </div>
              
              <div class="d-flex mb-5 mt-4 align-items-center">
                <div class="d-flex align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Tạo tài khoản có nghĩa là bạn đồng ý với <a href="#">Điều khoản và Điều kiện</a> và <a href="#">Chính sách quyền riêng tư</a> của chúng tôi.</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
              </div>
              </div>

              <input type="submit" value="Đăng ký" class="btn px-5 btn-primary">

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