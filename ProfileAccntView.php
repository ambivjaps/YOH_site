<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');

    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_SESSION['cust_id'])) {
		$id = mysqli_real_escape_string($con, $_SESSION['cust_id']);
		$item = "SELECT * FROM cust_profile WHERE c_id = $id";
		$result = mysqli_query($con, $item);
		$c_prof = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<title> Profile - Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post">
        <section class="clean-block clean-post dark" style="height: 1042.25px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-content">
                    <div class="post-body" style="height: 800.25px;margin-top: 60px; ">
                        <div class="post-info">
                            <div class="profile-card" style="height: 600px;background: #ffffff; border-color: 0;">
                                <div class="profile-back" style="background: #CBC3E3;--bs-danger: #3546dc;--bs-danger-rgb: 53,70,220;"></div><img class="rounded-circle profile-pic" src="assets/img/avatars/nopic1.jpg">
                                <?php 
                                if(isset($_SESSION['cust_id'])){
                             echo    '<h3 class="profile-name" style="background: #cbc3e3;">' .$c_prof['c_name']. '</h3>' ;} ?>
                                <ul class="social-list" style="margin-bottom: 74px;margin-top: 7px;">
                                <li> <i class="fa fa-plus" style="background: var(--bs-indigo);"></i></li>
                                    <li> <i input type="button" id="myBtn" class="fa fa-minus" style="background: var(--bs-purple);"></i></li>
                                    <li> <a href="EditCustomerProf.php"><i class="fa fa-edit" style="background: var(--bs-indigo);"></i></a></li>
                                </ul>
                                <?php 
                                if(isset($_SESSION['cust_id'])){
                                echo '<form data-bss-hover-animate="pulse" style="width: 892px;min-width: 182px;max-width: 1046px;min-height: 556px;margin-left: 83.5px;height: 547px;color: rgb(111,66,193);margin-bottom: -42px;margin-top: -63px;">
                                    <div class="mb-3" style="padding-left: -6px;"></div>
                                    <div class="mb-3"><label class="form-label" for="name" style="margin-left: 46px;color: rgb(111,66,193);margin-top: 1px;margin-bottom: 14px;margin-right: 12px;text-align: left;">Email Address<input class="form-control item" placeholder="'.$c_prof['email'].'" style="width: 289px;margin-bottom: 4px;" readonly></label>
                                    <label class="form-label" for="name" style="margin-left: 148px;color: rgb(111,66,193);text-align: left;">Zip Code<br><input class="form-control item" placeholder="'.$c_prof['zip_code'].'" style="width: 121px;margin-bottom: 4px;min-width: 76px;" readonly></label>
                                    <label class="form-label" for="name" style="margin-left: 42px;color: rgb(111,66,193);text-align: left;">Unit No.<input class="form-control item" placeholder="'.$c_prof['unit_no'].'" style="width: 121px;margin-bottom: 4px;min-width: 76px;" readonly></label></div>
                                    <div class="mb-3" style="margin-top: -20px;"><label class="form-label" for="name" style="margin-left: 70px;color: rgb(111,66,193);margin-top: -1px;margin-bottom: 14px;margin-right: 12px;text-align: left;">Phone Number<br><input class="form-control item" placeholder="'.$c_prof['phone_no'].'" style="width: 289px;margin-bottom: 4px;" readonly></label>
                                    <label class="form-label" for="name" style="margin-left: 148px;color: rgb(111,66,193);text-align: left;">Street<br><input class="form-control item" placeholder="'.$c_prof['street'].'" style="width: 121px;margin-bottom: 4px;min-width: 76px;" readonly></label>
                                    <label class="form-label" for="name" style="margin-left: 42px;color: rgb(111,66,193);text-align: left;">Building Number<br><input class="form-control item" placeholder="'.$c_prof['building'].'" style="width: 148px;margin-bottom: 4px;min-width: 76px;" readonly>
                                    </label><label class="form-label" for="name" style="margin-left: 515px;color: rgb(111,66,193);text-align: left;">Region<br><input class="form-control item" placeholder="'.$c_prof['region'].'" style="width: 121px;margin-bottom: 4px;min-width: 76px;" readonly></label>
                                    <label class="form-label" for="name" style="margin-left: 42px;color: rgb(111,66,193);text-align: left;">City<br><input class="form-control item" placeholder="'.$c_prof['city'].'" style="width: 148px;margin-bottom: 4px;min-width: 76px;" readonly></label></div>
                                    <div class="mb-3" style="margin-top: -29px;height: 179.109px;"><label class="form-label" for="name" style="margin-left: -385px;color: rgb(111,66,193);margin-top: -115px;margin-bottom: 14px;margin-right: 12px;text-align: left;">Address<textarea class="form-control item" placeholder="#" style="width: 301px;margin-bottom: -40px;height: 92px; resize:none;" readonly></textarea></label></div>
                                    <div class="mb-3" style="margin: -15px;margin-left: -25px;"></div>
                                    <div class="mb-3"></div>
                                    <div class="mb-3" style="margin-left: -61px;width: 1060px;"></div>
                                    <div class="mb-3" style="margin-left: -61px;width: 1060px;"></div>
                                    <div class="mb-3"></div>
                                    <div class="mb-3"></div>
                                    <div class="mb-3" style="margin-bottom: 9px;margin-top: 42px;"></div>
                                    <div></div>
                                    <div></div>
                                    <div class="btn-group" role="group"></div>
                                </form>'; } ?>
                            </div>
                            <div class="mb-3"></div>
                            <div class="mb-3"></div>
                            <div></div>
                            <div></div>
                            <div></div><br><br>
                            <div></div>
												<div id="myModal1" class="modal1">
                                                    <div class="modal-content1">
														<br><br>
                                                        <span id="close1" class="close1">&times;</span>
                                                        <p>Are you sure you want to remove your profile?</p>
                                                        <br>
                                                        <button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;" id="yesBtn">Yes</button></a><button class="btn btn-primary border rounded"  id="noBtn">No</button>
                                                    </div>
                                                </div>

                                                <div id="yesMess" class="modal1">
                                                    <div class="modal-content1">
														<br>
                                                        <span class="close2">&times;</span>
                                                        <p>Profile Successfully Deleted</p>
                                                    </div>
                                                </div>
                            </div>
                        </div>
                        <figure class="figure"></figure>
                    </div>
                </div>
            </div>
        </section>
    </main>

	<script>

    var modal = document.getElementById("myModal1");

    var btn = document.getElementById("myBtn");

    var yesBtn = document.getElementById("yesBtn");

    var noBtn = document.getElementById("noBtn");

    var yesModal = document.getElementById("yesMess");

    var span = document.getElementsByClassName("close1")[0];

    var span1 = document.getElementsByClassName("close2")[0];


    btn.onclick = function() {
    modal.style.display = "block";
    }

    span.onclick = function() {
    modal.style.display = "none";
    }

    span1.onclick = function() {
        yesModal.style.display = "none";
    }

    yesBtn.onclick = function() {
        modal.style.display = "none";
        yesModal.style.display = "block";
    }

    noBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    </script>
		
<?php require 'layouts/Footer.php';?>