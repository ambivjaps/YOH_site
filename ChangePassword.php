<?php session_start() ;
include("includes/dbh.inc.php");
$errors = array();

if(isset($_POST["update-password"])){
    $_SESSION['info'] = "";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['cust_email']);
    $password = validate($_POST['cust_pass']);
    $npassword = validate($_POST['new_pass']);
    $cpassword = validate($_POST['conf_pass']);
    $token = $_SESSION['token'];

    if(empty($password)){
        $errors['cust_pass'] = "Old Password is Required";
    }else if(empty($npassword)){
        $errors['new_pass'] = "New Password is Required";
    }
    else if($npassword !== $cpassword){
        $errors['conf_pass'] = "Password does not match";
    }else{
        $id = $_SESSION['login_id'];
        $sql = mysqli_query($con, "SELECT cust_pass from register where login_id = $id");
        $res = mysqli_fetch_assoc($sql);
        $hashedPwdCheck = password_verify($password, $res['cust_pass']);

        if($hashedPwdCheck == true){
        $hash = password_hash( $npassword , PASSWORD_BCRYPT);
        $new_pass = $hash;
        $update_pass = "UPDATE register SET cust_pass = '$new_pass' WHERE cust_email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if($run_query){
            $sql = mysqli_query($connect, "SELECT * FROM register WHERE cust_email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql); 
        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
            </script>
            <?php
        }else{
            $_SESSION['token'] = $token;
            $_SESSION['cust_email'] = $email;

            require "phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='abellanoj@gmail.com';
            $mail->Password='pdifytlnmtyblohw';

            // send by h-hotel email
            $mail->setFrom('abellanoj@gmail.com', 'Password Changed');
            // get email from input
            $mail->addAddress($_POST["cust_email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Password Changed!";
            $mail->Body="<b>Dear lovely Customer,</b>
            <h3>We noticed that YOUR PASSWORD has been changed. </h3>
            <br><br>
            <p>If you didn't change it, reset your password here . </p>
            http://localhost:3000/ResetPass.php
            <br><br>
            <p>With regards,</p>
            <b>YarnOverHook</b>";

            if($mail->send()){
                header('Location:  Login.php?ChangeSuccess=true');
            }
        
        else{
            $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Change Password | Yarn Over Hook </title>
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
    <main class="login-page">
    <section class="clean-block clean-form dark" style="height: 980.391px; background-color:#efe9ef;">
    <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
    <div class="block-heading"><a href="homepage.php"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></a></div>
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form class="rounded"data-bss-hover-animate="pulse" action="ChangePassword.php" method="POST" autocomplete="off" style="border:none; color: var(--bs-purple);" >
                    <h2 class="text-center" style="font-weight: bold;">Change Password</h2>
                    
                    
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <br>
                    <div class="form-group">
                    <label class="form-label" for="email" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">Email</label>
                        <input class="form-control" type="text" name="cust_email" placeholder="Enter Email"  required style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <div class="form-group">
                    <label class="form-label" for="password" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">Current Password</label>
                        <input class="form-control" type="password" name="cust_pass" placeholder="Enter your current password" minlength="8" required style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div><br>
                    <div class="form-group">
                    <label class="form-label" for="password" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">New Password</label>
                        <input class="form-control" type="password" name="new_pass" placeholder="Create new password" minlength="8" required style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <div class="form-group">
                    <label class="form-label" for="password" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">Re-type Password</label>
                        <input class="form-control" type="password" name="conf_pass" placeholder="Confirm your password" minlength="8" required style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div><br>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="update-password" value="Change" style="border-color: rgb(119,13,253); font-weight:bold;background: rgb(119,13,253); color:white;">
                </form>
            </div>
        </section>

    </main>
    <script src="assets/js/DesignB.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/DesignA.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/DesignAnimation.js"></script>
</body>

</html>
