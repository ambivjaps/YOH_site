<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<title> Profile Account | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post">
        <section class="clean-block clean-post dark" style="height: 1042.25px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-content">
                    <div class="post-body" style="height: 715.25px;margin-top:65px;">
                        <div class="post-info">
                            <div class="profile-card" style="height: 569.641px;background: #ffffff; border-color: 0;">
                                <div class="profile-back" style="background: #CBC3E3;--bs-danger: #3546dc;--bs-danger-rgb: 53,70,220;"></div><img class="rounded-circle profile-pic" src="assets/img/avatars/nopic1.jpg">
                                <h3 class="profile-name" style="background: #cbc3e3;">Customer Name</h3>
                                <br> <br>
                                <p class="profile-bio" style="padding-bottom: 81px;margin: 4px;margin-bottom: 62px;margin-top: -36px;padding-top: 0px;height: 203.047px;">Data Information 1</p>
                            </div>
                        </div>
                        <figure class="figure"></figure>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>