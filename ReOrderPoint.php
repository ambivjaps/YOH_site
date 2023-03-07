<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$item = "SELECT * FROM inventory_db WHERE ItemID = $id";
		$result = mysqli_query($con, $item);
		$inv = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<title> Re-Ordering | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <main class="page payment-page">
        <section class="clean-block payment-form dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="font-weight: bold;">Re - Ordering Links and Methods</h2>
                </div>
                <form style="border:none;">
                
                    <div class="products">
                        <div class="row">
                                <div class="col-md-2">
                                    <img class="img-fluid" src="<?php echo $inv['ItemImg']; ?>">
                                </div>
                            <div class="col-md-10">
                                <h3 class="item-name">Product: <?php echo $inv['ItemName']; ?></h3>
                                <h3 class="item-name">Price: Php<?php echo $inv['ItemPrice']; ?></h3>
                                <h3 class="item-name">Stocks: <span id = "stocks"><?php echo $inv['ItemQty']; ?></span></h3>
                            </div>
                        <hr>
                          
                        <script> 
                                var sto = document.getElementById("stocks");
                                
                                if (sto.innerText <= 9) {
                                    sto.setAttribute('style', 'color: red');
                                } else if (sto.innerText <= 10) {
                                    sto.setAttribute('style', 'color: orange');
                                } else if (sto.innerText <= 20) {
                                    sto.setAttribute('style', 'color: #8B8000');
                                } else if (sto.innerText <= 30) {
                                    sto.setAttribute('style', 'color: green');
                                } else {
                                    sto.setAttribute('style', 'color: green');
                                }
                            </script>
                        <a class="item-description" href="https://shopee.ph/product/52800866/20050831178" style="text-decoration:none;color:black;"><p>https://shopee.ph/product/52800866/20050831178</p></a>
                        <a class="item-description" href="https://shopee.ph/product/52800866/20050831178" style="text-decoration:none;color:black;"><p>https://shopee.ph/product/52800866/20050831178</p></a>
                        <a class="item-description" href="https://shopee.ph/product/52800866/20050831178" style="text-decoration:none;color:black;"><p>https://shopee.ph/product/52800866/20050831178</p></a>
                        <hr>
                        <div class="item">
                            <p class="item-name">Item Description</p>
                            <p class="item-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                        <hr>
                        <span></span><span class="price"></span>
                        <button class="btn btn-primary d-block w-100" id="myBtn1" type="submit" style="margin-top: 19px; border-color: rgb(119,13,253);background: rgb(119,13,253);">Confirm</button>
                        <div id="myModal1" class="modal1">
                                <div class="modal-content1">
                                    <span class="close1">&times;</span>
                                    <p style="font-weight:bold;font-size:50px;">Thank you!</p>
                                    <p style="font-weight:bold;">Your Re-order has been confirmed </p>
                                    <p style="margin-left:-100px;font-weight:bold;"> How many items: </p> 
                                    <input type="number"class="form-control rounded" style="width:10%; margin-left:390px; margin-top:-45px;"></input>
                                    <br>
                                    <button class="btn btn-primary border rounded" type="submit" style="margin-left: -21px;margin-right: 22px;width: 78.178px; border-color: rgb(119,13,253);background: rgb(119,13,253);" id="yesBtn">Yes</button></a><button class="btn btn-primary border rounded" id="noBtn" style="width: 78.178px; background: rgb(220, 53, 69); border:rgb(220, 53, 69);">No</button>
                                    </div>
                            </div>
                        <a href="Inventory.php" type="button" class="btn btn-primary d-block w-100" class="btn btn-primary d-block w-100"  type="button" style="margin-top: 19px; background: rgb(220, 53, 69); border:rgb(220, 53, 69); text-decoration:none;color:white;">Cancel</a>
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