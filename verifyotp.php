<?php 
session_start();
include("includes/dbh.inc.php");

if(isset($_POST["verify"])){
    include("includes/dbh.inc.php");

    $token = $_SESSION['token'];
    $email = $_SESSION['cust_email'];
    $otp_code = $_POST['otp_code'];
    $query = "SELECT * FROM register WHERE cust_email = '$email'";
        $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);

        if($res["otp"] != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
            
    }else{
        mysqli_query($connect, "UPDATE register SET status = 1 WHERE cust_email = '$email'");
        ?>
         <script>
               window.location.replace("Login.php?VerifySuccess=true");
         </script>
         <?php
    }
}   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Account Verification | Yarn Over Hook </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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

<body>
<main class="page login-page">
        <section class="clean-block clean-form dark" style="height: 990.391px; background-color:#efe9ef; ">
            <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
                <div class="block-heading"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></div>
                <h2 style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color:black;;">Account Verification</h2>
                    <form action="" method="POST" name="VerifyOtp" class="border rounded justify-content-center" data-bss-hover-animate="pulse" style="width: 554px;max-width: 753px;margin-bottom: 41px;margin-left: 374px;margin-right: 404px;margin-top: 20px;min-width: 205px;color: var(--bs-purple);background: #ffffff;--bs-body-bg: var(--bs-indigo);box-shadow: 0px 0px var(--bs-indigo);--bs-info: #e03b80;--bs-info-rgb: 224,59,128;height: 221px;">
                    <div class="mb-3"><label class="form-label" for="email" style="color: rgb(111, 66, 193);">Enter OTP</label><input class="form-control item" type="text" id="otp" name="otp_code" placeholder="OTP" required autofocus style="margin-bottom: 9px;"></div>
                    <div class="mb-3"></div>
                    <div class="mb-3"></div>
                    <button class="btn btn-primary" type="submit" value="verify" name="verify" style="margin-left: 162px;min-width: 133px;max-width: 180px;margin-bottom: 10px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 38px;margin-top: 3px;width: 147px;">Submit OTP</button>
                </form>
        </section>
    </main>  
         
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/vanilla-zoom.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
</body>

</html>

