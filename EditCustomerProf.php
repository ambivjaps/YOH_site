<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    
    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_SESSION['cust_id'])) {
		$id = mysqli_real_escape_string($con, $_SESSION['cust_id']);
		$item = "SELECT * FROM cust_profile WHERE c_id = $id";
		$result = mysqli_query($con, $item);
		$c_prof = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<title> Edit Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;">Edit Customer Profile</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view" id="profile" style="background: #ffffff;width: 1354px;">
                <form action="EditCustomerProf.php" method="POST">
                    <div class="row profile-row">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div class="avatar-bg center"></div>
                            </div><input class="form-control form-control" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" style="margin-bottom: 8px;margin-top: -7px;">Full Name</label>
                                        <input class="form-control" type="text" name="c_name" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['c_name'].'"'; } ?>></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label" for="name" style="margin-left: 24px;padding-left: -6px;margin-bottom: 15px;margin-top: 8px;">Street
                                    <input class="form-control item" type="text" name="street" id="name-1" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['street'].'"'; } ?>></label>
                                    <label class="form-label" for="name" style="margin-left: 31px;">Building No.
                                    <input class="form-control item" type="text" name="building" id="name-9" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['building'].'"'; } ?>></label></div>
                                </div>
                            <div class="row" style="margin-left: 28px;">
                                <div class="col-sm-12 col-md-6 col-xxl-6" style="margin-left: -41px;">
                                    <div class="form-group mb-3" style="width: 411.656px;">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control" type="email"  name="email" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['email'].'"'; } ?>></div>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="name" style="margin-left: 47px;">Zip Code<br>
                                    <input class="form-control item" type="text" name="zip_code" id="name-7" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['zip_code'].'"'; } ?>></label>
                                    <label class="form-label" for="name" style="margin-left: 28px;">Unit No.
                                    <input class="form-control item" type="text" name="unit_no" id="name-10" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['unit_no'].'"'; } ?>></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label" for="name" style="margin-left: 31px;">Region
                                    <input class="form-control item" type="text" name="region" id="name-4" style="width: 121px;margin-bottom: 4px;" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['region'].'"'; } ?>></label>
                                
                                    <label class="form-label" for="name" style="margin-left: 91px;width: 117px;">City
                                    <input class="form-control item" type="text" name="city" id="name-8" style="width: 121px;margin-bottom: 4px;" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['city'].'"'; } ?>></label></div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3"><label class="form-label">Phone Number</label>
                                    <input class="form-control" type="text" name="phone_no" required="" <?php if(isset($_SESSION['cust_id'])){ echo 'value="'.$c_prof['phone_no'].'"'; } ?>></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right">
                                    <button class="btn btn-primary form-btn" type="submit" id="submit" name="submit">SAVE </button>
                                    <button class="btn btn-danger form-btn" type="reset" id="reset" name="reset">CANCEL </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>