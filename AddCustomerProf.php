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
    if(isset($_POST['submit'])) {
        $CID = $_SESSION['login_id'];

        $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        
        $region = mysqli_real_escape_string($con, $_POST['region']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $street = mysqli_real_escape_string($con, $_POST['street']);
        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        
        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
        $unit_no = mysqli_real_escape_string($con, $_POST['unit_no']);

        $image = $_FILES['c_avatar']['name'];
        $temp_name = $_FILES['c_avatar']['tmp_name'];  
        
            if(isset($image) and !empty($image)){
                $location = './assets/img/avatars/';     
                $saveImage = 'assets/img/avatars/' .$_FILES['c_avatar']['name']; 

                if(move_uploaded_file($temp_name, $location.$image)){
                    echo '';
                }
            } else {
                $saveImage = 'assets/img/avatars/nopic1.jpg';
            }
        
        $query = "INSERT INTO cust_profile (c_id, c_name, c_avatar, email, address, region, city, street, barangay, phone_no, zip_code, unit_no, login_id) VALUES ('$CID', '$c_name', '$saveImage', '$email', '$address', '$region', '$city', '$street', '$barangay', '$phone_no', '$zip_code', '$unit_no', '$CID')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['c_name'] = $_POST['c_name'];
            $_SESSION['email'] = $_POST['email'];
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
?>

<title> Add Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
		
    <div class="container my-5">

        <h1> Add Profile </h1>
        <div class="form-group">
            <form action="AddCustomerProf.php" method="POST" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label>Avatar</label>
                        <input type="file" class="form-control form-control my-3" name="c_avatar">
                    </div>
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Street</label>
                        <input type="text" name="street" id="street" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Barangay</label>
                        <input type="text" name="barangay" id="barangay" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Unit Number</label>
                        <input type="text" name="unit_no" id="unit_no" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Zip Code</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Region</label>
                        <input type="text" name="region" id="region" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>E-mail Address</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Phone Number</label>
                        <input type="text" name="phone_no" id="phone_no" class="form-control">
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>
        
<?php require 'layouts/Footer.php';?>