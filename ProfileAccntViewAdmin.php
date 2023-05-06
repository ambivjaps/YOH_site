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
    $item = "SELECT * FROM cust_profile WHERE id = $id";
    $result = mysqli_query($con, $item);
    $profile = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    // get avatar from current user
    
    $current_user = $profile['login_id'];
    $item_av = "SELECT * FROM register WHERE login_id = $current_user";
    $result_av = mysqli_query($con, $item_av);
    $prof_reg = mysqli_fetch_assoc($result_av);
    mysqli_free_result($result_av);
}

if(isset($_POST['delete'])) {
    $delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);

    $delete_id = $_POST['delete_id'];

    $sql = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id WHERE orders_db.c_id = $delete_id";
    $result = $con->query($sql);
    $fetch = mysqli_fetch_assoc($result);

    if ($result->num_rows > 0) {
        $sql = "SELECT * FROM orders_db WHERE c_id = $delete_id AND OrderType = 'On-Going'";
        $result1 = $con->query($sql);
        if($result1->num_rows > 0){
        echo '<script> window.location.replace("ProfileAccntViewAdmin.php?id='.$id.'&profile=error");</script>';
    } else {
        $sql1 = "DELETE
                 FROM cust_profile
                 WHERE c_id = $delete_id";
        $result1 = mysqli_query($con, $sql1);

        $sql2 = "DELETE
                 FROM orders_db
                 WHERE c_id = $delete_id";
        $result2 = $con->query($sql2);

        $sql3 = "DELETE
                 FROM register
                 WHERE login_id = $delete_id";
        $result3 = $con->query($sql3);
        ?>
            <script>
                window.location.replace("CustomerProfileListAdmin.php");
            </script>
        <?php
         }
        } else {
        $sql1 = "DELETE
                 FROM cust_profile
                 WHERE c_id = $delete_id";
        $result1 = mysqli_query($con, $sql1);

        $sql3 = "DELETE
                 FROM register
                 WHERE login_id = $delete_id";
        $result3 = $con->query($sql3);
        ?>
            <script>
                window.location.replace("CustomerProfileListAdmin.php");
            </script>
        <?php
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
        <form class="mb-3" action="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>" method="POST" id="form">
        <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: indigo;background: indigo;"><a href="CustomerProfileListAdmin.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
        <input class="btn btn-danger" name="delete" role="button" value="Delete" style="width: 8%; font-weight:bold;">
        <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $profile['c_id']; ?>">
    </form>
    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body" style="background:#efe9ef;">
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar" >
                        <img src="<?php echo $prof_reg['cust_avatar']; ?>" style="height:200px; width:200px;" title="<?php echo $profile['c_name']; ?>" alt="<?php echo $profile['c_name']; ?>">
                    </div>
                    <h5 class="user-name" style="font-weight: bold; font-size:40px; color:indigo"><?php echo $profile['c_name']; ?></h5>
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
                    <h6 style="font-weight: bold; font-size:40px; text-align:center; " >Customer Details</h6>
                    <?php 
                if (isset($_GET['profile']) && $_GET['profile'] === 'error') { ?>
                    <p class="rounded" style="font-weight:bold;text-align:center;color:white;background-color:red;">
                     Error in deleting profile. 
                    Customer has an on-going order. 
                    <p>     
                <?php } ?> 
                    <hr>
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

        <div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this profile?
                <br><br> WARNING: All user data it contains such as orders will also be deleted from the system. </p>
                <div class="modal-footer">
                <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $profile['c_id']; ?>">
                    <button class="btn btn-success mt-3" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;" onClick="deleteProfile()">OK</button>
                    <button class="btn mt-3" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;" onClick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
        </section>
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