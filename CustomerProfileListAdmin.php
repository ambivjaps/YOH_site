<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);
    
    require 'layouts/Header.php';

    $sql = "SELECT * FROM cust_profile where cust_status='1' ORDER BY id ";
	$result = mysqli_query($con, $sql);
	$profiles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $query = mysqli_num_rows($result);
	mysqli_free_result($result);
?>

<title> Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark" style="background-color:#efe9ef;">
        <div class="container">
                <div class="block-heading">
                    <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Customer Profiles</h2>
                </div>
                <div class="block-content">
                <?php foreach($profiles as $profile): ?>
                    <div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5">
                                <?php 
                                    $current_user = $profile['login_id'];
                                    $item_av = "SELECT * FROM register WHERE login_id = $current_user";
                                    $result_av = mysqli_query($con, $item_av);
                                    $prof_avatar = mysqli_fetch_assoc($result_av);
                                    mysqli_free_result($result_av);
                                ?>
                                <a href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>">
                                    <img class="rounded img-fluid" src="<?php echo $prof_avatar['cust_avatar']; ?>" title="<?php echo $profile['c_name']; ?>" alt="<?php echo $profile['c_name']; ?>" style="margin-left:125px;width:auto;height:auto;">
                                </a>
                            </div>
                            <div class="col-lg-7">
                                <h4><a href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>" style="color:black;text-decoration:none;font-weight:bold; font-size:35px;"><?php echo $profile['c_name']; ?></a></h4>
                  
                                <div class="info">
                                    <?php 
                                        $current_user = $profile['login_id'];
                                        $item_order = "SELECT * FROM orders_db WHERE c_id = $current_user ORDER BY OrderID DESC LIMIT 1";
                                        $result_order = mysqli_query($con, $item_order);
                                        $latest_order = mysqli_fetch_assoc($result_order);
                                        mysqli_free_result($result_order);
                                    ?>
                                    <span class="text-muted">Last Ordered on <i> <?php echo date("F d, Y h:i:s A (l)", strtotime($latest_order['OrderDate'])); ?> </i> &nbsp;</span>
                                </div>
                                <a class="btn btn-sm btn-primary" href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>" role="button" style="border-color: rgb(119,13,253);background: rgb(119,13,253);"><i class="fas fa-eye"></i> View</a>
                            </div>
                        </div>
                    </div>
                <hr><?php endforeach; ?>   
                </div>
            </div>
        </section>
    </main>
	
<?php require 'layouts/Footer.php';?>