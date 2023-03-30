<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    $reorder = "SELECT * FROM inventory_db WHERE ItemQty <= 15 ORDER BY ItemID AND ItemQty";
	$result = mysqli_query($con, $reorder);
	$disp_reorder = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
?>

<title> Re-Order Point | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page blog-post">
    <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
        
        <div class="container">

            <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: indigo;background: indigo;"><a href="Inventory.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button><hr>

            <center class="my-5"><h1><strong> <i class="fas fa-cart-arrow-down"></i> Re-Order Point </strong></h1></center>

            <?php foreach($disp_reorder as $disp): ?>
                <div class="card">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <a style="color:rgb(111,66,193);font-weight:bold;text-decoration:none;" href="InventoryItem.php?id=<?php echo $disp['ItemID']; ?>">
                                <div class="card-seg-thumbnail">
                                    <img src="<?php echo $disp['ItemImg']; ?>" class="img-fluid rounded-start" title="<?php echo $disp['ItemName']; ?>" alt="<?php echo $disp['ItemName']; ?>">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-9 col-7">
                            <div class="card-body">
                                <a style="color:rgb(111,66,193);font-weight:bold;text-decoration:none;" href="InventoryItem.php?id=<?php echo $disp['ItemID']; ?>"><h5 style="font-weight:bold;"><?php echo $disp['ItemName']; ?></h5></a>
                                
                                <?php if ($disp['ItemQty'] >= 10) {

                                ?>  <h5 style="font-weight:bold;"><span class="badge rounded-pill" style="background-color:orange; color:black;">Warning</span><h5>

                                <?php } else if ($disp['ItemQty'] < 10) {
                                    
                                ?>  <h5 style="font-weight:bold;"><span class="badge rounded-pill" style="background-color:red; color:white;">Critical</span><h5>

                                <?php } ?><hr>
                
                                <h6 style="font-weight:bold;"><span class="badge" style="background-color:pink; border-color: pink; color:purple;"><?php echo $disp['ItemType']; ?></span></h6>
                                <h6 style="font-weight:bold;">Price:  <span style="color:rgb(111,66,193);"> PHP <?php echo $disp['ItemPrice']; ?></h6>
                                
                                <?php if ($disp['ItemQty'] >= 10) {

                                ?> <h6 style="font-weight:bold;">Quantity: <span style="color:orange;"><?php echo $disp['ItemQty']; ?></h6>

                                <?php } else if ($disp['ItemQty'] <= 10) {
                                    
                                ?> <h6 style="font-weight:bold;">Quantity: <span style="color:red;"><?php echo $disp['ItemQty']; ?></h6>

                                <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        
        </div>
    </section>
</main>
        
<?php require 'layouts/Footer.php';?>