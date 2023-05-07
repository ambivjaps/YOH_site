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
        
        $emailquery = "SELECT count(*) as total FROM register WHERE cust_email = '$cust_email'";
        $result = mysqli_query($con, $emailquery);
        if (mysqli_fetch_assoc($result)['total'] > 0) {
            header("Location: registration.php?error=true");
            return;
        } else {
            $saveImage = 'assets/img/upload/avatars/' . $unique . $default_name;
            $copyDefault = copy($default, $saveImage);
        }
        
        $query = "insert into register (login_id,cust_name, cust_avatar, cust_email,cust_pass,cust_reg,cust_city,cust_phone,cust_zip,cust_address,cust_ig,cust_status) values
    ('$login_id','$cust_name','$saveImage','$cust_email','$password_hash','$cust_reg','$cust_city','$cust_phone','$cust_zip','$cust_address','$cust_ig','0')";
        
        $reg = mysqli_query($con, $query);
        if ($reg == 1) {
            $cquery = "insert into cust_profile (c_id,login_id,c_name,c_label,region,city,phone_no,zip_code,address,cust_status) values ('$login_id','$login_id','$cust_name','Home', '$cust_reg','$cust_city','$cust_phone','$cust_zip','$cust_address','1')";
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
        header("Location: registration.php?error=emailerror");
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
        <section class="clean-block clean-form dark" style="height:auto; width:auto; background-color:#efe9ef; ">
            <div class="container">
                <div class="block-heading">
                    <img style="width: 231px;height: 201px;" src="assets/img/LOGOEXAMPLE.png">
                </div>
                <h2 style="text-align: center; font-size: 41px;color: var(--bs-indigo); font-weight: bold;">Registration</h2><br>
                <?php
                if (isset($_GET['error']) && $_GET['error'] === 'true') { ?>
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-danger text-center w-50" role="alert">
                            Email that you've entered already exists!
                        </div>
                    </div>
                <?php } ?>

                <?php
                if (isset($_GET['error']) && $_GET['error'] === 'emailerror') { ?>
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-danger text-center w-50" role="alert">
                            Email doesn't exist. Please enter a valid e-mail address.
                        </div>
                    </div>
                <?php } ?>

                <!-- FORM -->
                <form data-bss-hover-animate="pulse" class="rounded" style="border:none; width:auto;height:auto;color: rgb(111,66,193);display:flexbox;" action="" id="myForm" method="post">
                    <div class="mb-6">
                        <label class="form-label" for="name" style="font-weight:bold;color: rgb(111,66,193);">
                            Full Name
                            <input class="form-control item" type="text" id="text" name="cust_name" style="width:270px;" required="" placeholder="Juan Christian Dela Cruz">
                        </label>
                    <hr>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name" style="font-weight: bold;color: rgb(111,66,193);">
                        Contact Details 
                        <br><br><small>Email Address</small>
                            <input class="form-control item" type="text" id="text" name="cust_email" style="width:270px;margin-bottom: 4px;" required="" placeholder="juan_delacruz@hotmail.com">
                        </label>
                        <label class="form-label" for="name" style="font-weight: bold;color: rgb(111,66,193);">
                        <small>Mobile Number</small>
                            <input class="form-control item" type="text" id="text" name="cust_phone" minlength="11" maxlength="11" style=" width: 270px;margin-bottom: 4px;padding-left: 18px;" onkeypress="return restrictAlphabets(event)" required="" placeholder="0-XXX-XXX-XXXX">
                        </label>
                        <label class="form-label" for="name" style="font-weight: bold;color: rgb(111,66,193);">
                        <small>Instagram Handle</small>
                            <input class="form-control item" type="text" id="text" name="cust_ig" style="width: 270px;" required="" placeholder="www.instagram.com/jdjcruz">
                        </label>
                    </div>
                    
                        <label class="form-label" for="name" style="font-weight: bold;color: rgb(111,66,193);text-align: left;">
                            <span>Address<br>
                            <br><small>House no./Lot no./Block no./Unit no., Street</small>
                            <input class="form-control item" type="text" id="text" name="cust_add_1" style="width:310px;" required=""placeholder="Zeus Subd. , Blg. 4, Pasong Putik">
                            <br><small>Village/Subdivision, Building, Barangay</small>
                            <input class="form-control item" type="text" id="text" name="cust_add_2" style="width:310px;" required="" placeholder="Zeus Subd. , Blg. 4, Pasong Putik">
                        </label>
                    

                        <div class="mb-3">
                            <label class="form-label" for="name" style="font-weight: bold;color: rgb(111,66,193);">
                                <small>Region</small><br>
                                <select class="form-control item" name="cust_reg" id="cust_reg" style="width:270px;" required>
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
                        </div>
                            <label class="form-label" for="name" style=" font-weight: bold;width: 117px;color: rgb(111,66,193);">
                                <small>City</small>
                                <select class="form-control item" name="cust_city" id="cust_city" required>
                                    <option value="" >Select City</option>
                                </select>
                            </label>
                        <div class="mb-3">
                            <label class="form-label" for="name" style="font-weight: bold;color: rgb(111,66,193);">
                            <small>ZIP Code</small>
                            <input class="form-control item" type="text" id="text" name="cust_zip" style="width: 121px;margin-bottom: 4px;min-width: 76px;" onkeypress="return restrictAlphabets(event)" required="" placeholder="1111">
                            </label>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label" for="name" style=" font-weight: bold;color: rgb(111,66,193);">
                                Password
                                <input class="form-control item" type="password" id="password" name="cust_pass" style="width: 289px;" required="">
                            </label>
                            <label class="form-label" for="name" style=" font-weight: bold;color: rgb(111,66,193);">
                                Re - Type Password
                                <input class="form-control item" type="password" id="confirmPassword" name="conf_pass" style="width: 289px;" required="">
                            </label>
                        </div>
                        <div></div>
                        <div class="form-check" style="">
                            <input class="form-check-input" type="checkbox" name="cust_terms" id="formCheck-1" style="" required="">
                            <label class="form-check-label" for="formCheck-1" style="">
                                By checking, You accept and understood the <a href="TermsConditions.php"> Terms &amp; Conditions </a> of the system.
                            </label>
                        </div>
                        <br>
                        <button class="btn btn-danger form-btn" id="regBtn" type="button" style="width: 137.797px; border-color:indigo;background:indigo;font-weight:bold; ">REGISTER</button>
                        <a href="Login.php"><button class="btn btn-danger form-btn" type="button" style="width: 137.797px;background: rgb(220, 53, 69);font-weight:bold;">CANCEL</button></a>
                </form>
            </div>
        </section>
        <div id="myModal2" class="modal" >
            <div class="modal-content" style="width:300px;" >
                <p style="text-align:center; font-weight: bold;">Registration complete!</p>
                <p style="text-align:center;">You will now be redirected to Login</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="okBtn" style="border-color:indigo;background-color:indigo;font-weight:bold;width:auto;">OK</button>
                </div>
            </div>
        </div>

        <div id="myModal3" class="modal" >
            <div class="modal-content" style="width:300px;">
                <p style="text-align:center; font-weight: bold;color:red;font-size:32px;">Unable to register!</p>
                <p style="text-align:center;" id="error-message"></p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="errorBtnClode" style="border-color:indigo;background-color:indigo;font-weight:bold;width:auto;">OK</button>
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
            I: ["ILOCOS NORTE:", "Adams", "Bacarra", "Badoc", "Bangui", "Banna", "Batac", "Burgos", "Carasi", "Currimao", "Dingras", "Dumalneg", "Laoag", "Marcos", "Nueva Era", "Pagudpud", "Paoay", "Pasuquin", "Pinili", "San Nicolas", "Sarrat", "Solsona", "Vintar", 
            "ILOCOS SUR:", "Alilem", "Banayoyo", "Bantay", "Burgos", "Cabugao", "Candon", "Caoayan", "Cervantes", "Galgala", "Lidlidda", "Magsingal", "Nagbukel", "Narvacan", "Quirino", "Salcedo", "San Emilio", "San Esteban", "San Ildefonso", "San Juan", "San Vicente", "Santa", "Santiago", "Santo Domingo", "Sigay", "Sinait", "Sugpon", "Suyo", "Tagudin", "Vigan",
            "LA UNION:", "Agoo", "Aringay", "Bacnotan", "Bagulin", "Balaoan", "Bangar", "Bauang", "Burgos", "Caba", "Luna", "Naguilian", "Pugo", "Rosario", "San Fernando", "San Gabriel", "San Juan", "Santo Tomas", "Santol", "Sudipen", "Tubao", 
            "PANGASINAN:", "Agno", "Aguilar", "Alaminos", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dasol", "Infanta", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Umingan", "Urbiztondo", "Villasis"],
            
            II: ["BATANES", "Basco", "Itbayat", "Ivana", "Mahatao", "Sabtang", "Uyugan",
            "CAGAYAN", "Abulug", "Alcala", "Allacapan", "Amulung", "Aparri", "Baggao", "Ballesteros", "Buguey", "Calayan", "Camalaniugan", "Claveria", "Enrile", "Gattaran", "Gonzaga", "Iguig", "Lal-lo", "Lasam", "Pamplona", "Penablanca", "Piat", "Rizal", "Sanchez-Mira", "Santa Ana", "Santa Praxedes", "Santa Teresita", "Santo Nino", "Solana", "Tuao", "Tuguegarao City",
            "ISABELA", "Alicia", "Angadanan", "Aurora", "Benito Soliven", "Burgos", "Cabagan", "Cabatuan", "Cauayan City", "Cordon", "Delfin Albano", "Dinapigue", "Divilacan", "Echague", "Gamu", "Ilagan City", "Jones", "Luna", "Maconacon", "Mallig", "Naguilian", "Palanan", "Quezon", "Quirino", "Ramon", "Reina Mercedes", "Roxas", "San Agustin", "San Guillermo", "San Isidro", "San Manuel", "San Mariano", "San Mateo", "San Pablo", "Santa Maria", "Santiago City", "Santo Tomas", "Tumauini", 
            "NUEVE VIZCAYA", "Alfonso Castaneda", "Ambaguio", "Aritao", "Bagabag", "Bambang", "Bayombong", "Diadi", "Dupax del Norte", "Dupax del Sur", "Kasibu", "Kayapa", "Quezon", "Santa Fe", "Solano", "Villaverde",
            "QUIRINO", "Aglipay", "Cabarroguis", "Diffun", "Maddela", "Nagtipunan", "Saguday"],
            
            III: ["AURORA:", "Alfonso Castaneda", "Baler", "Casiguran", "Dilasag", "Dinalungan", "Dingalan", "Dipaculao", "Maria Aurora", "San Luis",
            "BATAAN:", "Abucay", "Bagac", "Dinalupihan", "Hermosa", "Limay", "Mariveles", "Morong", "Orani", "Pilar", "Samal",
            "BULACAN:", "Angat", "Balagtas", "Baliuag", "Bocaue", "Bulacan", "Bustos", "Calumpit", "Dona Remedios Trinidad", "Guiguinto", "Hagonoy", "Malolos", "Marilao", "Meycauayan", "Norzagaray", "Obando", "Pandi", "Paombong", "Plaridel", "Pulilan", "San Ildefonso", "San Jose del Monte", "San Miguel", "San Rafael", "Santa Maria",
            "NUEVA ECIJA:", "Aliaga", "Bongabon", "Cabanatuan", "Cabiao", "Carranglan", "Cuyapo", "Gabaldon", "General Mamerto Natividad", "General Tinio", "Guimba", "Jaen", "Laur", "Licab", "Llanera", "Lupao", "Nampicuan", "Palayan", "Pantabangan", "Penaranda", "Quezon", "Rizal", "San Antonio", "San Isidro", "San Jose", "San Leonardo", "Santa Rosa", "Santo Domingo", "Talavera", "Talugtug", "Zaragoza",
            "PAMPANGA:", "Apalit", "Arayat", "Bacolor", "Candaba", "Floridablanca", "Guagua", "Lubao", "Mabalacat", "Macabebe", "Magalang", "Masantol", "Mexico", "Minalin", "Porac", "San Fernando", "San Luis", "San Simon", "Santa Ana", "Santa Rita", "Santo Tomas", "Sasmuan",
            "TARLAC:", "Anao", "Bamban", "Camiling", "Capas", "Concepcion", "Gerona", "La Paz", "Mayantoc", "Moncada", "Paniqui", "Pura", "Ramos", "San Clemente", "San Jose", "San Manuel", "Santa Ignacia", "Tarlac City", "Victoria",
            "ZAMBALES:", "Botolan", "Cabangan", "Candelaria", "Castillejos", "Iba", "Masinloc", "Olongapo", "Palauig", "San Antonio", "San Felipe", "San Marcelino", "San Narciso", "Santa Cruz", "Subic"],
            
            IVA: ["BATANGAS:","Balete", "Batangas City", "Bauan", "Calaca", "Calatagan", "Cuenca", "Ibaan", "Laurel", "Lemery", "Lian", "Lipa City", "Lobo", "Mabini", "Malvar", "Mataasnakahoy", "Nasugbu", "Padre Garcia", "Rosario", "San Jose", "San Juan", "San Luis", "San Nicolas", "San Pascual", "Santa Teresita", "Santo Tomas", "Taal", "Talisay", "Tanauan City", "Taysan", "Tingloy", "Tuy",
            "CAVITE:","Alfonso", "Amadeo", "Bacoor City", "Carmona", "Cavite City", "Dasmarinas City", "Gen. Emilio Aguinaldo", "Gen. Mariano Alvarez", "Imus City", "Indang", "Kawit", "Magallanes", "Maragondon", "Mendez", "Naic", "Noveleta", "Rosario", "Silang", "Tagaytay City", "Tanza", "Ternate", "Trece Martires City",
            "LAGUNA:","Alaminos", "Bay", "Binan City", "Cabuyao City", "Calamba City", "Calauan", "Cavinti", "Famy", "Kalayaan", "Liliw", "Los Banos", "Luisiana", "Lumban", "Mabitac", "Magdalena", "Majayjay", "Nagcarlan", "Paete", "Pagsanjan", "Pakil", "Pangil", "Pila", "Rizal", "San Pablo City", "San Pedro City", "Santa Cruz", "Santa Maria", "Santa Rosa City", "Siniloan", "Sta. Maria", "Sta. Rosa", "Victoria",
            "QUEZON:","Agdangan", "Alabat", "Atimonan", "Buenavista", "Burdeos", "Calauag", "Candelaria", "Catanauan", "Dolores", "General Luna", "General Nakar", "Guinayangan", "Gumaca", "Infanta", "Jomalig", "Lopez", "Lucban", "Lucena City", "Macalelon", "Mauban", "Mulanay", "Padre Burgos", "Pagbilao", "Panukulan", "Patnanungan", "Perez", "Pitogo", "Plaridel", "Polillo", "Quezon", "Real", "Sampaloc", "San Andres", "San Antonio", "San Francisco", "San Narciso", "Sariaya", "Tagkawayan", "Tayabas City", "Tiaong", "Unisan",
            "RIZAL:","Angono", "Antipolo", "Baras", "Binangonan", "Cainta", "Cardona", "Jalajala", "Morong", "Pililla", "Rodriguez", "San Mateo", "Tanay", "Taytay", "Teresa"],
            
            IVB: ["PALAWAN", "Aborlan", "Agutaya", "Araceli", "Balabac", "Bataraza", "Brooke's Point", "Busuanga", "Cagayancillo", "Coron", "Culion", "Cuyo", "Dumaran", "El Nido", "Kalayaan", "Linapacan", "Magsaysay", "Narra", "Quezon", "Rizal", "Roxas", "San Vicente", "Sofronio Espanola", "Taytay",
            "MARINDUQUE", "Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos",
            "ROMBLON", "Alcantara", "Banton", "Cajidiocan", "Calatrava", "Concepcion", "Corcuera", "Ferrol", "Looc", "Magdiwang", "Odiongan", "Romblon", "San Agustin", "San Andres", "San Fernando", "San Jose", "Santa Fe", "Santa Maria",
            "MINDORO OCCIDENTAL", "Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay", "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz",
            "MINDORO ORIENTAL", "Baco", "Bansud", "Bongabong", "Bulalacao", "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"],
            
            V: ["ALBAY:", "Barcelona", "Daraga", "Guinobatan", "Jovellar", "Legazpi City", "Libon", "Ligao City", "Malilipot", "Malinao", "Manito", "Oas", "Pio Duran", "Polangui", "Rapu-Rapu", "Santo Domingo", "Tabaco City", "Tiwi",
            "CAMARINES NORTE:", "Basud", "Capalonga", "Daet", "Jose Panganiban", "Labo", "Mercedes", "Paracale", "San Lorenzo Ruiz", "San Vicente", "Santa Elena", "Talisay", "Vinzons",
            "CAMARINES SUR:", "Baao", "Balatan", "Bato", "Bombon", "Buhi", "Bula", "Cabusao", "Calabanga", "Camaligan", "Canaman", "Caramoan", "Del Gallego", "Gainza", "Garchitorena", "Goa", "Iriga City", "Lagonoy", "Libmanan", "Lupi", "Magarao", "Milaor", "Minalabac", "Nabua", "Naga City", "Ocampo", "Pamplona", "Pasacao", "Pili", "Presentacion", "Ragay", "Sagnay", "San Fernando", "San Jose", "Sipocot", "Siruma", "Tigaon", "Tinambac",
            "CATANDUANES:", "Bagamanoc", "Baras", "Bato", "Caramoran", "Gigmoto", "Pandan", "Panganiban", "San Andres", "San Miguel", "Viga", "Virac",
            "MASBATE:", "Aroroy", "Baleno", "Balud", "Batuan", "Cataingan", "Cawayan", "Claveria", "Dimasalang", "Esperanza", "Mandaon", "Masbate City", "Milagros", "Mobo", "Monreal", "Palanas", "Pio V. Corpuz", "Placer", "San Fernando", "San Jacinto", "San Pascual", "Uson",
            "SORSOGON:", "Barcelona", "Bulan", "Bulusan", "Casiguran", "Castilla", "Donsol", "Gubat", "Irosin", "Juban", "Magallanes", "Matnog", "Pilar", "Prieto Diaz", "Santa Magdalena", "Sorsogon City"],
            
            VI: ["AKLAN:", "Altavas", "Balete", "Banga", "Batan", "Buruanga", "Ibajay", "Kalibo", "Lezo", "Libacao", "Madalag", "Makato", "Malay", "Malinao", "Nabas", "New Washington", "Numancia", "Tangalan",
            "ANTIQUE:", "Anini-y", "Barbaza", "Belison", "Bugasong", "Caluya", "Culasi", "Hamtic", "Laua-an", "Libertad", "Pandan", "Patnongon", "San Jose", "San Remigio", "Sebaste", "Sibalom", "Tibiao", "Tobias Fornier", "Valderrama",
            "CAPIZ:", "Cuartero", "Dao", "Dumalag", "Dumarao", "Ivisan", "Jamindan", "Maayon", "Mambusao", "Panay", "Panitan", "Pilar", "Pontevedra", "President Roxas", "Roxas City", "Sapian", "Sigma", "Tapaz",
            "GUIMARAS:",  "Buenavista", "Jordan", "Nueva Valencia", "San Lorenzo", "Sibunag",
            "ILOILO:","Ajuy", "Alimodian", "Anilao", "Badiangan", "Balasan", "Banate", "Barotac Nuevo", "Barotac Viejo", "Batad", "Bingawan", "Cabatuan", "Calinog", "Carles", "Concepcion", "Dingle", "Duenas", "Dumangas", "Estancia", "Guimbal", "Igbaras", "Iloilo City", "Janiuay", "Lambunao", "Leganes", "Lemery", "Leon", "Maasin", "Miagao", "Mina", "New Lucena", "Oton", "Passi City", "Pavia", "Pototan", "San Dionisio", "San Enrique", "San Joaquin", "San Miguel", "San Rafael", "Santa Barbara", "Sara", "Tigbauan", "Tubungan", "Zarraga",
            "NEGROS OCCIDENTAL", "Bacolod City", "Bago City", "Binalbagan", "Cadiz City", "Calatrava", "Candoni", "Cauayan", "Don Salvador Benedicto", "Enrique B. Magalona", "Escalante City", "Himamaylan City", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan City", "La Carlota City", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay City", "Salvador Benedicto", "San Carlos City", "San Enrique", "Silay City", "Sipalay City", "Talisay City", "Toboso", "Valladolid", "Victorias City"],
            
            VII: ["BOHOL:","Alburquerque", "Alicia", "Anda", "Antequera", "Baclayon", "Balilihan", "Batuan", "Bien Unido", "Bilar", "Buenavista", "Calape", "Candijay", "Carmen", "Catigbian", "Clarin", "Corella", "Cortes", "Dagohoy", "Danao", "Dauis", "Dimiao", "Duero", "Garcia Hernandez", "Getafe", "Guan", "Inabanga", "Jagna", "Lila", "Loay", "Loboc", "Loon", "Mabini", "Maribojoc", "Panglao", "Pilar", "Pres. Carlos P. Garcia", "Sagbayan", "San Isidro", "San Miguel", "Sevilla", "Sierra Bullones", "Sikatuna", "Tagbilaran City", "Talibon", "Trinidad", "Tubigon", "Ubay", "Valencia",
            "CEBU:","Alcantara", "Alcoy", "Alegria", "Aloguinsan", "Argao", "Asturias", "Badian", "Balamban", "Bantayan", "Barili", "Bogo City", "Boljoon", "Borbon", "Carcar City", "Carmen", "Catmon", "Cebu City", "Compostela", "Consolacion", "Cordova", "Daanbantayan", "Dalaguete", "Danao City", "Dumanjug", "Ginatilan", "Lapu-Lapu City", "Liloan", "Madridejos", "Malabuyoc", "Mandaue City", "Medellin", "Minglanilla", "Moalboal", "Naga City", "Oslob", "Pilar", "Pinamungajan", "Poro", "Ronda", "Samboan", "San Fernando", "San Francisco", "San Remigio", "Santa Fe", "Santander", "Sibonga", "Sogod", "Tabogon", "Tabuelan", "Talisay City", "Toledo City", "Tuburan", "Tudela",
            "NEGROS ORIENTAL:", "Amlan", "Ayungon", "Bacong", "Bais City", "Basay", "Bindoy", "Canlaon City", "Dauin", "Dumaguete City", "Guihulngan City", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay City", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita",
            "SIQUIJOR:","Enrique Villanueva", "Larena", "Lazi", "Maria", "San Juan", "Siquijor"],
            
            
            VIII: ["BILIRAN:", "Almeria", "Biliran", "Cabucgayan", "Caibiran", "Culaba", "Kawayan", "Maripipi",
            "EASTERN SAMAR:","Arteche", "Balangiga", "Balangkayan", "Borongan", "Can-avid", "Dolores", "General MacArthur", "Giporlos", "Guiuan", "Hernani", "Jipapad", "Lawaan", "Llorente", "Maslog", "Maydolong", "Mercedes", "Oras", "Quinapondan", "Salcedo", "San Julian", "San Policarpo", "Sulat", "Taft",
            "LEYTE:","Abuyog", "Alangalang", "Albuera", "Babatngon", "Barugo", "Bato", "Baybay", "Burauen", "Calubian", "Capoocan", "Carigara", "Dagami", "Dulag", "Hilongos", "Hindang", "Inopacan", "Isabel", "Jaro", "Javier", "Julita", "Kananga", "La Paz", "Leyte", "MacArthur", "Mahaplag", "Matag-ob", "Matalom", "Mayorga", "Merida", "Ormoc", "Palo", "Palompon", "Pastrana", "San Isidro", "San Miguel", "Santa Fe", "Tabango", "Tabontabon", "Tacloban", "Tanauan", "Tolosa", "Tunga", "Villaba",
            "NORTHERN SAMAR:","Allen", "Biri", "Bobon", "Capul", "Catarman", "Catubig", "Gamay", "Laoang", "Lapinig", "Las Navas", "Lavezares", "Lope de Vega", "Mapanas", "Mondragon", "Palapag", "Pambujan", "Rosario", "San Antonio", "San Isidro", "San Jose", "San Roque", "San Vicente", "Silvino Lobos", "Victoria",
            "SAMAR:","Basey", "Calbiga", "Daram", "Gandara", "Hinabangan", "Jiabong", "Marabut", "Matuguinao", "Motiong", "Pagsanghan", "Paranas", "Pinabacdao", "San Jorge", "San Jose de Buan", "San Sebastian", "Santa Margarita", "Santa Rita", "Santo Nino", "Tagapul-an", "Talalora", "Tarangnan", "Villareal", "Zumarraga",
            "SOUTHERN LEYTE:","Anahawan", "Bontoc", "Hinundayan", "Hinunangan", "Libagon", "Liloan", "Limasawa", "Maasin", "Macrohon", "Malitbog", "Padre Burgos", "Pintuyan", "Saint Bernard", "San Francisco", "San Juan", "San Ricardo", "Silago", "Sogod", "Tomas Oppus"],
            
            IX: ["ZAMBOANGA DEL NORTE:", "Baliguian", "Dapitan City", "Dipolog City", "Godod", "Gutalac", "Jose Dalman", "Kalawit", "Katipunan", "La Libertad", "Labason", "Liloy", "Manukan", "Mutia", "Pinan", "Polanco", "Pres. Manuel A. Roxas", "Rizal", "Salug", "Sergio Osmena Sr.", "Siayan", "Sibuco", "Sibutad", "Sindangan", "Sirawai", "Tampilisan",
            "ZAMBOANGA DEL SUR:", "Aurora", "Bayog", "Dimataling", "Dinas", "Dumalinao", "Dumingag", "Goddess", "Guipos", "Josefina", "Kumalarang", "Lakewood", "Lapuyan", "Mahayag", "Margosatubig", "Midsalip", "Molave", "Pagadian City", "Pitogo", "Ramon Magsaysay", "San Miguel", "San Pablo", "Sominot", "Tabina", "Tambulig", "Tigbao", "Tukuran", "Vincenzo A. Sagun",
            "ZAMBOANGA SIBUGAY:", "Alicia", "Buug", "Diplahan", "Imelda", "Ipil", "Kabasalan", "Mabuhay", "Malangas", "Naga", "Olutanga", "Payao", "Roseller Lim", "Siay", "Talusan", "Titay", "Tungawan"],
            
            X: ["BUKIDNON:", "Cabanglasan", "Damulog", "Dangcagan", "Don Carlos", "Impasug-ong", "Kadingilan", "Kalilangan", "Kibawe", "Kitaotao", "Lantapan", "Libona", "Malaybalay", "Malitbog", "Manolo Fortich", "Maramag", "Pangantucan", "Quezon", "San Fernando", "Sumilao", "Talakag", "Valencia City",
            "CAMIGUIN", "Catarman", "Guinsiliban", "Mahinog", "Mambajao", "Sagay",
            "LANAO DEL NORTE:","Baloi", "Baroy", "Iligan City", "Kapatagan", "Kauswagan", "Kolambugan", "Lala", "Linamon", "Magsaysay", "Maigo", "Matungao", "Munai", "Nunungan", "Pantao Ragat", "Pantar", "Poona Piagapo", "Salvador", "Sapad", "Sultan Naga Dimaporo", "Tagoloan", "Tangcal", "Tubod",
            "MISAMIS OCCIDENTAL:","Aloran", "Baliangao", "Bonifacio", "Calamba", "Clarin", "Concepcion", "Don Victoriano Chiongbian", "Jimenez", "Lopez Jaena", "Oroquieta City", "Ozamiz City", "Panaon", "Plaridel", "Sapang Dalaga", "Sinacaban", "Tangub City", "Tudela",
            "MISAMIS ORIENTAL:", "Alubijid", "Balingasag", "Balingoan", "Binuangan", "Cagayan de Oro City", "Claveria", "El Salvador City", "Gingoog City", "Gitagum", "Initao", "Jasaan", "Kinita-an", "Kinoguitan", "Lagonglong", "Laguindingan", "Libertad", "Lugait", "Magsaysay", "Manticao", "Medina", "Naawan", "Opol", "Salay", "Sugbongcogon", "Tagoloan", "Talisayan", "Villanueva"],
            
            XI: ["DAVAO DEL NORTE:","Asuncion", "Braulio E. Dujali", "Carmen", "Kapalong", "New Corella", "Panabo City", "Samal City", "San Isidro", "Santo Tomas", "Tagum City", "Talaingod",
            "DAVAO DEL SUR:", "Bansalan", "Davao City", "Digos City", "Don Marcelino", "Hagonoy", "Jose Abad Santos", "Kiblawan", "Magsaysay", "Malalag", "Matanao", "Padada", "Santa Cruz", "Santa Maria", "Sarangani", "Sulop",
            "DAVAO OCCIDENTAL:", "Don Marcelino", "Jose Abad Santos", "Malita", "Santa Maria", "Sarangani",
            "DAVAO ORIENTAL:", "Baganga", "Banaybanay", "Boston", "Caraga", "Cateel", "Governor Generoso", "Lupon", "Manay", "Mati City", "San Isidro", "Tarragona"],
            
            XII: ["SULTAN KUDARAT:","Bagumbayan", "Columbio", "Esperanza", "Isulan", "Kalamansig", "Lambayong", "Lebak", "Lutayan", "Palimbang", "President Quirino", "Senator Ninoy Aquino",
            "SOUTH COTABATO:", "Banga", "General Santos", "Koronadal", "Lake Sebu", "Norala", "Polomolok", "Santo Nino", "Surallah", "T'boli", "Tampakan", "Tantangan", "Tupi",
            "SARANGANI:", "Alabel", "Glan", "Kiamba", "Maasim", "Maitum", "Malapatan",
            "COTABATO:", "Alamada", "Aleosan", "Antipas", "Arakan", "Banisilan", "Carmen", "Kabacan", "Kidapawan", "Libungan", "M'lang", "Magpet", "Makilala", "Matalam", "Midsayap", "Pigkawayan", "Pikit", "President Roxas", "Tulunan"],
            
            XIII: ["AGUSAN DEL NORTE:","Buenavista", "Cabadbaran", "Carmen", "Jabonga", "Kitcharao", "Las Nieves", "Magallanes", "Nasipit", "Remedios T. Romualdez", "Santiago", "Tubay",
            "AGUSAN DEL SUR:","Bayugan", "Bunawan", "Esperanza", "La Paz", "Loreto", "Prosperidad", "Rosario", "San Francisco", "San Luis", "Santa Josefa", "Sibagat", "Talacogon", "Trento", "Veruela",
            "DINAGAT ISLANDS:", "Basilisa", "Cagdianao", "Dinagat", "Libjo", "Loreto", "San Jose", "Tubajon",
            "SURIGAO DEL NORTE:", "Alegria", "Bacuag", "Burgos", "Claver", "Dapa", "Del Carmen", "General Luna", "Gigaquit", "Mainit", "Malimono", "Pilar", "Placer", "San Benito", "San Francisco", "San Isidro", "Santa Monica", "Sison", "Socorro", "Surigao City", "Tagana-an", "Tubod",
            "SURIGAO DEL SUR:", "Barobo", "Bayabas", "Bislig", "Cagwait", "Cantilan", "Carmen", "Carrascal", "Cortes", "Hinatuan", "Lanuza", "Lianga", "Lingig", "Madrid", "Marihatag", "San Agustin", "San Miguel", "Tagbina", "Tago", "Tandag"],
            
            CAR: ["ABRA:","Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Langiden", "Licuan-Baay", "Luba", "Malibcong", "Manabo", "Penarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Tubo", "Villaviciosa",
            "APAYAO:","Calanasan", "Conner", "Flora", "Kabugao", "Luna", "Pudtol", "Santa Marcela",
            "BENGUET:", "Atok", "Baguio City", "Bakun", "Bokod", "Buguias", "Itogon", "Kabayan", "Kapangan", "Kibungan", "La Trinidad", "Mankayan", "Sablan", "Tuba", "Tublay",
            "IFUGAO:", "Aguinaldo", "Alfonso Lista", "Asipulo", "Banaue", "Hingyon", "Hungduan", "Kiangan", "Lagawe", "Lamut", "Mayoyao", "Tinoc",
            "KALINGA:", "Balbalan", "Lubuagan", "Pasil", "Pinukpuk", "Rizal", "Tabuk City", "Tanudan", "Tinglayan",
            "MOUNTAIN PROVINCE:","Barlig", "Bauko", "Besao", "Bontoc", "Natonin", "Paracelis", "Sabangan", "Sadanga", "Sagada", "Tadian"],
            
            NCR: ["Caloocan", "Las Pinas", "Makati", "Malabon", "Mandaluyong", "Manila", "Marikina", "Muntinlupa", " Navotas", "Paranaque", "Pasay", "Pasig", "Pareros", "Quezon City", "San Juan", "Taguig", "Valenzuela"],
            
            BARMM: ["MAGUINDANAO:", "Barira", "Buldon", "Datu Abdullah Sangki", "Datu Anggal Midtimbang", "Datu Blah T. Sinsuat", "Datu Hoffer Ampatuan", "Datu Montawal", "Datu Odin Sinsuat", "Datu Paglas", "Datu Piang", "Datu Salibo", "Datu Saudi-Ampatuan", "Datu Unsay", "Gen. S. K. Pendatun", "Guindulungan", "Kabuntalan", "Mamasapano", "Mangudadatu", "Matanog", "Northern Kabuntalan", "Pagalungan", "Paglat", "Pandag", "Parang", "Rajah Buayan", "Shariff Aguak", "Shariff Saydona Mustapha", "Sultan Kudarat", "Sultan Mastura", "Sultan sa Barongis", "Sultan Sumagka", "Talayan", "South Upi", "Upi",
            "LANAO DEL SUR:", "Bacolod-Kalawi", "Balabagan", "Balindong", "Bayang", "Binidayan", "Buadiposo-Buntong", "Bubong", "Butig", "Calanogas", "Ditsaan-Ramain", "Ganassi", "Kapai", "Lumba-Bayabao", "Lumbaca-Unayan", "Lumbatan", "Lumbayanague", "Madalum", "Madamba", "Maguing", "Malabang", "Marantao", "Marawi", "Marogong", "Masiu", "Mulondo", "Pagayawan", "Piagapo", "Poona Bayabao", "Pualas", "Saguiaran", "Sultan Dumalondong", "Tagoloan II", "Tamparan", "Tubaran", "Tugaya", "Wao",
            "BASILAN:", "Akbar", "Al-Barka", "Barira", "Basilan", "Hadji Mohammad Ajul", "Hadji Muhtamad", "Isabela City", "Lamitan", "Lantawan", "Maluso", "Sumisip", "Tabuan-Lasa", "Tipo-Tipo", "Tuburan", "Ungkaya Pukan",
            "SULU:", "Hadji Panglima Tahil", "Indanan", "Jolo", "Kalingalan Caluang", "Lugus", "Luuk", "Maimbung", "Old Panamao", "Pandami", "Panglima Estino", "Pangutaran", "Parang", "Pata", "Patikul", "Siasi", "Talipao", "Tapul",
            "TAWI-TAWI:","Bongao", "Candiis", "Languyan", "Mapun", "Panglima Sugala", "Sapa-Sapa", "Sibutu", "Simunul", "Sitangkai", "South Ubian", "Tandubas", "Turtle Islands"]
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