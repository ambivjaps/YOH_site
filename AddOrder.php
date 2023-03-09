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
        <section class="clean-block clean-catalog dark" style="height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black; font-weight:bold;">New Order</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view rounded" id="profile" style="background: #ffffff;width: 1354px;">
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
                            </div><input class="form-control form-control rounded" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label rounded" for="name" style="margin-left: 31px; font-weight:bold;">Customer ID<br><input class="form-control item rounded" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" ></label>
                                <label class="col-form-label rounded" for="name" style="margin-left: 31px; font-weight:bold;">Product Cost<input class="form-control item rounded" type="text" id="name-4" style="width: 121px;margin-bottom: 4px;" ></label>
                                <span><label class="col-form-label rounded" for="name" style="margin-left: 31px; font-weight:bold;">Order Quantity<input class="form-control item rounded" type="number" id="name-3" style="width: 120px;" ></label></span>
                            </div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label rounded" for="name" style="margin-left: 31px; font-weight:bold;">Tracking ID<input class="form-control item rounded" type="text" id="name-6" style="width: 171px;margin-bottom: 4px;" ></label>
                                <label class="col-form-label rounded" for="name" style="margin-left: 31px; font-weight:bold;">Item ID<input class="form-control item rounded" type="text" id="name-4" style="width: 121px;margin-bottom: 4px;" ></label>
                                <span>
                                <label class="col-form-label rounded" for="name" style="margin-left: 31px; font-weight:bold;">Courier
                                <select class="form-select item rounded" style="width: 121px;margin-bottom: 4px;" >
                                    <option value="raw">Shopee</option>
                                    <option value="laz">Lazada</option>
                                    <option value="ama">Amazon</option>
                                    </optgroup>
                                    </select> 
                                    </label>
                                </span>
                                
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xxl-10"><label class="form-label rounded" for="name"  style="margin-left: 31px;font-weight:bold;">Materials Used<br></label><button id="myBtn1" class="btn btn-primary rounded" type="button" data-bs-toggle="modal" data-bs-target="#modal1" style="margin: 16px; border-color: rgb(119,13,253);background: rgb(119,13,253); ">Add Materials</button>
                            <div id="myModal1" class="modal1">
                                <div class="modal-content1">
                                    <span class="close1">&times;</span>
                                    <p style="font-weight:bold;font-size:50px;">Add Materials</p>
                                    <p style="font-weight:bold; margin-top:-20px;">Please select the raw material in the inventory</p>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-md-6 col-xxl-10" style="margin-left:50px; margin-top:-50px;"><label class="col-form-label rounded" for="name" style="font-weight:bold;text-align:center;">Item ID<input class="form-control item rounded" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;"></label>
                                    <label class="col-form-label rounded" for="name" style=" font-weight:bold;">Qty<input class="form-control item rounded" type="number" id="name-3" style="width: 120px;" ></input></label></div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-md-6 col-xxl-10" style="margin-left:50px; margin-top:-50px;"><label class="col-form-label rounded" for="name" style="font-weight:bold;text-align:center;">Item ID<input class="form-control item rounded" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" ></label>
                                    <label class="col-form-label rounded" for="name" style=" font-weight:bold;">Qty<input class="form-control item rounded" type="number" id="name-3" style="width: 120px;" ></input></label></div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-md-6 col-xxl-10" style="margin-left:50px; margin-top:-50px;"><label class="col-form-label rounded" for="name" style="font-weight:bold;text-align:center;">Item ID<input class="form-control item rounded" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" ></label>
                                    <label class="col-form-label rounded" for="name" style=" font-weight:bold;">Qty<input class="form-control item rounded" type="number" id="name-3" style="width: 120px;" ></input></label></div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-md-6 col-xxl-10" style="margin-left:50px; margin-top:-50px;"><label class="col-form-label rounded" for="name" style="font-weight:bold;text-align:center;">Item ID<input class="form-control item rounded" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" ></label>
                                    <label class="col-form-label rounded" for="name" style=" font-weight:bold;">Qty<input class="form-control item rounded" type="number" id="name-3" style="width: 120px;" ></input></label></div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-md-6 col-xxl-10" style="margin-left:50px; margin-top:-50px;"><label class="col-form-label rounded" for="name" style="font-weight:bold;text-align:center;">Item ID<input class="form-control item rounded" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" ></label>
                                    <label class="col-form-label rounded" for="name" style=" font-weight:bold;">Qty<input class="form-control item rounded" type="number" id="name-3" style="width: 120px;" ></input></label></div>
                                    <br>
                                    <button class="btn btn-primary form-btn rounded" type="submit" style="text-align:center;margin-left: -5px;margin-right: 22px;width:100px; border-color: rgb(119,13,253);background: rgb(119,13,253);" id="yesBtn">Confirm</button></a>
                                    <button class="btn btn-danger form-btn rounded" id="noBtn" style="width:100px; background: rgb(220, 53, 69); border:rgb(220, 53, 69);">No</button>
                                    
                                </div>
                        </div>
                        </div>
                            <hr>
                        </div>
                           
                            <div class="row">
                                <div class="col-md-12 content-right"><a class="btn btn-danger form-btn" role="button" href="OrdersAdminView.php">CANCEL </a> <button class="btn btn-primary form-btn" type="submit" href="OrdersAdminView.php" style="border-color: rgb(119,13,253);background: rgb(119,13,253);" >SAVE </button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script>

var modal = document.getElementById("myModal1");

var btn = document.getElementById("myBtn1");

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