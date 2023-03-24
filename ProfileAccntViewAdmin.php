<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$item = "SELECT * FROM cust_profile WHERE id = $id AND cust_status='1'";
		$result = mysqli_query($con, $item);
		$profile = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}
	
	if(isset($_POST['delete'])) {
	    $delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);
	    $sql = "DELETE FROM cust_profile WHERE c_id = $delete_id";
	    
	    if(mysqli_query($con, $sql)) {
	        header('Location: CustomerProfileListAdmin.php');
	    } else {
	        echo 'Error: ' . mysqli_error($con);
	    }
	}
?>

<title> Profile Account: <?php echo $profile['c_name']; ?> | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100" >

<?php require 'layouts/nav.php';?>

    <?php if($profile): ?>

        <main class="page blog-post">
    <section class="clean-block clean-post dark" style="background-color:#efe9ef; border:none; ">
    <form class="mb-3" method="POST" id="form">
        <div class="container">
        <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: #AC99CF;background: #AC99CF;"><a href="CustomerProfileListAdmin.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
        
            <input class="btn btn-danger" name="delete" role="button" value="Delete" style="width: 8%">
    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body" style="background:#efe9ef;">
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php 
                            $current_user = $profile['login_id'];
                            $item_av = "SELECT * FROM register WHERE login_id = $current_user";
                            $result_av = mysqli_query($con, $item_av);
                            $prof_avatar = mysqli_fetch_assoc($result_av);
                            mysqli_free_result($result_av);
                        ?>
                        <img src="<?php echo $prof_avatar['cust_avatar']; ?>" style="height:200px; width:200px;" title="<?php echo $profile['c_name']; ?>" alt="<?php echo $profile['c_name']; ?>">
                    </div>
                    <h5 class="user-name" style="font-weight: bold; font-size:40px; color: var(--bs-indigo);"><?php echo $profile['c_name']; ?></h5>
                    <p style="font-weight: bold; "><?php echo $profile['phone_no']; ?></p>
                </div>
            </div>

        </div>
    </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12" style="background-color:#efe9ef;">
    <div class="card h-100">
        <div class="card-body" style="background: #efe9ef;">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 style="font-weight: bold; font-size:40px; text-align:center; " >Shipping Details</h6>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Label</label>
                        <p class="rounded" style="font-size:25px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['c_label']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Customer ID</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['c_id']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Address</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['address']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold; font-size:30px; ">Unit Number</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['unit_no']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; " >Barangay</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['barangay']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">City</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['city']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Street</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['street']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label style="font-weight:bold;font-size:30px; ">Region</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['region']; ?></p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-10" style="position:center;">
                    <div class="form-group">
                        <label style="font-weight:bold; font-size:30px;">Zip Code</label>
                        <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $profile['zip_code']; ?></p>
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
            
            <div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this?</p>
                <div class="modal-footer">
                <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $profile['c_id']; ?>" >
                    <button onClick="deleteAccountForm()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>

        <script>
            document.getElementsByName('delete')[0].addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('deleteModal').style.display = 'block';
            });

            function closeModal() {
                document.getElementById('deleteModal').style.display = 'none';
            }

            function deleteAccountForm() {
                document.getElementById("form").submit();
            }
        </script>

        </section>
    </main>
  
<?php require 'layouts/Footer.php';?>