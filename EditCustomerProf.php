<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    
    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
        // retrieves id and current user logged in
        $current_user = $_SESSION['login_id'];

		$id = mysqli_real_escape_string($con, $_GET['id']);
        $item = "SELECT * FROM cust_profile WHERE id = $id AND login_id = $current_user";
		$result = mysqli_query($con, $item);
		$profile = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}

?>

<?php 
    if(isset($_POST['c_name'])) {
        $PID = $profile['id'];
    
        $c_label = mysqli_real_escape_string($con, $_POST['c_label']);
        $c_name = mysqli_real_escape_string($con, $_POST['c_name']);

        $address = mysqli_real_escape_string($con, $_POST['address']);
        $region = mysqli_real_escape_string($con, $_POST['region']);
        $city = mysqli_real_escape_string($con, $_POST['city']);

        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);

        $query = "UPDATE cust_profile SET c_label='$c_label',c_name='$c_name',address='$address',region='$region',city='$city',phone_no='$phone_no',zip_code='$zip_code' WHERE id=$PID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['c_label'] = $_POST['c_label'];
            $_SESSION['c_name'] = $_POST['c_name'];

            $_SESSION['address'] = $_POST['address'];
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
?>

<title> Edit Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <?php if($profile): ?>

    <div class="container my-5">

        <h1 style="font-weight:bold;"> Edit Profile <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="ProfileAccnt.php?id=<?php echo $profile['id'] ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h1><hr>
        <div class="form-group">
            <form action="EditCustomerProf.php?id=<?php echo $profile['id'] ?>" method="POST" id="form">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Label</label>
                        <input type="text" name="c_label" id="c_label" class="form-control rounded" value="<?php echo $profile['c_label'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control rounded" value="<?php echo $profile['c_name'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Address</label>
                        <input type="text" name="address" id="address" class="form-control rounded" value="<?php echo $profile['address'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Region</label>
                            <select class="form-select rounded" name="region" id="region" required>
                                <option value="">Select Region</option>
                                <option value="I" <?php if($profile['region'] == 'I') { ?>selected="selected"<?php } ?>>I - Ilocos Region</option>
                                <option value="II" <?php if($profile['region'] == 'II') { ?>selected="selected"<?php } ?>>II - Cagayan Valley</option>
                                <option value="III" <?php if($profile['region'] == 'III') { ?>selected="selected"<?php } ?>>III - Central Luzon</option>
                                <option value="IVA" <?php if($profile['region'] == 'IVA') { ?>selected="selected"<?php } ?>>IV-A - CALABARZON</option>
                                <option value="IVB" <?php if($profile['region'] == 'IVB') { ?>selected="selected"<?php } ?>>IV-B - MIMAROPA</option>
                                <option value="V" <?php if($profile['region'] == 'V') { ?>selected="selected"<?php } ?>>V - Bicol Region</option>
                                <option value="VI" <?php if($profile['region'] == 'VI') { ?>selected="selected"<?php } ?>>VI - Western Visayas</option>
                                <option value="VII" <?php if($profile['region'] == 'VII') { ?>selected="selected"<?php } ?>>VII - Central Visayas</option>
                                <option value="VIII" <?php if($profile['region'] == 'VIII') { ?>selected="selected"<?php } ?>>VIII - Eastern Visayas</option>
                                <option value="IX" <?php if($profile['region'] == 'IX') { ?>selected="selected"<?php } ?>>IX - Zamboanga Peninsula</option>
                                <option value="X" <?php if($profile['region'] == 'X') { ?>selected="selected"<?php } ?>>X - Northern Mindanao</option>
                                <option value="XI" <?php if($profile['region'] == 'XI') { ?>selected="selected"<?php } ?>>XI - Davao Region</option>
                                <option value="XII" <?php if($profile['region'] == 'XII') { ?>selected="selected"<?php } ?>>XII - SOCCSKSARGEN</option>
                                <option value="XIII" <?php if($profile['region'] == 'XIII') { ?>selected="selected"<?php } ?>>XIII - Caraga Region</option>
                                <option value="CAR" <?php if($profile['region'] == 'CAR') { ?>selected="selected"<?php } ?>>Cordillera Administrative Region (CAR)</option>
                                <option value="NCR" <?php if($profile['region'] == 'NCR') { ?>selected="selected"<?php } ?>>National Capital Region (NCR)</option>
                                <option value="BARMM" <?php if($profile['region'] == 'BARMM') { ?>selected="selected"<?php } ?>>Bangsamoro Autonomous Region in Muslim Mindanao</option>
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
                        <input type="text" name="zip_code" id="zip_code" class="form-control rounded" value="<?php echo $profile['zip_code'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Mobile Number</label>
                        <input type="text" name="phone_no" id="phone_no" class="form-control rounded" minlength="11" maxlength="11" onkeypress="return restrictAlphabets(event)" required="" value="<?php echo $profile['phone_no'] ?>">
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editProfile" name="edit_profile" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="editProfile()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
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


    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>

    <script>
        document.getElementById('editProfile').addEventListener('click', (e) => {
            var modalError = document.getElementById("myModal3");
            var errorBtn = document.getElementById("errorBtnClode");
            
            errorBtn.onclick = function() {
                modalError.style.display = "none";
            }
            
            document.getElementById('editProfile').onclick = function() {
                let fields = {
                    'c_label': 'Label',
                    'c_name': 'Name',
                    'address': 'Address',
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
            document.getElementById('editModal').style.display = 'block';
        }});

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editProfile() {
            document.getElementById("form").submit();
        }
    </script>

<script>
        // Define cities for each region
        var cities = {
            I: ["Alaminos", "Batac", "Candon", "Dagupan", "Laoag", "San Carlos", "San Fernando", "Urdaneta", " Vigan"],
            II: ["Tuguegarao", "Ilagan", "Santiago", "Cauayan"],
            III: ["Angeles", "Olongapo", "Tarlac", "San Fernando", "Malolos", "Balanga", "Palayan", "Meycauayan", " San Jose del Monte", "Cabanatuan", "Gapan", "Muñoz", "San Jose", "Mabalacat"],
            IVA: ["Antipolo", "Bacoor", "Batangas City", "Biñan", "Cabuyao", "Calamba", "Cavite City", "Dasmariñas", "General Trias", "Imus", "Lipa", "Lucena", "San Pablo", "San Pedro", "Santa Rosa", "Tagaytay", "Tanauan", "Tayabas", "Trece Martires"],
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
            NCR: ["Caloocan", "Las Piñas", "Makati", "Malabon", "Mandaluyong", "Manila", "Marikina", "Muntinlupa", " Navotas", "Parañaque", "Pasay", "Pasig", "Pareros", "Quezon City", "San Juan", "Taguig", "Valenzuela"],
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
            if((x >= 48 && x <=57 ))
                return true;
            else
                return false;
        }
        </script>
    
    
<?php require 'layouts/Footer.php';?>