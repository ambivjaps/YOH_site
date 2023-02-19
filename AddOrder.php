<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    require 'layouts/Header.php';
?>

<title> Add Order | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;">New Order</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view" id="profile" style="background: #ffffff;width: 1354px;">
                <div class="row">
                    <div class="col-md-12 alert-col relative">
                        <div class="alert alert-info alert-dismissible absolue center" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><span>Profile save with success</span></div>
                    </div>
                </div>
                <form>
                    <div class="row profile-row">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div class="avatar-bg center"></div>
                            </div><input class="form-control form-control" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Customer ID<br><input class="form-control item" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Product Cost<br><input class="form-control item" type="text" id="name-3" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Order Quantity<br><input class="form-control item" type="text" id="name-6" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="form-label" for="name" style="margin-left: 31px;">Materials Used<br></label><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal1" style="margin: 16px;">Add Materials</button></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit" href="OrdersAdminView.php" >SAVE </button><a class="btn btn-danger form-btn" role="button" href="OrdersAdminView.php">CANCEL </a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>