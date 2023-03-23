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
        $cust_unit = mysqli_real_escape_string($con, $_POST['cust_unit']);
        $cust_st = mysqli_real_escape_string($con, $_POST['cust_st']);

        $cust_brgy = mysqli_real_escape_string($con, $_POST['cust_brgy']);
        $cust_city = mysqli_real_escape_string($con, $_POST['cust_city']);
        $cust_reg = mysqli_real_escape_string($con, $_POST['cust_reg']);
        $cust_zip = mysqli_real_escape_string($con, $_POST['cust_zip']);

        $cust_email = mysqli_real_escape_string($con, $_POST['cust_email']);
        $cust_phone = mysqli_real_escape_string($con, $_POST['cust_phone']);

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
    
        $query = "UPDATE register SET cust_name='$cust_name', cust_address='$cust_address', cust_unit='$cust_unit', cust_st='$cust_st', cust_brgy='$cust_brgy', cust_city='$cust_city', cust_reg='$cust_reg', cust_zip='$cust_zip', cust_email='$cust_email', cust_phone='$cust_phone' WHERE login_id=$UID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['cust_name'] = $_POST['cust_name'];
            $_SESSION['cust_address'] = $_POST['cust_address'];
            $_SESSION['cust_unit'] = $_POST['cust_unit'];
            $_SESSION['cust_st'] = $_POST['cust_st'];

            $_SESSION['cust_brgy'] = $_POST['cust_brgy'];
            $_SESSION['cust_city'] = $_POST['cust_city'];
            $_SESSION['cust_reg'] = $_POST['cust_reg'];
            $_SESSION['cust_zip'] = $_POST['cust_zip'];

            $_SESSION['cust_email'] = $_POST['cust_email'];
            $_SESSION['cust_phone'] = $_POST['cust_phone'];

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
                        <img class="img-fluid rounded" src="<?php echo $user['cust_avatar']; ?>" id="imgDisplay">
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
                        <input type="email" name="cust_email" id="cust_email" class="form-control rounded" value="<?php echo $user['cust_email'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Phone Number</label>
                        <input type="text" name="cust_phone" id="cust_phone" class="form-control rounded" value="<?php echo $user['cust_phone'] ?>">
                    </div>

                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editUser" name="edit_user" value="Submit" style="width:150px;border-color:rgb(119,13,253);background-color:rgb(119,13,253);">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button onClick="editUser()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
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

<?php require 'layouts/Footer.php';?>