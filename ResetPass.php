<?php session_start() ;
include("includes/dbh.inc.php");


if(isset($_POST["reset"])){
        

        include('includes/dbh.inc.php');
        $psw = $_POST["cust_pass"];
        $cpsw = $_POST["conf_pass"];
        
        $token = $_SESSION['token'];
        $Email = $_SESSION['cust_email'];


        $sql = mysqli_query($connect, "SELECT * FROM register WHERE cust_email='$Email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        

          $hash = password_hash( $psw , PASSWORD_BCRYPT );
        if($Email){
            $new_pass = $hash;
            if($psw != $cpsw) {
           ?>
            <script>
                a(); 
            </script>
           <?php
        }else if(!$psw >= 8 && !$cpsw >= 8){
            ?>
            <script>
                b();
            </script>
            <?php
        }else if($psw == 0 && $cpsw == 0){
            ?>
            <script>
                c();
            </script>
            <?php
         }else{
            mysqli_query($connect, "UPDATE register SET cust_pass='$new_pass' WHERE cust_email='$Email'");
            ?>
            <script>
                 window.location.replace("Login.php?ResetSuccess=true");
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
    <link rel="stylesheet" href="assets/css/LoginOverlay.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">

    <style>
        #myModal2 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0,0,0,0.4);
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
	
    <main class="page login-page">
        <section class="clean-block clean-form dark" style="height: 980.391px; background-color:#efe9ef;">
            <div class="container" style="--bs-primary: #fd0d72;--bs-primary-rgb: 253,13,114;--bs-body-bg: #ffffff;">
                <div class="block-heading"><a href="homepage.php"><img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png"></a></div>
                <h2 class="text-info" style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color: var(--bs-indigo);">Reset Password</h2>
                <form data-bss-hover-animate="pulse" style="width: 554px;max-width: 753px;margin-bottom: 41px;min-height: 280px;margin-left: 374px;margin-right: 404px;margin-top: 20px;min-width: 205px;color: var(--bs-purple);
                background: #ffffff;--bs-body-bg: var(--bs-indigo);box-shadow: 0px 0px var(--bs-indigo);--bs-info: #e03b80;--bs-info-rgb: 224,59,128;height: 296px;" id="ResetPass" action="" method="post" >
                    
                    <div class="mb-3">
                        <label class="form-label" for="password" style="color: rgb(111, 66, 193);">New Password</label>
                        <input class="form-control" type="password" id="password" name="cust_pass" placeholder="Password" required  style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password" style="color: rgb(111, 66, 193);">Re-type Password</label>
                        <input class="form-control" type="password" id="password" name="conf_pass" placeholder="Confirm Password" required  style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <button class="btn btn-primary" id="changepass" type="submit" name="reset" style="margin-left: 162px;min-width: 133px;max-width: 180px;margin-bottom: 10px;margin-right: 195px;padding-left: 0px;padding-right: 0px;padding-top: 4px;padding-bottom: 4px;height: 32px;width: 147px;">
                        Reset Password
                    </button>
                </form>
            </div>
        </section>
        <div id="myModal2" class="modal">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Password has been reset!</p>
                <p style="text-align:center;">You will now be redirected to Login</p>
                <div class="modal-footer">
                    <button id="okBtn">OK</button>
                </div>
            </div>
        </div>

        <div id="myModal3" class="modal">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Unable to Reset Password!</p>
                <p style="text-align:center;" id="error-message"></p>
                <div class="modal-footer">
                    <button id="errorBtnClode">OK</button>
                </div>
            </div>
        </div>
        <script>
        var btn = document.getElementById("changepass");
        var modal = document.getElementById("myModal2");
        var modalError = document.getElementById("myModal3");
        var modal4 = document.getElementById("myModal4");
        var okBtn = document.getElementById("okBtn");
        var errorBtn = document.getElementById("errorBtnClode");
        
        okBtn.onclick = function() {
            modal.style.display = none;
            window.location.href = "Login.php";
        }
    
        errorBtn.onclick = function() {
            modalError.style.display = "none";
        }
    
        btn.onclick = function() {
            let fields = {
                'cust_pass': 'New Password',
                'conf_pass': 'Re-type Password',
            }
            for (const key in fields) {
                
                    if (document.getElementsByName(key)[0].value.length === 0) {
                        var c = function(){
                        document.getElementById('error-message').innerHTML = fields[key] + ' is required';
                        modalError.style.display = "block";
                        
                    }
                    return c();
                }
               
                if(document.getElementsByName('cust_pass')[0].value.length < 8 || document.getElementsByName('cust_pass')[0].value.length < 8) {
                    var b = function(){
                    document.getElementById('error-message').innerHTML = 'The password must have atleast 8 characters';
                    modalError.style.display = "block";
                    
                }
                return b();
            }
                
                if (document.getElementsByName('cust_pass')[0].value !== document.getElementsByName('conf_pass')[0].value) {
                    var a = function(){
                    document.getElementById('error-message').innerHTML = 'The password does not match';
                    modalError.style.display = "block";
                    
                }
                return a();
            }
                else {
                    return ;
                }
        }
    }      
        
    
            document.getElementById('ResetPass').submit
     </script>
    </main>
    <script src="assets/js/DesignB.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/DesignA.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/DesignAnimation.js"></script>
</body>

</html>
