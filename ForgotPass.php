<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Reset Password | Yarn Over Hook </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/Animated-Pretty-Product-List-v12-Animated-Pretty-Product-List.css">
    <link rel="stylesheet" href="assets/css/Login-with-overlay-image.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="page login-page">
        <section class="clean-block clean-form dark" style="height: 990.391px; background-color:#efe9ef; ">
            <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
                <div class="block-heading"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></div>
                <h2 style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color:black;;">Reset Password</h2>
                <form class="border rounded justify-content-center" data-bss-hover-animate="pulse" style="width: 554px;max-width: 753px;margin-bottom: 41px;margin-left: 374px;margin-right: 404px;margin-top: 20px;min-width: 205px;color: var(--bs-purple);background: #ffffff;--bs-body-bg: var(--bs-indigo);box-shadow: 0px 0px var(--bs-indigo);--bs-info: #e03b80;--bs-info-rgb: 224,59,128;height: 334px;">
                    <div class="mb-3"><label class="form-label" for="email" style="color: rgb(111, 66, 193);">Email</label><input class="form-control item" type="email" id="email" name="Email" placeholder="Email" required="" style="margin-bottom: 9px;"></div>
                    <div class="mb-3"></div>
                    <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="margin-left: 162px;min-width: 133px;max-width: 180px;margin-bottom: 10px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 38px;margin-top: 3px;width: 147px;">Send Code</button><a class="btn btn-primary border rounded" role="button" href="Login.php" style="margin: -414px 195px -254px 356px;margin-left: 463px;min-width: 0px;max-width: none;margin-bottom: -254px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 32px;margin-top: -583px;width: 35px;">X</a><button class="btn btn-primary" type="submit" style="margin-left: 162px;min-width: 133px;max-width: 180px;margin-bottom: 14px;margin-right: 189px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 38px;margin-top: 64px;width: 147px;">Confirm</button>
                    <div class="mb-3" style="margin-bottom: 35px;margin-top: -136px;"><label class="form-label" for="email" style="color: rgb(111, 66, 193);text-align: center;margin-bottom: -1px;">Verification Code</label><input class="form-control item" type="email" id="email-1" name="Email" placeholder="Email" required="" style="margin-bottom: 9px;"></div>
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