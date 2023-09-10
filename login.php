<?php
include __DIR__ . '/classes/Account.php';
include __DIR__ . '/google-login/config.php';
require __DIR__ . '/facebook-login/vendor/autoload.php';
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


<?php
// Login Google 

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);


        $_SESSION['access_token'] = $token['access_token'];


        $google_service = new Google_Service_Oauth2($google_client);


        $data = $google_service->userinfo->get();

        $login_google = $class->loginGoogle($data['given_name'], $data['family_name'], $data['email'], $data['picture']);
    }
}

?>


<?php
//initialize facebook sdk
$fb = new Facebook\Facebook([
    'app_id' => '827368992220575',
    // your app id
    'app_secret' => '986dbcad3f9bc01dd42d917f96d62675',
    // your app secret
    'default_graph_version' => 'v2.5',
]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\facebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();
        $fbid = $profile->getProperty('id'); // To Get Facebook ID
        $fbfullname = $profile->getProperty('name'); // To Get Facebook full name
        $fbemail = $profile->getProperty('email'); //  To Get Facebook email
        $fbpic =  $picture['url'];
        # save the user nformation in session variable
        $login_facebook = $class->loginFacebook( $fbid, $fbfullname, $fbemail, $fbpic);
    }
} else {
    // replace  website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and used            
    $loginUrl = $helper->getLoginUrl('http://localhost/topcv/login.php', $permissions);
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
                        <div class="social-login">
                            <span class="social-label">Hoặc đăng nhập với</span>
                            <ul class="socials">
                                <li><a href="<?= $loginUrl ?>"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="<?= $google_client->createAuthUrl() ?>"><i
                                            class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
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