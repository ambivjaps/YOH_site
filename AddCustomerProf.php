<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<title> Add Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
		
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
            <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black; font-weight:bold;">New Order</h2>
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
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3"><label class="form-label" style="margin-bottom: 8px;margin-top: -7px;">Full Name</label><input class="form-control" type="text" name="firstname"></div>
                                </div>
                                <div class="col-sm-12 col-md-6"><label class="form-label" for="name" style="margin-left: 24px;padding-left: -6px;margin-bottom: 15px;margin-top: 8px;">Street No.<input class="form-control item" type="text" id="name-1" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required=""></label><label class="form-label" for="name" style="margin-left: 31px;">Building No.<input class="form-control item" type="text" id="name-9" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required=""></label></div>
                            </div>
                            <div class="row" style="margin-left: 28px;">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-xxl-6" style="margin-left: -41px;">
                                    <div class="form-group mb-3" style="width: 411.656px;"><label class="form-label">Email Address</label><input class="form-control" type="password" name="password" autocomplete="off" required="" style="width: 410.641px;"></div>
                                </div>
                                <div class="col"><label class="form-label" for="name" style="margin-left: 47px;">Zip Code<br><input class="form-control item" type="text" id="name-7" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required=""></label><label class="form-label" for="name" style="margin-left: 28px;">Unit No.<input class="form-control item" type="text" id="name-10" style="width: 121px;margin-bottom: 4px;min-width: 76px;" required=""></label></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6"><label class="form-label" for="name" style="margin-left: 31px;">Region<input class="form-control item" type="text" id="name-4" style="width: 121px;margin-bottom: 4px;" required=""></label><label class="form-label d-table" for="name" style="margin: -6px;margin-left: 181px;width: 117px;margin-bottom: -13px;margin-top: -73px;">City<input class="form-control item" type="text" id="name-8" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3"><label class="form-label">Phone Number</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" required=""></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit" href="ProfileAccntView.php" style="border-color: rgb(119,13,253);background: rgb(119,13,253);">SAVE </button><a class="btn btn-danger form-btn" role="button" href="ProfileAccntView.php">CANCEL </a></button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
        
<?php require 'layouts/Footer.php';?>