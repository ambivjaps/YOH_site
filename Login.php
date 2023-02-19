<?php 
session_start();

include("includes/dbh.inc.php");
include("includes/functions.inc.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cust_email = $_POST['cust_email'];
    $cust_pass = $_POST['cust_pass'];
    $secret_key = "6LdarEwkAAAAANs4-E8qkamwsZJYF_-OBWprGpSi";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$ip";
    $fire = file_get_contents($url);
    $data = json_decode($fire);
    if (!empty($cust_email) && !empty($cust_pass)) {
        $query = "SELECT * FROM register WHERE cust_email = '$cust_email' LIMIT 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['cust_pass'] === $cust_pass) {
                if ($response != "") {
                    $_SESSION['cust_id'] = $user_data['cust_id'];
                    header("Location: HomePage.php");
                    die;
                } else {
                    echo "<script>alert('Captcha verification failed.')</script>";
                }
            } else {
                echo "<script>alert('Wrong credentials.')</script>";
            }
        } else {
            echo "<script>alert('Wrong credentials.')</script>";
        }
    } else {
        echo "<script>alert('Please enter valid information!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Login | Yarn Over Hook </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/LoginOverlay.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body>
    <main class="page login-page">
        
        <section class="clean-block clean-form dark" style="height: 990.391px; background-color:#efe9ef;">
            <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
                <div class="block-heading"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></div>
                <h2 class="text-info" style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color: var(--bs-indigo);">Login</h2>
                <form data-bss-hover-animate="pulse" style="width: 554px;max-width: 753px;margin-bottom: 41px;min-height: 399px;margin-left: 374px;margin-right: 404px;margin-top: 20px;min-width: 205px;color: var(--bs-purple);background: #ffffff;--bs-body-bg: var(--bs-indigo);box-shadow: 0px 0px var(--bs-indigo);--bs-info: #e03b80;--bs-info-rgb: 224,59,128;height: 404px;"  method="post" >
                <?php if (isset($_GET['registrationSuccess']) && $_GET['registrationSuccess'] === 'true') { ?>
                    <div class="alert alert-success" role="alert">
                        Successfully registered account. Please login.
                    </div>   
                <?php } ?> 
                <div class="mb-3"><label class="form-label" for="email" style="color: rgb(111, 66, 193);">Email</label><input class="form-control item" type="text" id="email" name="cust_email" placeholder="Email" required="" style="margin-bottom: 9px;"></div>
                    <div class="mb-3"><label class="form-label" for="password" style="color: rgb(111, 66, 193);">Password</label><input class="form-control" type="password" id="password" name="cust_pass" placeholder="Password" required="" style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;"></div>

                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                     <div class="g-recaptcha" data-sitekey="6LdarEwkAAAAANs4-E8qkamwsZJYF_-OBWprGpSi"></div> 

                    <div class="mb-3"></div><a href="ForgotPass.php" style="margin-left: 145px;margin-top: -8px;margin-bottom: 173px;margin-right: 12px;color: rgb(111,66,193);">Forgot your Password?</a><button class="btn btn-primary" type="submit" style="margin-left: 162px;min-width: 133px;max-width: 180px;margin-bottom: 10px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 32px;margin-top: 82px;width: 147px;">
                    Login</button><a href="registration.php" style="margin-left: 86px;margin-top: -8px;margin-bottom: 173px;margin-right: 12px;color: rgb(111,66,193);">Don't have an account? Register Here</a>
                </form>
            </div>
        </section>
    </main>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/DesignA.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/DesignAnimation.js"></script>

</body>
</html>