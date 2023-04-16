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
        // get avatar from current user
		$item_av = "SELECT * FROM register WHERE login_id = $current_user";
		$result_av = mysqli_query($con, $item_av);
		$prof_reg = mysqli_fetch_assoc($result_av);
		mysqli_free_result($result_av);
	}

    if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);

        $sql_error = "SELECT * FROM cust_profile where id = $id";
        $error_run = mysqli_query($con, $sql_error);
        if($error_run && mysqli_num_rows($error_run) > 0){
            $user_data = mysqli_fetch_assoc($error_run);
            if($user_data["cust_status"] == 1){
            header("Location: ProfileAccnt.php?id=$delete_id&delete=error");
            }
        else {

		$sql = "DELETE FROM cust_profile WHERE id = $delete_id";
            $run = mysqli_query($con, $sql);
            if($run){
                header("Location: ProfileAccntView.php?delete=success");
            }
	    }
    }
}
?>

<title> Profile Account: <?php echo $profile['c_name']; ?> | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <?php if($profile): ?>

        <main class="page blog-post">
    <section class="clean-block clean-post dark" style="background-color:#efe9ef; border:none; ">
        <div class="container">

        <form class="mb-3" action="ProfileAccnt.php?id=<?php echo $profile['id']; ?>" method="POST" id="form">
        <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;"><a href="ProfileAccntView.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
			<a class="btn btn-dark" href="EditCustomerProf.php?id=<?php echo $profile['id'] ?>" type="submit" name="edit" role="button" style="border-color:indigo;background:indigo;font-weight:bold;"><i class="fas fa-edit"></i> Edit</a>
			<input type="hidden" class="delete_id" name="delete_id" value="<?php echo $profile['id']; ?>">
			<input class="btn btn-danger" name="delete" role="button" value="Delete" style="font-weight:bold;width: 8%;">
		</form>

    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body" style="background: #efe9ef;">
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar" >
                        <img src="<?php echo $prof_reg['cust_avatar']; ?>" style="height:200px; width:200px;" title="<?php echo $profile['c_name']; ?>" alt="<?php echo $profile['c_name']; ?>">
                    </div>
                    <h5 class="user-name" style="font-weight: bold; font-size:40px; color: var(--bs-indigo);"><?php echo $profile['c_name']; ?></h5>
                    <p style="font-weight: bold; "><?php echo $profile['phone_no']; ?></p>
                </div>
            </div>

        </div>
    </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body" style="background: #efe9ef;">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 style="font-weight: bold; font-size:40px; text-align:center; " >Customer Details</h6>
                    <?php 
                if (isset($_GET['delete']) && $_GET['delete'] === 'error') { ?>
                    <p class="rounded" style="font-weight:bold;text-align:center;color:white;background-color:red;">
                     Error in deleting profile. 
                    Profile in use cannot be deleted. 
                    <p>     
                <?php } ?> 
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Label</label>
                        <p class="rounded" style="font-size:25px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['c_label']; ?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Address</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['address']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">City</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['city']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Region</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['region']; ?></p>
                    </div>
                </div>
                <div class="col-md-4" style="position:center;">
                    <div class="form-group">
                        <label style="font-weight:bold; font-size:30px;">ZIP Code</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['zip_code']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">E-mail Address</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $prof_reg['cust_email']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Instagram Handle</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $prof_reg['cust_ig']; ?></p>
                    </div>
                </div>
            </div>     
        </div>
    </div>
    </div>
    </div>
    </div>
            <?php else: ?>
                <div class="container my-5">
                    <h2> Oops.. Page not found. Please try again. </h2>
                </div>
            <?php endif ?>

        </section>
       <div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this?</p>
                <div class="modal-footer">
                
                <button class="btn mt-3" onClick="deleteProfile()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;color:white;">OK
                <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $profile['id']; ?>">
                    </button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
                </div>
            </div>
        </div> 
    </main>
    
    <script>
        document.getElementsByName('delete')[0].addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('deleteModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        function deleteProfile() {
            document.getElementById("form").submit();
        }
    </script>
        
<?php require 'layouts/Footer.php';?>