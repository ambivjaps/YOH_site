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
            $hashedPwdCheck = password_verify($cust_pass, $user_data['cust_pass']);

            if ($hashedPwdCheck == false){
                echo "<script>alert('Wrong credentials.')</script>";
                exit();

            } else if ($hashedPwdCheck == true) {
                if ($response != "") {
                    $_SESSION['login_id'] = $user_data['login_id'];
                    $_SESSION['user_rank'] = $user_data['user_rank'];
                    $_SESSION['c_id'] = $user_data['c_id'];
                    $_SESSION['cust_name'] = $user_data['cust_name'];

                    header("Location: HomePage.php");
                    exit();
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

if(!empty($_SESSION['cust_id'])) {
    header("location: HomePage.php");
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

<body style="overflow-x:hidden;">
    <main class="page login-page">
        
        <section class="clean-block clean-form dark" style="height: 990.391px; background-color:#efe9ef;">
            <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
                <div class="block-heading"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></div>
                <h2 style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color: var(--bs-indigo); font-weight: bold;">Login</h2>
                <form data-bss-hover-animate="pulse" class="rounded" style="border:none;width: 554px;;height:545px; color: var(--bs-purple); max-width: 753px;"  method="post" >
                <?php if (isset($_GET['registrationSuccess']) && $_GET['registrationSuccess'] === 'true') { ?>
                    <div class="alert alert-success" role="alert">
                        Successfully registered account. Please login.
                    </div>   
                <?php } ?> 
                <?php 
                if (isset($_GET['RecoverSuccess']) && $_GET['RecoverSuccess'] === 'true') { ?>
                    <div class="alert alert-success" role="alert">
                    Email for reset password link sent!  Kindly check your email inbox.
                    </div>   
                <?php } ?> 
                <?php if (isset($_GET['ResetSuccess']) && $_GET['ResetSuccess'] === 'true') { ?>
                    <div class="alert alert-success" role="alert">
                        Password has been successfully reset!
                    </div> 
                <?php } ?> 
                    <div class="mb-3"><label class="form-label" for="email" style=" font-weight:bold; font-size: 20px;color: rgb(111, 66, 193);">Email</label><input class="form-control item" type="text" id="email" name="cust_email" placeholder="Email" required="" style="margin-bottom: 9px;"></div>
                    <div class="mb-3"><label class="form-label" for="password" style=" font-weight:bold; font-size: 20px;color: rgb(111, 66, 193);">Password</label><input class="form-control" type="password" id="password" name="cust_pass" placeholder="Password" required="" style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;"></div>
                    <a href="ForgotPass.php" style="font-size: 18px;margin-left: 145px;margin-top: -8px;margin-bottom: 173px;margin-right: 12px;color: rgb(111,66,193);">Forgot your Password?</a>
                    <div></div>
                    <br>
                    <div style="margin-left:80px;">
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                     <div class="g-recaptcha" data-sitekey="6LdarEwkAAAAANs4-E8qkamwsZJYF_-OBWprGpSi"></div> </tr></tr></tr>

                    <br></div>
                    <button class="btn btn-primary" type="submit" style="font-weight: bold; width: 147px; height: auto; margin:auto; display:flex; display:grid; border-color: rgb(119,13,253);background: rgb(119,13,253);">Login</button>
                    <br>
                    <a href="registration.php" style="margin-left: 86px;margin-top: -8px;margin-bottom: 173px;margin-right: 12px;color: rgb(111,66,193);">Don't have an account? Register Here</a>
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