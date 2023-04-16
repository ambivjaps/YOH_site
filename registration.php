<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include("includes/dbh.inc.php");
include("includes/functions.inc.php");


if (isset($_POST['cust_name'])) {
    $cust_name = $_POST['cust_name'];
    $cust_email = $_POST['cust_email'];
    $cust_pass = $_POST['cust_pass'];
    $cust_reg = $_POST['cust_reg'];

    $cust_city = $_POST['cust_city'];
    $cust_phone = $_POST['cust_phone'];
    $cust_zip = $_POST['cust_zip'];
    $conf_pass = $_POST['conf_pass'];

    $cust_address = $_POST['cust_add_1'].", ".$_POST['cust_add_2'];
    $cust_ig = $_POST['cust_ig'];

    $user_rank = "user";
    
    $password_hash = password_hash($cust_pass, PASSWORD_BCRYPT);
    
    $login_id =  random_num(11);
    
    // default avatar
    $unique = strtotime("now") . '_' . uniqid(rand()) . '_';
    $default = 'assets/img/default/default_user.jpg';
    $default_name = 'default_user.jpg';
    $saveImage = 'assets/img/upload/avatars/' . $unique . $default_name;
    $copyDefault = copy($default, $saveImage);
    
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'slightlylimited0018@gmail.com';
        $mail->Password = 'rmhlupihisommzsw';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        $mail->setFrom('slightlylimited0018@gmail.com', 'Account Verification');
        $mail->addAddress($cust_email);
        
        $mail->isHTML(true);
        $mail->Subject = 'Verification Email';
        $mail->Body = 'This is a verification email.';
        
        $mail->send();
        
        $query = "INSERT INTO register (cust_name, cust_avatar, cust_email, cust_pass, cust_reg, cust_city, cust_zip, cust_ig, cust_phone, login_id, cust_address, cust_status) VALUES ('$cust_name', '$saveImage', '$cust_email', '$password_hash', '$cust_reg', '$cust_city', '$cust_zip', '$cust_ig', '$cust_phone', $login_id, '$cust_address', 0)";
        
        $reg = mysqli_query($con, $query);
        if ($reg == 1) {
            $cquery = "INSERT INTO cust_profile (c_id, c_name, c_label, region, city, phone_no, zip_code, address, login_id, cust_status) VALUES ($login_id, '$cust_name', 'Home', '$cust_reg', '$cust_city', '$cust_phone', $cust_zip, '$cust_address', '$login_id', 1)";
            $regcust = mysqli_query($con, $cquery);
            // Redirect to login.php with success flag
        }
        ?>
        <script>
              window.location.replace("Login.php?registrationSuccess=true");
        </script>
        <?php
    } catch (Exception $e) {
        // Redirect to login.php with error flag
        header("Location: registration.php?error=true");
        exit;
    }
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
    <link rel="stylesheet" href="assets/css/ProdListDesign.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            Email that you've entered doesn't exists!
                        </div>
                    </div>
                <?php } ?>

                <!-- FORM -->
                <form data-bss-hover-animate="pulse" class="rounded" style="margin:auto;border:none; width: 892px;min-width: 182px;max-width: 1046px;min-height: 656px;height: 900px;color: rgb(111,66,193);" action="" id="myForm" method="post">
                    <div class="mb-3" style="padding-left: -6px;">
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 46px;color: rgb(111,66,193);">
                            Full Name
                            <input class="form-control item" type="text" id="text" name="cust_name" style=" font-weight: bold;width: 730px;margin-bottom: 4px;" required="">
                        </label>
    
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 46px;color: rgb(111,66,193);">
                        Contact Details
                        <br><small>Email Address</small>
                            <input class="form-control item" type="text" id="text" name="cust_email" style="width: 289px;margin-bottom: 4px;" required="">
                        </label>
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 151px;color: rgb(111,66,193);">
                        <small>Mobile Number</small>
                            <input class="form-control item" type="text" id="text" name="cust_phone" minlength="11" maxlength="11" style=" width: 270px;margin-bottom: 4px;padding-left: 18px;" onkeypress="return restrictAlphabets(event)" required="">
                        </label>
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 45px;color: rgb(111,66,193);">
                        <small>Instagram Handle</small>
                            <input class="form-control item" type="text" id="text" name="cust_ig" style=" width: 289px;margin-bottom: 4px;padding-left: 18px;" required="">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name" style=" font-weight: bold;margin-left: 44px;color: rgb(111,66,193);margin-top: -17px;margin-bottom: -91px;margin-right: 12px;text-align: left;">
                            <br>Address
                            <br><small>House no./Lot no./Block no./Unit no., Street</small>
                            <input class="form-control item" type="text" id="text" name="cust_add_1" style="width: 700px;margin-bottom: 2px;" required="">
                            <br><small>Village/Subdivision, Building, Barangay</small>
                            <input class="form-control item" type="text" id="text" name="cust_add_2" style="width: 700px;margin-bottom: 2px;" required="">
                        </label>
                    </div>

                        <div class="mb-3">
                            <label class="form-label" for="name" style="font-weight: bold;margin-left: 45px;color: rgb(111,66,193);">
                                <small>Region</small><br>
                                <select name="cust_reg" id="cust_reg" required>
                                    <option value="">Select Region</option>
                                    <option value="I">I - Ilocos Region</option>
                                    <option value="II">II - Cagayan Valley</option>
                                    <option value="III">III - Central Luzon</option>
                                    <option value="IVA">IV-A - CALABARZON</option>
                                    <option value="IVB">IV-B - MIMAROPA</option>
                                    <option value="V">V - Bicol Region</option>
                                    <option value="VI">VI - Western Visayas</option>
                                    <option value="VII">VII - Central Visayas</option>
                                    <option value="VIII">VIII - Eastern Visayas</option>
                                    <option value="IX">IX - Zamboanga Peninsula</option>
                                    <option value="X">X - Northern Mindanao</option>
                                    <option value="XI">XI - Davao Region</option>
                                    <option value="XII">XII - SOCCSKSARGEN</option>
                                    <option value="XIII">XIII - Caraga Region</option>
                                    <option value="CAR">Cordillera Administrative Region (CAR)</option>
                                    <option value="NCR">National Capital Region (NCR)</option>
                                    <option value="BARMM">Bangsamoro Autonomous Region in Muslim Mindanao</option>
                                </select>
                            </label>
                            <label class="form-label" for="name" style=" font-weight: bold;margin-left: 48px;width: 117px;color: rgb(111,66,193);">
                                <small>City</small>
                                <select name="cust_city" id="cust_city" required>
                                    <option value="">Select City</option>
                                </select><br>
                            </label>
                            <label class="form-label" for="name" style="font-weight: bold;margin-left: 48px;color: rgb(111,66,193);">
                            <small>ZIP Code</small><br>
                            <input class="form-control item" type="text" id="text" name="cust_zip" style="width: 121px;margin-bottom: 4px;min-width: 76px;" onkeypress="return restrictAlphabets(event)" required="">
                            </label>
                        </div>
                            
                        <div class="mb-3" style="margin-bottom: 9px;margin-top: 18px;">
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
                    'cust_email': 'Email',
                    'cust_zip': 'Zip code',
                    'cust_add_1': 'Address Line 1',
                    'cust_add_2': 'Address Line 2',
                    'cust_reg': 'Region',
                    'cust_city': 'City',
                    'cust_phone': 'Mobile Number',
                    'cust_ig': 'Instagram Handle',
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
        // Define cities for each region
        var cities = {
            I: ["Alaminos", "Batac", "Candon", "Dagupan", "Laoag", "San Carlos", "San Fernando", "Urdaneta", " Vigan"],
            II: ["Tuguegarao", "Ilagan", "Santiago", "Cauayan"],
            III: ["Angeles", "Olongapo", "Tarlac", "San Fernando", "Malolos", "Balanga", "Palayan", "Meycauayan", " San Jose del Monte", "Cabanatuan", "Gapan", "Mu�oz", "San Jose", "Mabalacat"],
            IVA: ["Antipolo", "Bacoor", "Batangas City", "Bi�an", "Cabuyao", "Calamba", "Cavite City", "Dasmari�as", "General Trias", "Imus", "Lipa", "Lucena", "San Pablo", "San Pedro", "Santa Rosa", "Tagaytay", "Tanauan", "Tayabas", "Trece Martires"],
            V: ["Iriga", "Legazpi", "Ligao", "Masbate", "Naga", "Sorsogon", "Tabaco"],
            VI: ["Bacolod", "Bago", "Cadiz", "Escalante", "Himamaylan", "Iloilo City", "Kabankalan", "La Carlota", "Passi", "Roxas", "Sagay", "San Carlos", "Silay", "Sipalay", "Talisay", "Victorias"],
            VII: ["Bais", "Bayawan", "Bogo", "Canlaon", "Carcar", "Cebu City", "Danao", "Dumaguete", " Guihulngan", "Lapu-lapu", "Mandaue", "Naga", "Tagbilaran", "Talisay", "Tanjay", "Toledo"],
            VIII: ["Baybay", "Borongan", "Calbayog", "Catbalogan", "Maasin", "Ormoc", "Tacloban"],
            IX: ["Dapitan", "Dipolog", "Isabela", "Pagadian", "Zamboanga City"],
            X: ["Cagayan de Oro", "El Salvador", "Gingoog", "Iligan", "Malaybalay", "Oroquieta", "Ozamiz", "Tangub", "Valencia"],
            XI: ["Davao City", "Digos City", "Mati", "Panabo", "Samal", "Tagum"],
            XII: ["General Santos", "Kidapawan", "Koronadal", "Tacurong"],
            XIII: ["Bayugan", "Bislig", "Butuan", "Cabadbaran", "Surigao City", "Tandag"],
            CAR: ["Baguio City", "Tabuk City"],
            NCR: ["Caloocan", "Las Pi�as", "Makati", "Malabon", "Mandaluyong", "Manila", "Marikina", "Muntinlupa", " Navotas", "Para�aque", "Pasay", "Pasig", "Pareros", "Quezon City", "San Juan", "Taguig", "Valenzuela"],
            IVB: ["Puerto Princesa", "Calapan"],
            BARMM: ["Lamitan", "Marawi", "Cotabato City"]
        };

        // Update city options based on selected region
        $("#cust_reg").on("change", function() {
            var selectedRegion = $(this).val();
            var citySelect = $("#cust_city");
            citySelect.empty();
            citySelect.append('<option value="">Select City</option>');
            if (selectedRegion !== "") {
                var regionCities = cities[selectedRegion];
                $.each(regionCities, function(index, city) {
                    citySelect.append('<option value="' + city + '">' + city + '</option>');
                });
            }
        });
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