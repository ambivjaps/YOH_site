<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<title> Tracking Details | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;">Tracking Details</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view" id="profile" style="background: #ffffff;width: 1000px;">
                <div class="row">
                    <div class="col-md-12 alert-col relative">
                        <div class="alert alert-info alert-dismissible absolue center" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><span> </span></div>
                    </div>
                </div>
                <form>
                    
                        <div class="col-md-">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Courier<br><input class="form-control item" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Tracking ID<br><input class="form-control item" type="text" id="name-3" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit">SAVE </button><a class="btn btn-danger form-btn" role="button" href="OrderPageAdmin.php">CANCEL </a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>