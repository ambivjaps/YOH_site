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
		$item = "SELECT * FROM register WHERE login_id = $id";
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
            <h3><strong> User Profile </strong></h3><hr>

            <div class="col-md-2">
                <img class="img-fluid" src="assets/img/avatars/nopic1.jpg">
            </div>

            <div class="col-md-10">
                <h1> <?php echo $user['cust_name'] ?> </h1>
                <p> Address: <?php echo $user['cust_address'] ?> </p>
                <p> Phone Number: <?php echo $user['cust_phone'] ?> </p>
                <p> Email: <?php echo $user['cust_email'] ?> </p>
                <p> User since <?php echo date("F d, Y", strtotime($user['date'])); ?>  </p>
            </div>
        </div>

        <div class="row my-3">
            <div class="float-end mt-2">
                <a class="btn btn-dark" href="ProfileAccntView.php" role="button"> See your customer profiles </a>
                <a class="btn btn-dark" href="OrderPageCust.php" role="button"> See your orders </a>
                <a class="btn btn-dark" href="ResetPass.php" role="button"> Change password </a>
            </div>
        </div>

        <?php else: ?>
                <div class="container my-5">
                    <h2> Oops.. Page not found. Please try again. </h2>
                </div>
        <?php endif ?>
    </div>

<?php require 'layouts/Footer.php';?>