<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_SESSION['login_id'])) {

		$id = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$item = "SELECT * FROM register WHERE login_id = $id AND user_rank = 'admin'";
		$result = mysqli_query($con, $item);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

	}

?>

<title> User Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">

        <?php if($user): ?>

        <div class="row my-3">
            <h3 style="font-weight:bold;"><strong> <i class="fas fa-user"></i> User Profile </strong></h3><hr>

            <div class="col-md-2">
                <img class="img-fluid rounded" src="<?php echo $user['cust_avatar'] ?>" title="<?php echo $user['cust_name'] ?>" alt="<?php echo $user['cust_name'] ?>">
            </div>

            <div class="col-md-10">
                <h1 style="font-weight:bold;color: rgb(111, 66, 193);"> <?php echo $user['cust_name'] ?> </h1>
                <h6 style="font-weight:bold;"> <span class="badge" style="background-color:#507963;"> Administrator </span></h6>
                <p style="font-weight:bold;"> Address: <span style="font-weight:lighter;color:indigo;"> <?php echo $user['cust_address'] ?></span> </p>
                <p style="font-weight:bold;"> Phone Number: <span style="font-weight:lighter;color:indigo;"><?php echo $user['cust_phone'] ?></span> </p>
                <p style="font-weight:bold;"> E-mail: <span style="font-weight:lighter;color:indigo;"><?php echo $user['cust_email'] ?></span> </p>
                <p style="font-weight:bold;"> Account last updated on: <i> <span style="font-weight:lighter;color:indigo;"><?php echo date("F d, Y", strtotime($user['date'])); ?></span></i></p>
            </div>

            <div class="float-end mt-2">
                <a class="btn btn-dark" href="UserProfileAdminEdit.php" role="button" style="border-color:indigo;background-color:indigo;font-weight:bold;"> Edit Profile </a>
                <a class="btn btn-dark" href="ChangePasswordAdmin.php" role="button" style="border-color:indigo;background-color:indigo;font-weight:bold;"> Change Password </a>
            </div>
        </div>
        
        <?php else: ?>
                <div class="container my-5">
                    <h2> Oops.. Page not found. Please try again. </h2>
                </div>
        <?php endif ?>
    </div>

<?php require 'layouts/Footer.php';?>