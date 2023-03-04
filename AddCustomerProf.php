<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

?>

<title> Add Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
		
    <div class="container my-5">

        <h1> Add Profile </h1>
        <div class="form-group">
            <form action="AddCustomerProf.php" method="POST">
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