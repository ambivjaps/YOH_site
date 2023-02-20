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
	}
?>

<title> Profile Account: <?php echo $profile['c_name']; ?> | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-content">
                    <div class="post-body" style="margin-top:65px;">
                        <div class="post-info">
                            <div class="profile-card" style="background: #ffffff; border-color: 0;">
                                <div class="profile-back" style="background: #CBC3E3;--bs-danger: #3546dc;--bs-danger-rgb: 53,70,220;"></div><img class="rounded-circle profile-pic" src="assets/img/avatars/nopic1.jpg">
                                <h3 class="profile-name" style="background: #cbc3e3;"><?php echo $profile['c_name']; ?></h3>
                                <p class="profile-bio">Unit No.: <?php echo $profile['unit_no']; ?></p>
                                <p class="profile-bio">Street: <?php echo $profile['street']; ?></p>
                                <p class="profile-bio">Building: <?php echo $profile['building']; ?></p>
                                <p class="profile-bio">City: <?php echo $profile['city']; ?></p>
                                <p class="profile-bio">Region: <?php echo $profile['region']; ?></p>
                                <p class="profile-bio">ZIP Code: <?php echo $profile['zip_code']; ?></p>
                                
                                <p class="profile-bio">E-mail Address: <?php echo $profile['email']; ?></p>
                                <p class="profile-bio">Phone Number: <?php echo $profile['phone_no']; ?></p>
                            </div>
                        </div>
                        <figure class="figure"></figure>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>