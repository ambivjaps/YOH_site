<?php
session_start();

include("includes/dbh.inc.php");
include("includes/functions.inc.php");

if (isset($_POST['cust_name'])) {
    $cust_name = $_POST['cust_name'];
    $cust_email = $_POST['cust_email'];
    $cust_pass = $_POST['cust_pass'];
    $cust_reg = $_POST['cust_reg'];
    $cust_st = $_POST['cust_st'];
    $cust_city = $_POST['cust_city'];
    $cust_brgy = $_POST['cust_brgy'];
    $cust_unit = $_POST['cust_unit'];
    $cust_phone = $_POST['cust_phone'];
    $cust_zip = $_POST['cust_zip'];
    $conf_pass = $_POST['conf_pass'];
    $cust_address = $_POST['cust_address'];
    $user_rank = "user";
    
    $password_hash = password_hash($cust_pass, PASSWORD_BCRYPT);
    
    $login_id =  random_num(10);
    
    // default avatar
    $unique = strtotime("now").'_'.uniqid(rand()).'_';
    
    $default = 'assets/img/default/default_user.jpg';
    $default_name = 'default_user.jpg';
    $saveImage = 'assets/img/upload/avatars/'.$unique.$default_name;
    $copyDefault = copy($default, $saveImage);
    
    $emailquery = "SELECT count(*) as total FROM register WHERE cust_email = '$cust_email'";
    $result = mysqli_query($con, $emailquery);
    if (mysqli_fetch_assoc($result)['total'] > 0) {
        header("Location: registration.php?error=true");
        return;
    }
    
    $query = "insert into register (login_id,cust_name, cust_avatar, cust_email,cust_pass,cust_reg,cust_st,cust_city,cust_brgy,cust_unit,cust_phone,cust_zip, cust_address, cust_status) values
    ('$login_id','$cust_name','$saveImage','$cust_email','$password_hash','$cust_reg','$cust_st','$cust_city','$cust_brgy','$cust_unit','$cust_phone','$cust_zip', '$cust_address', '0')";
    
    $reg = mysqli_query($con, $query);
    if ($reg == 1) {
        $cquery = "insert into cust_profile (c_id,login_id,c_name,c_label,region,street,city,barangay,unit_no,phone_no,zip_code,address,cust_status) values
        ('$login_id','$login_id','$cust_name','Home', '$cust_reg','$cust_st','$cust_city','$cust_brgy','$cust_unit','$cust_phone','$cust_zip','$cust_address','1')";
        $regcust = mysqli_query($con, $cquery);
    }
    header("Location: Login.php?registrationSuccess=true");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Yarn Over Hook</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/ProdListDesign.css.css">
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
    <main class="page registration-page">
        <section class="clean-block clean-form dark" style="height:auto;background-color:#efe9ef; ">
            <div class="container">
                <div class="block-heading">
                    <img style="padding-top: 0px;margin-left: 0px;margin-top: -9px;width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png">
                </div>
                <h2 style="text-align: center;margin-top: -16px;margin-bottom: 25px;font-size: 41px;color: var(--bs-indigo); font-weight: bold;">Registration</h2>
                <?php
                if (isset($_GET['error']) && $_GET['error'] === 'true') { ?>
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-danger text-center w-50" role="alert">
                            Email that you've entered already exists!
                        </div>
                    </div>
                <?php } ?>

                <!-- FORM -->
                <form data-bss-hover-animate="pulse" class="rounded" style="margin:auto;border:none; width: 892px;min-width: 182px;max-width: 1046px;min-height: 656px;height: 547px;color: rgb(111,66,193);" action="" id="myForm" method="post">
                    <div class="mb-3" style="padding-left: -6px;">
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 46px;color: rgb(111,66,193);">
                            Full Name
                            <input class="form-control item" type="text" id="text" name="cust_name" style=" font-weight: bold;width: 289px;margin-bottom: 4px;" required="">
                        </label>
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 148px;padding-left: -6px;color: rgb(111,66,193);">
                            Street
                            <input class="form-control item" type="text" id="text" name="cust_st" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="">
                        </label>
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 42px;color: rgb(111,66,193);">
                            Barangay
                            <input class="form-control item" type="text" id="text" name="cust_brgy" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 46px;color: rgb(111,66,193);">
                            Email Address
                            <input class="form-control item" type="text" id="text" name="cust_email" style="width: 289px;margin-bottom: 4px;" required="">
                        </label>
                        <label class="form-label" for="name" style="font-weight: bold;margin-left: 148px;color: rgb(111,66,193);">
                            Zip Code<br>
                            <input class="form-control item" type="text" id="text" name="cust_zip" style="width: 121px;margin-bottom: 4px;min-width: 76px;" onkeypress="return restrictAlphabets(event)" required="">
                        </label>
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 42px;color: rgb(111,66,193);">
                            Unit No.
                            <input class="form-control item" type="text" id="text" name="cust_unit" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="">
                        </label>
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 44px;color: rgb(111,66,193);margin-top: -17px;margin-bottom: -91px;margin-right: 12px;text-align: left;">
                            <br>Address
                            <textarea class="form-control d-flex d-xxl-flex align-items-start order-1 align-items-xxl-start item" type="text" id="text" name="cust_address" style="resize:none; margin: -3px; margin-bottom:-35px; margin-left:3px; width:725px;height:105px;" required="">
                                </textarea>
                        </label>

                        <div class="mb-3">
                            <label class="form-label" for="name" style="font-weight: bold;margin-left: 45px;color: rgb(111,66,193);">
                                <br> <br>Region
                                <input class="form-control item" type="text" id="text" name="cust_reg" style="width: 121px;margin-bottom: 4px;" required="">
                            </label>
                            <label class="form-label" for="name" style=" font-weight: bold;margin-left: 48px;width: 117px;color: rgb(111,66,193);">
                                City
                                <input class="form-control item" type="text" id="text" name="cust_city" style="width: 121px;margin-bottom: 4px;" required="">
                            </label>
                            <label class="form-label" for="name" style=" font-weight: bold;margin-left: 151px;color: rgb(111,66,193);">
                                Phone Number
                                <input class="form-control item" type="text" id="text" name="cust_phone" minlength="11" maxlength="11" style=" width: 289px;margin-bottom: 4px;padding-left: 18px;" onkeypress="return restrictAlphabets(event)" required="">
                            </label>
                        </div>
                        <div class="mb-3" style="margin-bottom: 9px;margin-top: 42px;">
                            <label class="form-label" for="name" style=" font-weight: bold;margin-left: 46px;color: rgb(111,66,193);">
                                Password
                                <input class="form-control item" type="password" id="password" name="cust_pass" style="width: 289px;margin-bottom: 4px;" required="">
                            </label>
                            <label class="form-label" for="name" style=" font-weight: bold;margin-left: 151px;color: rgb(111,66,193);">
                                Re - Type Password
                                <input class="form-control item" type="password" id="confirmPassword" name="conf_pass" style="width: 289px;margin-bottom: 4px;padding-left: 18px;" required="">
                            </label>
                        </div>
                        <div></div>
                        <div class="form-check" style="margin-left: 69px;">
                            <input class="form-check-input" type="checkbox" name="cust_terms" id="formCheck-1" style="margin-left: -17px;" required="">
                            <label class="form-check-label" for="formCheck-1" style="margin-left: 14px;">
                                By checking, You accept and understood the <a href="TermsConditions.php"> Terms &amp; Conditions </a> of the system.
                            </label>
                        </div>

                        <div></div>

                        <div class="btn-group" role="group"></div>

                        <div></div>
                        <button class="btn btn-danger form-btn" id="regBtn" type="button" style="margin-left: 275px;width: 137.797px;max-width: none;margin-top: -10px; border-color:indigo;background:indigo;font-weight:bold; ">REGISTER</button>
                        <div></div>
                        <a href="Login.php">
                            <button class="btn btn-danger form-btn" type="button" style="margin-left: 421px;width: 137.797px;max-width: none;margin-top: -65px; background: rgb(220, 53, 69);font-weight:bold;">CANCEL</button></a>
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
                <p style="text-align:center;" id="error-message"></p>
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
                    'cust_name': 'Full name',
                    'cust_st': 'Street',
                    'cust_brgy': 'Barangay',
                    'cust_email': 'Email',
                    'cust_zip': 'Zip code',
                    'cust_address': 'Address',
                    'cust_reg': 'Region',
                    'cust_city': 'City',
                    'cust_phone': 'Phone Number',
                    'cust_pass': 'Password',
                    'conf_pass': 'Retype Password',
                }

                for (const key in fields) {
                    if (document.getElementsByName(key)[0].value.length === 0) {
                        document.getElementById('error-message').innerHTML = fields[key] + ' is required';
                        modalError.style.display = "block";
                        return;
                    }
                }

                if(document.getElementsByName('cust_pass')[0].value.length < 8) {
                    document.getElementById('error-message').innerHTML = 'The password must have atleast 8 characters';
                    modalError.style.display = "block";
                    return;
                }

                if (document.getElementsByName('cust_pass')[0].value !== document.getElementsByName('conf_pass')[0].value) {
                    document.getElementById('error-message').innerHTML = 'The password does not match';
                    modalError.style.display = "block";
                    return;
                }

                if (!passwordRegex.test(password.value)) {
                    document.getElementById('error-message').innerHTML = 'Invalid password. Password must have at least 8 characters, at least 1 uppercase letter, at least 1 special character, and at least 1 lowercase letter.';
                    modalError.style.display = "block";
                    return
                }
                
                if (!document.getElementsByName('cust_terms')[0].checked) {
                    document.getElementById('error-message').innerHTML = 'Please agree to the terms and conditions';
                    modalError.style.display = "block";
                    return;
                }

                document.getElementById('myForm').submit();
            }

            //regex
           


        </script>
        <script>

        function restrictAlphabets(e){
            var x = e.which || e.keycode;
            if((x >= 48 && x <=57 ))
                return true;
            else
                return false;
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