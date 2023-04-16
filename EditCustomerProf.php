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
                        <input type="text" name="region" id="region" class="form-control rounded" value="<?php echo $profile['region'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">City</label>
                        <input type="text" name="city" id="city" class="form-control rounded" value="<?php echo $profile['city'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Zip Code</label>
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
        function restrictAlphabets(e){
            var x = e.which || e.keycode;
            if((x >= 48 && x <=57 ))
                return true;
            else
                return false;
        }
        </script>
    
    
<?php require 'layouts/Footer.php';?>