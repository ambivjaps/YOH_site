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
    if(isset($_POST['submit'])) {
        $PID = $profile['id'];
    
        $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
        $c_avatar = mysqli_real_escape_string($con, $_POST['c_avatar']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        
        $region = mysqli_real_escape_string($con, $_POST['region']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $street = mysqli_real_escape_string($con, $_POST['street']);
        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        
        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
        $unit_no = mysqli_real_escape_string($con, $_POST['unit_no']);
    
        $query = "UPDATE cust_profile SET c_name='$c_name',c_avatar='$c_avatar',email='$email',address='$address',region='$region',city='$city',street='$street',barangay='$barangay',phone_no='$phone_no',zip_code='$zip_code',unit_no='$unit_no' WHERE id=$PID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['c_name'] = $_POST['c_name'];
            $_SESSION['c_avatar'] = $_POST['c_avatar'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['address'] = $_POST['address'];

            $_SESSION['region'] = $_POST['region'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['street'] = $_POST['street'];
            $_SESSION['barangay'] = $_POST['barangay'];

            $_SESSION['phone_no'] = $_POST['phone_no'];
            $_SESSION['zip_code'] = $_POST['zip_code'];
            $_SESSION['unit_no'] = $_POST['unit_no'];

            mysqli_close($con);
            header("Location: ProfileAccntView.php");
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

        <h1> Edit Profile </h1>
        <div class="form-group">
            <form action="EditCustomerProf.php?id=<?php echo $profile['id'] ?>" method="POST">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label>Avatar</label>
                        <input type="file" class="form-control form-control my-3" name="c_avatar">
                    </div>
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control" value="<?php echo $profile['c_name'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="<?php echo $profile['address'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Street</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?php echo $profile['street'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" value="<?php echo $profile['city'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Barangay</label>
                        <input type="text" name="barangay" id="barangay" class="form-control" value="<?php echo $profile['barangay'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Unit Number</label>
                        <input type="text" name="unit_no" id="unit_no" class="form-control" value="<?php echo $profile['unit_no'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Zip Code</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control" value="<?php echo $profile['zip_code'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Region</label>
                        <input type="text" name="region" id="region" class="form-control" value="<?php echo $profile['region'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label>E-mail Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $profile['email'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label>Phone Number</label>
                        <input type="text" name="phone_no" id="phone_no" class="form-control" value="<?php echo $profile['phone_no'] ?>">
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>
    
<?php require 'layouts/Footer.php';?>