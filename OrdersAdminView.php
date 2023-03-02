<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<title> Order List | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin-top:55px; color: black;font-size: 50px;font-weight: bold;">Orders</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <div class="filters">
                                <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: 14px;margin-right: -4px;">
                                        <div class="float-start float-md-end mt-5 mt-md-0 search-area"></div>
                                        <a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);" data-bs-target="#" href="AddOrder.php"><i class="fas fa-plus" style="text-align: center;"></i></a><a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);" data-bs-target="" href=""><i class="fas fa-search" style="text-align: center;"></i></a>
                                    </div>
                                    <div class="filter-item">
                                        <h3>Filters</h3>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">All Orders</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2">On-Going Orders</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-4"><label class="form-check-label" for="formCheck-4">Completed Orders</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9" style="color: rgb(111,66,193);">
                                <div class="products" style="border-color: var(--bs-danger);">
                                <div class="row g-0">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"</a></div>
                                            <div class="product-name";><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order A</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a href="OrderPageAdmin.php" class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button id="myBtn1" class="btn btn-primary" type="button" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                <div id="myModal1" class="modal1">

                                                    <div class="modal-content1">
                                                        <span class="close1">&times;</span>
                                                        <p>Do you want to delete this order?</p>
                                                        <br><br>
                                                        <button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;" id="yesBtn">Yes</button></a><button class="btn btn-primary border rounded"  id="noBtn">No</button>
                                                    </div>

                                                </div>
                                                <div id="yesMess" class="modal1">

                                                    <div class="modal-content1">
                                                        <span class="close2">&times;</span>
                                                        <p>Record Successfully Deleted</p>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"</a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order B</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a href="OrderPageAdmin.php" class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button id="myBtn2" class="btn btn-primary" type="button" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order C</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a href="OrderPageAdmin.php" class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button class="btn btn-primary" type="button" id="myBtn3" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order D</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a href="OrderPageAdmin.php" class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button class="btn btn-primary" id="myBtn4" type="button" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order E</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button class="btn btn-primary" id="myBtn5" type="button" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order E</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a class="btn btn-primary" id="myBtn1" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button class="btn btn-primary" type="button" id="myBtn6" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order F</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                    <a class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button class="btn btn-primary" type="button" id="myBtn7" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order G</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                    <a class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                            </button><button class="btn btn-primary" type="button" id="myBtn8" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" style="width:100%; margin-top:5px; height:auto;"width: 650px;margin-top: 5px;" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="font-weight: bold; color: black;">Order H</a></div>
                                            <div class="about">
                                                <div class="rating">
                                                <a class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
                                                <button class="btn btn-primary" type="button" id="myBtn9" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    </main>
    	

<script>

    var modal = document.getElementById("myModal1");

    var btn = document.getElementById("myBtn1");
    var btn2 = document.getElementById("myBtn2");
    var btn3 = document.getElementById("myBtn3");
    var btn4 = document.getElementById("myBtn4");
    var btn5 = document.getElementById("myBtn5");
    var btn6 = document.getElementById("myBtn6");
    var btn7 = document.getElementById("myBtn7");
    var btn8 = document.getElementById("myBtn8");
    var btn9 = document.getElementById("myBtn9");

    var yesBtn = document.getElementById("yesBtn");

    var noBtn = document.getElementById("noBtn");

    var yesModal = document.getElementById("yesMess");

    var span = document.getElementsByClassName("close1")[0];

    var span1 = document.getElementsByClassName("close2")[0];

    btn.onclick = function() {
    modal.style.display = "block";
    }

    btn2.onclick = function() {
    modal.style.display = "block";
    }

    btn3.onclick = function() {
    modal.style.display = "block";
    }

    btn4.onclick = function() {
    modal.style.display = "block";
    }

    btn5.onclick = function() {
    modal.style.display = "block";
    }

    btn6.onclick = function() {
    modal.style.display = "block";
    }

    btn7.onclick = function() {
    modal.style.display = "block";
    }

    btn8.onclick = function() {
    modal.style.display = "block";
    }

    btn9.onclick = function() {
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