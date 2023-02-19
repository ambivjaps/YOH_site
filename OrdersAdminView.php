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
        <section class="clean-block clean-catalog dark" style="min-height: 17px;height: 1468.56px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin:54px; color:black; font-size:54px;">Orders</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <div class="filters">
                                    <div class="filter-item">
                                        <h3 style="font-size: 32px;">Filters</h3>
                                        <h3>Categories</h3>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">All Orders</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2">On-Going Orders</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-4"><label class="form-check-label" for="formCheck-4">Completed Orders</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9" style="color: rgb(111,66,193);">
                            <div class="products"><a class="btn btn-primary active" role="button" style="margin-left: 834px;margin-right: -7px;margin-bottom: -12px;margin-top: -16px;" href="AddOrder.php">New Item</a>
                                <div class="float-start float-md-end mt-5 mt-md-0 search-area"><a href=""><i class="fas fa-search float-start search-icon" style="margin-left: -145px;margin-bottom: -24px;margin-top: -11px;width: 34px;height: 27px;font-size: 27px;"></i></a></div>
                                <nav style="margin-bottom: 15px;margin-top: 10px;">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" aria-label="Previous"><span aria-hidden="true">�</span></a></li>
                                        <li class="page-item active"><a class="page-link">1</a></li>
                                        <li class="page-item"><a class="page-link">2</a></li>
                                        <li class="page-item"><a class="page-link">3</a></li>
                                        <li class="page-item"><a class="page-link" aria-label="Next"><span aria-hidden="true">�</span></a></li>
                                    </ul>
                                </nav>
                                <div class="row g-0">
                                    <div class="col-12 col-md-6 col-lg-4">
                                    <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" id="myBtn1">Delete</button></div>
                                                <div class="price">

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
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn2">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn3">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="price"></div>
                                            </div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn4">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="price"></div>
                                            </div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn5">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn6">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="price"></div>
                                            </div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn7">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="price"></div>
                                            </div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" role="button" id="myBtn8">Delete</button></div>
                                                <div class="price">
                                                    <h3>$100</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="#"><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopic1.jpg"></a></div>
                                            <div class="product-name"><a href="OrderPageCust.php" style="color: rgb(111,66,193);">Order 1</a></div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="price"></div>
                                            </div>
                                            <div class="about">
                                                <div class="rating"></div>
                                                <div class="btn-group" role="group"><a href="OrderPageAdmin.php"><button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px;">Edit</button></a><button class="btn btn-primary border rounded" type="button" id="myBtn9">Delete</button></div>
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