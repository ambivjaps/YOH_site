<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_SESSION['login_id'])) {

		$id = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$item = "SELECT * FROM register WHERE login_id = $id AND user_rank = 'user'";
		$result = mysqli_query($con, $item);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}
?>

<?php 
     if(isset($_POST['edit_user'])) {
        $UID = $user['login_id'];
    
        $cust_name = mysqli_real_escape_string($con, $_POST['cust_name']);
        $cust_address = mysqli_real_escape_string($con, $_POST['cust_address']);

        $cust_city = mysqli_real_escape_string($con, $_POST['cust_city']);
        $cust_reg = mysqli_real_escape_string($con, $_POST['cust_reg']);
        $cust_zip = mysqli_real_escape_string($con, $_POST['cust_zip']);

        $cust_phone = mysqli_real_escape_string($con, $_POST['cust_phone']);
        $cust_ig = mysqli_real_escape_string($con, $_POST['cust_ig']);

        $new_image = $_FILES['cust_avatar']['name'];
        $old_image = $_POST['cust_avatar_old'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        if($new_image != '') {
            $update_filename = 'assets/img/upload/avatars/' . $unique . $_FILES['cust_avatar']['name'];
        } else {
            $update_filename = $old_image;
        }

        if(file_exists("assets/img/upload/avatars/" . $_FILES['cust_avatar']['name'])) {
        } else {
            $query = "UPDATE register SET cust_avatar='$update_filename' WHERE login_id='$UID' ";
            $query_run = mysqli_query($con, $query);

            if($query_run) {
                if($_FILES['cust_avatar']['name'] != '') {
                    move_uploaded_file($_FILES['cust_avatar']['tmp_name'], "assets/img/upload/avatars/" . $unique . $_FILES['cust_avatar']['name']);
                    unlink($old_image);
                }
            } else {
                echo "<script> alert('Problem occured.') </script>";
            }
        }
    
        $query = "UPDATE register SET cust_name='$cust_name', cust_address='$cust_address', cust_city='$cust_city', cust_reg='$cust_reg', cust_zip='$cust_zip', cust_phone='$cust_phone', cust_ig='$cust_ig' WHERE login_id=$UID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['cust_name'] = $_POST['cust_name'];
            $_SESSION['cust_address'] = $_POST['cust_address'];

            $_SESSION['cust_city'] = $_POST['cust_city'];
            $_SESSION['cust_reg'] = $_POST['cust_reg'];
            $_SESSION['cust_zip'] = $_POST['cust_zip'];

            $_SESSION['cust_phone'] = $_POST['cust_phone'];
            $_SESSION['cust_ig'] = $_POST['cust_ig'];

            header("Location: UserProfile.php");
            mysqli_close($con);
            exit();
        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Edit User Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
    
    <div class="container my-5">

    <?php if($user): ?>

        <h1 style="font-weight:bold;"> Edit User Profile <span>
        <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="UserProfile.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h1><hr>
        <div class="form-group">
            <form action="UserProfileEdit.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <h3> Personal Information </h3>

                    <div class="col-md-2">
                        <img class="img-fluid rounded avatar-fit" src="<?php echo $user['cust_avatar']; ?>" id="imgDisplay">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Avatar</label>
                        <input class="form-control rounded" type="file" onchange="readURL(this)" class="form-control form-control my-3" name="cust_avatar">
                        <input class="form-control rounded" type="hidden" onchange="readURL(this)" name="cust_avatar_old" value="<?php echo $user['cust_avatar']; ?>">
                    </div>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="cust_name" id="cust_name" class="form-control rounded" value="<?php echo $user['cust_name'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Address</label>
                        <input type="text" name="cust_address" id="cust_address" class="form-control rounded" value="<?php echo $user['cust_address'] ?>">
                    </div>

                    <div class="col-md-4">
                        <label style="font-weight:bold;">Region</label>
                        <select class="form-select rounded" name="cust_reg" id="cust_reg" required>
                            <option value="">Select Region</option>
                            <option value="I" <?php if($user['cust_reg'] == 'I') { ?>selected="selected"<?php } ?>>I - Ilocos Region</option>
                            <option value="II" <?php if($user['cust_reg'] == 'II') { ?>selected="selected"<?php } ?>>II - Cagayan Valley</option>
                            <option value="III" <?php if($user['cust_reg'] == 'III') { ?>selected="selected"<?php } ?>>III - Central Luzon</option>
                            <option value="IVA" <?php if($user['cust_reg'] == 'IVA') { ?>selected="selected"<?php } ?>>IV-A - CALABARZON</option>
                            <option value="IVB" <?php if($user['cust_reg'] == 'IVB') { ?>selected="selected"<?php } ?>>IV-B - MIMAROPA</option>
                            <option value="V" <?php if($user['cust_reg'] == 'V') { ?>selected="selected"<?php } ?>>V - Bicol Region</option>
                            <option value="VI" <?php if($user['cust_reg'] == 'VI') { ?>selected="selected"<?php } ?>>VI - Western Visayas</option>
                            <option value="VII" <?php if($user['cust_reg'] == 'VII') { ?>selected="selected"<?php } ?>>VII - Central Visayas</option>
                            <option value="VIII" <?php if($user['cust_reg'] == 'VIII') { ?>selected="selected"<?php } ?>>VIII - Eastern Visayas</option>
                            <option value="IX" <?php if($user['cust_reg'] == 'IX') { ?>selected="selected"<?php } ?>>IX - Zamboanga Peninsula</option>
                            <option value="X" <?php if($user['cust_reg'] == 'X') { ?>selected="selected"<?php } ?>>X - Northern Mindanao</option>
                            <option value="XI" <?php if($user['cust_reg'] == 'XI') { ?>selected="selected"<?php } ?>>XI - Davao Region</option>
                            <option value="XII" <?php if($user['cust_reg'] == 'XII') { ?>selected="selected"<?php } ?>>XII - SOCCSKSARGEN</option>
                            <option value="XIII" <?php if($user['cust_reg'] == 'XIII') { ?>selected="selected"<?php } ?>>XIII - Caraga Region</option>
                            <option value="CAR" <?php if($user['cust_reg'] == 'CAR') { ?>selected="selected"<?php } ?>>Cordillera Administrative Region (CAR)</option>
                            <option value="NCR" <?php if($user['cust_reg'] == 'NCR') { ?>selected="selected"<?php } ?>>National Capital Region (NCR)</option>
                            <option value="BARMM" <?php if($user['cust_reg'] == 'BARMM') { ?>selected="selected"<?php } ?>>Bangsamoro Autonomous Region in Muslim Mindanao</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">City</label>
                        <select class="form-select rounded" name="cust_city" id="cust_city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">ZIP Code</label>
                        <input type="text" name="cust_zip" id="cust_zip" class="form-control rounded" value="<?php echo $user['cust_zip'] ?>">
                    </div>
                   
                    <h3> Contact Details </h3>

                    <div class="col-md-6">
                        <label style="font-weight:bold;">Mobile Number</label>
                        <input type="text" name="cust_phone" id="cust_phone" minlength="11" maxlength="11"  onkeypress="return restrictAlphabets(event)" class="form-control rounded" value="<?php echo $user['cust_phone'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Instagram Handle</label>
                        <input type="text" name="cust_ig" id="cust_ig" class="form-control rounded" value="<?php echo $user['cust_ig'] ?>">
                    </div>

                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editUser" name="edit_user" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                <button class="btn btn-success mt-3" onClick="editUser()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>

    <script>
        document.getElementById('editUser').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editUser() {
            document.getElementById("form").submit();
        }

        function readURL(el) {
            if (el.files && el.files[0]) {
                var FR= new FileReader();
                FR.onload = function(e) {
                    $("#imgDisplay").attr("src", e.target.result);
                    socket.emit('image', e.target.result);
                    console.log(e.target.result);
                };       
                FR.readAsDataURL( el.files[0] );
            } 
        };
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

<?php require 'layouts/Footer.php';?>