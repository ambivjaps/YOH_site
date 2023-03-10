<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);
    
    require 'layouts/Header.php';

    $sql = "SELECT * FROM cust_profile ORDER BY id";
	$result = mysqli_query($con, $sql);
	$profiles = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($con);
?>

<title> Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark" style="background-color:#efe9ef;">
        <div class="container">
                <div class="block-heading">
                    <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;"">Customer Profiles</h2>
                </div>
                <div class="block-content">
                <?php foreach($profiles as $profile): ?>
                    <div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5">
                                <img class="rounded img-fluid" src="<?php echo $profile['c_avatar']; ?>" style="margin-left:125px;">
                            </div>
                            <div class="col-lg-7">
                                <h3><a href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>" style="color:black;"><?php echo $profile['c_name']; ?></a></h3>
                                <div class="info">
                                    <span class="text-muted">Last Ordered on Jan 16, 2018&nbsp;</span>
                                </div>
                                <button class="btn btn-outline-primary btn-sm" type="button">Delete Profile</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>   
                </div>
            </div>
        </section>
    </main>
	
<?php require 'layouts/Footer.php';?>