<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

?>

<?php 
    if(isset($_POST['c_name'])) {
        $CID = $_SESSION['login_id'];

        $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
        $c_label = mysqli_real_escape_string($con, $_POST['c_label']);

        $address = mysqli_real_escape_string($con, $_POST['address_1']).", ".mysqli_real_escape_string($con, $_POST['address_2']);
        $region = mysqli_real_escape_string($con, $_POST['region']);
        $city = mysqli_real_escape_string($con, $_POST['city']);

        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
        
        $sql = "SELECT * from cust_profile where c_id = $CID";
            $sql_run = mysqli_query($con, $sql);

        if ($sql_run && mysqli_num_rows($sql_run) < 3) {
             $user_data = mysqli_fetch_assoc($sql_run);
            if(empty($user_data['cust_status'])){
                 $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, phone_no, zip_code, login_id, cust_status) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$phone_no', '$zip_code', '$CID', 1)";
                 $query_run = mysqli_query($con, $query);
             }else if($user_data['cust_status'] == 0){
                $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, phone_no, zip_code, login_id, cust_status) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$phone_no', '$zip_code', '$CID', 1)";
                $query_run = mysqli_query($con, $query);
             }else{
        $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, phone_no, zip_code, login_id) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$phone_no', '$zip_code', '$CID')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['c_name'] = $_POST['c_name'];
            $_SESSION['c_label'] = $_POST['c_label'];

            $_SESSION['region'] = $_POST['region'];
            $_SESSION['city'] = $_POST['city'];

            $_SESSION['phone_no'] = $_POST['phone_no'];
            $_SESSION['zip_code'] = $_POST['zip_code'];
 
            header("Location: ProfileAccntView.php");
            mysqli_close($con);
            
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    } 
    header("Location: ProfileAccntView.php");
    mysqli_close($con);
    
    exit();
 }else  if ($sql_run && mysqli_num_rows($sql_run) >= 3 ) {
    header("Location: ProfileAccntView.php?profile=error");
 }
}
?>
<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add Customer Profile | Yarn Over Hook </title>
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
        #myModal3 {
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


<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
		
    <div class="container my-5">

        <h1 style="font-weight:bold;"> Add Profile <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="ProfileAccntView.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h1><hr>
        <div class="form-group">
            <form action="AddCustomerProf.php" method="POST" id="form">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Label</label>
                        <input type="text" name="c_label" id="c_label" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Address</label><br>
                        <label> House no./Lot no./Block no./Unit no., Street </label>
                        <input type="text" name="address_1" id="address_1" class="form-control rounded" required>
                        <label>Village/Subdivision, Building, Barangay</label>
                        <input type="text" name="address_2" id="address_2" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Region</label>
                            <select class="form-select rounded" name="region" id="region" required>
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
                    <div class="col-md-4">
                        <label style="font-weight:bold;">City</label>
                        <select class="form-select rounded" name="city" id="city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">ZIP Code</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Mobile Number</label>
                        <input type="text" name="phone_no" id="phone_no" minlength="11" maxlength="11" onkeypress="return restrictAlphabets(event)" class="form-control rounded" required>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="add-btn"  name="add_profile" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;">
                    </div>
                </div>
            </form>
        </div>

        <div id="addModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to add this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="addProfile()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
                </div>
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
            document.getElementById('add-btn').addEventListener('click', (e) => {
            var modalError = document.getElementById("myModal3");
            var errorBtn = document.getElementById("errorBtnClode");
            
            errorBtn.onclick = function() {
                modalError.style.display = "none";
            }
            
            document.getElementById('add-btn').onclick = function() {
                let fields = {
                    'c_label': 'Label',
                    'c_name': 'Name',
                    'address_1': 'Address Line 1',
                    'address_2': 'Address Line 2',
                    'city': 'City',
                    'zip_code': 'Zip code',
                    'region': 'Region',
                    'phone_no': 'Phone Number',
                    
                }

                for (const key in fields) {
                    if (document.getElementsByName(key)[0].value.length === 0) {
                        document.getElementById('error-message').innerHTML = fields[key] + ' is required';
                        modalError.style.display = "block";
                        return;
                    }
                }
                
            e.preventDefault();
            document.getElementById('addModal').style.display = 'block';
        }});

        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function addProfile() {
            
            document.getElementById("form").submit();
        }
    
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
        $("#region").on("change", function() {
            var selectedRegion = $(this).val();
            var citySelect = $("#city");
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
            if((x >= 48 & x <= 57))
                return true;
            else
                return false;
        }

        </script>
    
      
        
<?php require 'layouts/Footer.php';?>