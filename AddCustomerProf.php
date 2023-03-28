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

        $address = mysqli_real_escape_string($con, $_POST['address']);
        $region = mysqli_real_escape_string($con, $_POST['region']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $street = mysqli_real_escape_string($con, $_POST['street']);

        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
        $unit_no = mysqli_real_escape_string($con, $_POST['unit_no']);
        
        $sql = "SELECT cust_status from cust_profile where c_id = $CID";
            $sql_run = mysqli_query($con, $sql);

        if ($sql_run && mysqli_num_rows($sql_run) < 3) {
             $user_data = mysqli_fetch_assoc($sql_run);
            if($user_data['cust_status'] == NULL || $user_data['cust_status'] == '0'){
                 $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, street, barangay, phone_no, zip_code, unit_no, login_id, cust_status) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$street', '$barangay', '$phone_no', '$zip_code', '$unit_no', '$CID', '1')";
                 $query_run = mysqli_query($con, $query);
             }else{
            
        $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, street, barangay, phone_no, zip_code, unit_no, login_id) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$street', '$barangay', '$phone_no', '$zip_code', '$unit_no', '$CID')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['c_name'] = $_POST['c_name'];
            $_SESSION['c_label'] = $_POST['c_label'];

            $_SESSION['address'] = $_POST['address'];
            $_SESSION['region'] = $_POST['region'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['street'] = $_POST['street'];

            $_SESSION['barangay'] = $_POST['barangay'];
            $_SESSION['phone_no'] = $_POST['phone_no'];
            $_SESSION['zip_code'] = $_POST['zip_code'];
            $_SESSION['unit_no'] = $_POST['unit_no'];

            
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
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control rounded" required>
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Address</label>
                        <input type="text" name="address" id="address" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Street</label>
                        <input type="text" name="street" id="street" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">City</label>
                        <input type="text" name="city" id="city" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Barangay</label>
                        <input type="text" name="barangay" id="barangay" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Unit Number</label>
                        <input type="text" name="unit_no" id="unit_no" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Zip Code</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Region</label>
                        <input type="text" name="region" id="region" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Phone Number</label>
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
                    'address': 'Address',
                    'street': 'Street',
                    'city': 'City',
                    'barangay': 'Barangay',
                    'unit_no': 'Unit No.',
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

        function restrictAlphabets(e){
            var x = e.which || e.keycode;
            if((x >= 48 & x <= 57))
                return true;
            else
                return false;
        }

        </script>
    
      
        
<?php require 'layouts/Footer.php';?>