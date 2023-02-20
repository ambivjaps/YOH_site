<.?php 
session_start();

    include("connection.php");
    include("functions.php");
    
    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<body style="background-color:#efe9ef;">
<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Edit Inventory | Yarn Over Hook </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/ProdListDesign.css.css">
	<link rel="stylesheet" href="assets/css/LoginOverlay.css">
	<link rel="stylesheet" href="assets/css/ProfileEdit3.css">
	<link rel="stylesheet" href="assets/css/ProfileEdit2.css">
	<link rel="stylesheet" href="assets/css/ProfileEdit1.css">	
    <link rel="stylesheet" href="assets/css/SearchCSS.css">
	<link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body>
    	<div class="nav">
        <?php include 'NavigationAdmin.php';?>
        </div>
        
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;">Edit Inventory Item</h2>
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
                    <div class="row profile-row" method="post">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div class="avatar-bg center"></div>
                            </div><input class="form-control form-control" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item ID<input class="form-control item" type="text" id="name-4" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item Name<input class="form-control item" type="text" id="name-3" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item Quantity<input class="form-control item" type="text" id="name-6" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item Type<br><input class="form-control item" type="text" id="name-1" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit" href="modal_show">SAVE </button><button class="btn btn-danger form-btn" type="reset">CANCEL </button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
                
        <div class="modal" id="modal_show">
            <div class="modal__content">
                <h1>Message</h1>

                <p>
                    Details Successfully Changed!
                </p>

                <a href="Inventory.php" class="modal__close">&times;</a>
            </div>
        </div>
    </main>
    	<div class="footer">
        <?php include 'Footer.php';?>
        </div>
    
    <script src="assets/js/DesignB.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/bs-init.js"></script>
	<script src="assets/js/DesignA.js"></script>
	<script src="assets/js/theme.js"></script>
	<script src="assets/js/DesignAnimation.js"></script>
</body>

</html>