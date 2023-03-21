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
    
        $query = "UPDATE register SET cust_name='$cust_name' WHERE login_id=$UID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['cust_name'] = $_POST['cust_name'];

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
        <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: #AC99CF;background: #AC99CF;width:40px;"><a href="UserProfile.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h1><hr>
        <div class="form-group">
            <form action="UserProfileEdit.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <h3> Personal Information </h3>

                    <div class="col-md-2">
                        <img class="img-fluid rounded" src="<?php echo $user['cust_avatar']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Avatar</label>
                        <input class="form-control rounded" type="file" class="form-control form-control my-3" name="cust_avatar">
                        <input class="form-control rounded" type="hidden" name="cust_avatar_old" value="<?php echo $user['cust_avatar']; ?>">
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
                        <label style="font-weight:bold;">Unit</label>
                        <input type="text" name="cust_unit" id="cust_unit" class="form-control rounded" value="<?php echo $user['cust_unit'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Street</label>
                        <input type="text" name="cust_st" id="cust_st" class="form-control rounded" value="<?php echo $user['cust_st'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Barangay</label>
                        <input type="text" name="cust_brgy" id="cust_brgy" class="form-control rounded" value="<?php echo $user['cust_brgy'] ?>">
                    </div>

                    <div class="col-md-4">
                        <label style="font-weight:bold;">City</label>
                        <input type="text" name="cust_city" id="cust_city" class="form-control rounded" value="<?php echo $user['cust_city'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Region</label>
                        <input type="text" name="cust_reg" id="cust_reg" class="form-control rounded" value="<?php echo $user['cust_reg'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">ZIP Code</label>
                        <input type="text" name="cust_zip" id="cust_zip" class="form-control rounded" value="<?php echo $user['cust_zip'] ?>">
                    </div>
                   
                    <h3> Contact Details </h3>
                    
                    <div class="col-md-6">
                        <label style="font-weight:bold;">E-mail Address</label>
                        <input type="text" name="cust_email" id="cust_email" class="form-control rounded" value="<?php echo $user['cust_email'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Phone Number</label>
                        <input type="text" name="cust_phone" id="cust_phone" class="form-control rounded" value="<?php echo $user['cust_phone'] ?>">
                    </div>

                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="editUser" name="edit_user" value="Submit" style="width:150px;border-color:rgb(119,13,253);background-color:rgb(119,13,253);">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;">
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