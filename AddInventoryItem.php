<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);
    
    require 'layouts/Header.php';
?>

<title> Add Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
            <div class="block-heading">
                <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black; font-weight:bold;">Add Inventory Item</h2>
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
                                <div ><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopicinv.png"></div>
                                <br>
                            </div><input class="form-control form-control" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item ID<input class="form-control item" type="text" id="name-4" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item Name<input class="form-control item" type="text" id="name-3" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item Quantity<input class="form-control item" type="text" id="name-6" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Item Type
                                <select class="form-control item" style="width: 121px;margin-bottom: 4px;" value="<?php echo $inv['ItemType']; ?>"  required>
                                    <option value="raw">Raw</option>
                                    <option value="ong">On-Going</option>
                                    <option value="comp">Completed</option>
                                    </optgroup>
                                    </select> 
                                    </label>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right"><a class="btn btn-danger form-btn" role="button" href="Inventory.php">CANCEL </a><button class="btn btn-primary form-btn" type="submit" href="Inventory.php" style="border-color: rgb(119,13,253);background: rgb(119,13,253);">SAVE </button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>