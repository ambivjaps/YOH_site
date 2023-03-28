<?php 
    session_start();
    
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    access('ADMIN');

    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$item = "SELECT * FROM inventory_db WHERE ItemID = $id";
		$result = mysqli_query($con, $item);
		$inv = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}

    if(isset($_POST['reorder'])){
       
        $qty = $_POST['ItemQty'];
        $cur_qty = $inv['ItemQty'];
        $item = "UPDATE inventory_db SET ItemQty=ItemQty+$qty WHERE ItemID='$id' ";
        $result = mysqli_query($con, $item);
        if($result) {
            header("Location: ReOrderPoint.php?id=".$inv['ItemID'] ."&success=true");
            mysqli_close($con);
            exit();
    
        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Re-Ordering | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
<?php if($inv): ?>
    <main class="page payment-page">
        <section class="clean-block payment-form dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="font-weight: bold;">Re - Ordering Links and Methods</h2>
                </div>
                

                <div class="form-group">
                <form name="form" action="" method="POST">
                
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
                                
                                if (sto.innerText <= 5) {
                                    sto.setAttribute('style', 'color: red');
                                } else if (sto.innerText <= 8) {
                                    sto.setAttribute('style', 'color: orange');
                                } else if (sto.innerText <= 15) {
                                    sto.setAttribute('style', 'color: green');
                                } else {
                                    sto.setAttribute('style', 'color: green');
                                }
                            </script>
                            
                        <div class="item">
                            <p class="item-name" style="font-weight:bold;">Item Description</p>
                            <p class="item-description"><?php echo nl2br($inv['ItemDesc']); ?></p>
                        </div>
                        <hr>
                    <br>
                    <div class="form-group">
                   
                    <label>Input no. of Items</label>
                   
                        <input class="form-control" type="text" name="ItemQty" placeholder="Enter no. of items"  required style="margin-bottom: 12px;margin-right: 28px;margin-top: 4px;">
                    </div>
                    <?php 
                    if (isset($_GET['success']) && $_GET['success'] === 'true') { ?>
                        <p style="font-weight:bold;color:green;text-align:center;"> Item has been restocked successfully.</p>
                <?php } ?>
                    <div class="form-group">
                    <input class="form-control button" type="submit" name="reorder" value="Add" style="border-color: rgb(119,13,253); font-weight:bold;background: rgb(119,13,253); color:white;">
                        <a href="Inventory.php" type="button" class="btn btn-primary d-block w-100" class="btn btn-primary d-block w-100"  type="button" value="Cancel" style="margin-top: 19px; background: rgb(220, 53, 69); border:rgb(220, 53, 69); text-decoration:none;color:white;">Cancel</a>
                    </div>
                    <div class="form-group">
                </form>

            </div>
        </section>
    </main>
    
    <script src="assets/js/DesignB.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/bs-init.js"></script>
	<script src="assets/js/DesignA.js"></script>
	<script src="assets/js/theme.js"></script>
	<script src="assets/js/DesignAnimation.js"></script>
<?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>
<?php require 'layouts/Footer.php';?>