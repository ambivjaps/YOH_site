<?php session_start() ;
include("includes/dbh.inc.php");
include("includes/functions.inc.php");
include("includes/access.inc.php");
access('USER');

$errors = array();



if(isset($_POST["cust_email"])){
    $_SESSION['info'] = "";
    
    $email = $_POST['cust_email'];
    $password = $_POST['cust_pass'];
    $npassword = $_POST['new_pass'];
    $cpassword = $_POST['conf_pass'];
    
    $id = $_SESSION['login_id'];
    $sql = mysqli_query($con, "SELECT cust_pass from register where login_id = $id");
    $res = mysqli_fetch_assoc($sql);
    $hashedPwdCheck = password_verify($password, $res['cust_pass']);
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
    
    if(empty($password)){
        $errors['cust_pass'] = "Old Password is Required";
    }else if($hashedPwdCheck == false){
        $errors['cust_pass'] = "Incorrect Old Password.";
    }
    else if(empty($npassword)){
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

            // YOH account
            $mail->Username='slightlylimited0018@gmail.com';
            $mail->Password='rmhlupihisommzsw';

            // send by business email
            $mail->setFrom('slightlylimited0018@gmail.com', 'Password Changed');
            // get email from input
            $mail->addAddress($_POST["cust_email"]);

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Password Changed!";
            $mail->Body="<b>Dear lovely Customer,</b>
            <h3>We noticed that YOUR PASSWORD has been changed. </h3>
            <p>If you didn't change it, reset your password here . </p>
            <a href='https://yarnoverhook.online/ForgotPass.php'>Reset Password</a>
            <br><br>
            <p>With regards,</p>
            <b>YarnOverHook</b>";

            if($mail->send()){
              
                if(isset($_SESSION['login_id']))
                {
                    unset($_SESSION['login_id']);
                    session_destroy();
                }
                
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
    <link rel="stylesheet" href="assets/css/modal.css">

    <style>
        #myModal2 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            top: 30%;
            width: 23%;
            background-color: #fee8e8;
            margin: auto;
            padding: 20px;
        }

        .modal-footer {
            border: none;
        }

        .modal-footer button {
            background-color: white;
            margin: 0 auto;
            border: none;
        }
    </style>

</head>
<body>
    <main class="login-page">
    <section class="clean-block clean-form dark" style="height:1090px; background-color:#efe9ef;">
    <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
    <div class="block-heading"><a href="homepage.php"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></a></div>
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form class="rounded"data-bss-hover-animate="pulse" id="myForm" action="ChangePassword.php" method="POST" autocomplete="off" style="border:none; color: var(--bs-purple);" >
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
                        <input class="form-control" type="text" name="cust_email" placeholder="Enter Email"  required="" style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <div class="form-group">
                    <label class="form-label" for="password" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">Current Password</label>
                        <input class="form-control" type="password" name="cust_pass" placeholder="Enter your current password" minlength="8" required="" style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div><br>
                    <div class="form-group">
                    <label class="form-label" for="password" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">New Password</label>
                        <input class="form-control" type="password" id="password" name="new_pass" placeholder="Create new password" minlength="8" required="" style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <div class="form-group">
                    <label class="form-label" for="password" style="color: rgb(111, 66, 193); font-weight:bold; font-size:20px;">Re-type Password</label>
                        <input class="form-control" type="password" id="confirmPassword" name="conf_pass" placeholder="Confirm your password" minlength="8" required="" style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div><br>
                    <div class="form-group">
                    <input class="form-control button" id="regBtn" type="button" name="update-password" value="Change" style="border-color: rgb(119,13,253); font-weight:bold;background: rgb(119,13,253); color:white;">
                    </div>
                </form>
            </div>
        </section>
        
        <div id="myModal2" class="modal">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Registration complete!</p>
                <p style="text-align:center;">You will now be redirected to Login</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="okBtn" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                </div>
            </div>
        </div>
        
        
                <div id="myModal3" class="modal">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;color:red;font-size:32px;">Unable to register!</p>
                <p style="text-align:center;font-weight:bold;" id="error-message"></p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="errorBtnClode" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                </div>
            </div>
        </div>

        <script>
            const registrationForm = document.querySelector('#myForm')
            const password = document.querySelector('#password')
            const confirmPassword = document.querySelector('#confirmPassword')

            var btn = document.getElementById("regBtn");
            var modal = document.getElementById("myModal2");
            var modalError = document.getElementById("myModal3");
            var modal4 = document.getElementById("myModal4");
            var okBtn = document.getElementById("okBtn");
            var errorBtn = document.getElementById("errorBtnClode");
            
            okBtn.onclick = function() {
                modal.style.display = "none";
                window.location.href = "Login.php";
            }


            errorBtn.onclick = function() {
                modalError.style.display = "none";
            }
            
            btn.onclick = function() {
                const passwordRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                let fields = {
                    
                    'new_pass': 'Password',
                    'conf_pass': 'Retype Password',
                }

                for (const key in fields) {
                    if (document.getElementsByName(key)[0].value.length === 0) {
                        document.getElementById('error-message').innerHTML = fields[key] + ' is required';
                        modalError.style.display = "block";
                        return;
                    }
                }

                if(document.getElementsByName('new_pass')[0].value.length < 8) {
                    document.getElementById('error-message').innerHTML = 'The password must have atleast 8 characters';
                    modalError.style.display = "block";
                    return;
                }

                if (document.getElementsByName('new_pass')[0].value !== document.getElementsByName('conf_pass')[0].value) {
                    document.getElementById('error-message').innerHTML = 'The password does not match';
                    modalError.style.display = "block";
                    return;
                }

                if (!passwordRegex.test(password.value)) {
                    document.getElementById('error-message').innerHTML = 'Invalid password. Password must have at least 8 characters, at least 1 uppercase letter, at least 1 special character, and at least 1 lowercase letter.';
                    modalError.style.display = "block";
                    return
                }
               
            document.getElementById("myForm").submit();
        }
            
           


        </script>
        

    </main>
    <script src="assets/js/DesignB.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/DesignA.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/DesignAnimation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
</body>

</html>
