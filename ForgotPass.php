<?php 
session_start();

include("includes/dbh.inc.php");
include("includes/functions.inc.php");

    function send_password_reset($email, $token){

        require "phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        // YOH account
        $mail->Username='slightlylimited0018@gmail.com';
        $mail->Password='rmhlupihisommzsw';

        // send by business email
        $mail->setFrom('slightlylimited0018@gmail.com', 'Password Reset');
        // get email from input
        $mail->addAddress($_POST["cust_email"]);

        // HTML body
        $mail->isHTML(true);
        $mail->Subject="Recover your password";
        $mail->Body="<b>Dear User,</b>
        <h3>We received a request to reset your password.</h3>
        <p>Kindly click the below link to reset your password</p>
        <a href='https://yarnoverhook.online/ResetPass.php?token=$token&email=$email'>Reset Password </a>
        <br><br>
        <p>With regards,</p>
        <b>YarnOverHook</b>";

        if(!$mail->send()){
            ?>
                <script>
                    alert("<?php echo " Invalid Email "?>");
                </script>
            <?php
        }else{
            ?>
                <script>
                    window.location.replace("Login.php?RecoverSuccess=true");
                </script>
            <?php
        }

    }

    if(isset($_POST["recover"])){
        include("includes/dbh.inc.php");
        $email = $_POST["cust_email"];

        $sql = mysqli_query($connect, "SELECT * FROM register WHERE cust_email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);


          if(mysqli_num_rows($sql) <= 0){
            header("Location: ForgotPass.php?error=true");
        return;
        }else{
            // generate token by binaryhexa 
            $token = random_num(30);
            $verify_token = "UPDATE register SET verify_token ='$token' WHERE cust_email='$email' LIMIT 1";
            $verify_run = mysqli_query($connect, $verify_token);
            if($verify_run){

                send_password_reset($email, $token);

            }
            //session_start ();

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
    <title> Reset Password | Yarn Over Hook </title>
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
                <h2 style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color: var(--bs-indigo); font-weight: bold;">Reset Password</h2>
                    <form action="" method="POST" name="ForgotPass" class="border rounded justify-content-center" data-bss-hover-animate="pulse" style="width: 554px;max-width: 753px;margin-bottom: 41px;margin-left: 374px;margin-right: 404px;margin-top: 20px;min-width: 205px;color: var(--bs-purple);background: #ffffff;--bs-body-bg: var(--bs-indigo);box-shadow: 0px 0px var(--bs-indigo);--bs-info: #e03b80;--bs-info-rgb: 224,59,128;height: 221px;">
                    <div class="mb-3"><label class="form-label" for="email" style="color: rgb(111, 66, 193); font-weight:bold;">Email</label><input class="form-control item" type="text" id="email_address" name="cust_email" placeholder="Email" required autofocus style="margin-bottom: 9px;"></div>
                    <?php 
                    if (isset($_GET['error']) && $_GET['error'] === 'true') { ?>
                        <p style="font-weight:bold;color:red;text-align:center;"> This email address does not exist!</p>
                             
                    <?php } ?>
                    <button class="btn btn-primary" type="submit" value="Recover" name="recover" style="width:150px;background: indigo;border-color:indigo;font-weight:bold;">Send Code</button>
                    <a class="btn btn-primary border rounded" role="button" href="Login.php" style="width:150px; font-weight:bold;background: red;border-color:red; color:white;">Cancel</a>
                </form>
                
                </div>
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
