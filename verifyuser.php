<?php 
session_start();
include("includes/dbh.inc.php");

$email = null; 	
$email_error1 = null; 
$email_error2 = null; 

if(isset($_POST['submit'])){
    include("includes/dbh.inc.php");
    $email = $connect->real_escape_string($_POST['cust_email']);
    $result = $connect->query("select * from register where cust_email = '$email';");

    if(empty(trim($email))){
        $email_error1 = "Email field is empty";
     }else if($result->num_rows){
        $_SESSION['cust_email']=$email;
        $otp = rand(111111, 999999);
        $connect->query("update register set otp = $otp where cust_email = '$email';");
        
    require "phpmailer/PHPMailerAutoload.php";

    $token = bin2hex(random_bytes(50));

    //session_start ();
    $_SESSION['token'] = $token;

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='slightlylimited0018@gmail.com';
    $mail->Password='rmhlupihisommzsw';
    $mail->setFrom('slightlylimited0018@gmail.com', 'Account Verification');
    $mail->addAddress($email);

    // HTML body
    $mail->isHTML(true);
    $mail->Subject="Verify Account";
    $mail->Body="<b>Dear User</b>
    <h3>We received a request to verify your account.</h3>
    <p>Kindly enter the One-time Password below.</p>
    $otp
    <br><br>
    <p>With regards,</p>
    <b>YarnOverHook</b>";
    $mail->send();
    if($mail->send()){
        ?>
            <script>
                window.location.replace("verifyotp.php")
            </script>
        <?php
    }
}else if(!$result->num_rows){
    $email_error2 = "Email does not belong to a registered user.";
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
    <?php
   if($email_error1 != null){
      ?> <style>.email-error1{display:block}</style> <?php
   }
   if($email_error2 != null){
      ?> <style>.email_error2{display:block}</style> <?php
   }
?>
</head>

<body>
<main class="page login-page">
        <section class="clean-block clean-form dark" style="height: 990.391px; background-color:#efe9ef; ">
            <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
                <div class="block-heading"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></div>
                <h2 style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color: var(--bs-indigo); font-weight: bold;">Account Verification</h2>
                <div class="container email-container">
                    <form action="" method="POST" name="EmailOTP" class="border rounded justify-content-center" data-bss-hover-animate="pulse" style="width: 554px;max-width: 753px;margin-bottom: 41px;margin-left: 374px;margin-right: 404px;margin-top: 20px;min-width: 205px;color: var(--bs-purple);background: #ffffff;--bs-body-bg: var(--bs-indigo);box-shadow: 0px 0px var(--bs-indigo);--bs-info: #e03b80;--bs-info-rgb: 224,59,128;height: 350px;">
                    <div class="alert alert-danger mb-3" role="alert" style="width: 475px;">
                       Account is Unverified. Please enter e-mail to get OTP.
                    </div>  
                    <div class="mb-3"><label class="form-label" for="email" style="color: rgb(111, 66, 193);">Email</label><input class="form-control item" type="text" id="email" name="cust_email" value="<?php echo $email; ?>"placeholder="Email" autofocus style="margin-bottom: 9px;"></div>
                    <p class="error email-error1">
                        <?php echo $email_error1; ?>
                    </p>
                    <p class="error email-error2">
                        <?php echo $email_error2; ?>
                    </p>
                    <div class="mb-3"><a class="btn btn-primary border rounded" role="button" href="Login.php" style="border-color: rgb(119,13,253);background: rgb(119,13,253);margin: -414px 195px -254px 356px;margin-left: 463px;min-width: 0px;max-width: none;margin-bottom: -254px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 32px;margin-top: -640px;width: 35px;font-weight:bold;">X</a></div>
                    <div class="mb-3"></div>
                    <button class="btn btn-primary" type="submit" name="submit" style="margin-left: 162px;min-width: 133px;max-width: 180px;margin-bottom: 10px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 38px;margin-top: 3px;width: 147px; border-color: rgb(119,13,253);background: rgb(119,13,253);Font-weight:bold;">Send Code</button>
                    
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
