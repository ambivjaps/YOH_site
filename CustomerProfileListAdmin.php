<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    require 'layouts/Header.php';
?>

<title> Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark" style="background-color:#efe9ef;">
        <div class="container">
                <div class="block-heading">
                    <h2 style="margin:54px; color:black; font-size:54px; ">Customer Profiles</h2>
                </div>
                <div class="block-content">
                    <div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/avatars/nopic1.jpg" style="margin-left:125px;" ></div>
                            <div class="col-lg-7">
                                <h3><a href="ProfileAccntViewAdmin.php" style="color:black;">Customer A</a></h3>
                                <div class="info"><span class="text-muted">Last Ordered on Jan 16, 2018&nbsp;<a href="ProfileAccntView.php"></a></span></div><button class="btn btn-outline-primary btn-sm" type="button">Delete Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/avatars/nopic1.jpg" style="margin-left:125px;" ></div>
                            <div class="col-lg-7">
                                <h3><a href="ProfileAccntViewAdmin.php" style="color:black;"><strong>Customer B</strong><br></a></h3>
                                <div class="info"><span class="text-muted">Last Ordered on Jan 16, 2018&nbsp;<a href="ProfileAccntView.php"></a></span></div><button class="btn btn-outline-primary btn-sm" type="button">Delete Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/avatars/nopic1.jpg" style="margin-left:125px;" ></div>
                            <div class="col-lg-7">
                                <h3><a href="ProfileAccntViewAdmin.php" style="color:black;">Customer C</a></h3>
                                <div class="info"><span class="text-muted">Last Ordered on Jan 16, 2018&nbsp;<a href="ProfileAccntView.php"></a></span></div><button class="btn btn-outline-primary btn-sm" type="button">Delete Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="clean-blog-post">
                        <div class="row">
                            <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/avatars/nopic1.jpg" style="margin-left:125px;" ></div>
                            <div class="col-lg-7">
                                <h3><a href="ProfileAccntViewAdmin.php" style="color:black;">Customer D</a></h3>
                                <div class="info"><span class="text-muted">Last Ordered on Jan 16, 2018&nbsp;<a href="ProfileAccntView.php"></a></span></div><button class="btn btn-outline-primary btn-sm" type="button">Delete Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
	
<?php require 'layouts/Footer.php';?>