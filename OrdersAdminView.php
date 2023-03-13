<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    $order = "SELECT * FROM orders_db INNER JOIN inventory_db 
    ON orders_db.ItemID = inventory_db.ItemID INNER JOIN cust_profile 
    ON orders_db.c_id = cust_profile.c_id 
    WHERE cust_status = '1' ORDER BY OrderID";
	$result = mysqli_query($con, $order);
	$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
 
    require 'layouts/Header.php';
?>

<title> Order List | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
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
                        <div class="col-md-9">
                            <div class="products"><a class="btn btn-primary active" role="button" style="margin-left: 834px;margin-right: -7px;margin-bottom: -12px;margin-top: -16px;" href="AddOrder.php">Add</a>
                                
                                <div class="row g-0">
                                    <?php foreach($orders as $order): ?>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                            <div class="image"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID'] ?>"><img class="img-fluid d-block mx-auto rounded" src="<?php echo $order['ItemImg'] ?>" title="<?php echo $order['ItemName'] ?>"></a></div>
                                            <div class="product-name"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID'] ?>" style="color: rgb(111,66,193);">Order#<?php echo $order['OrderID'] ?> - <?php echo $order['ItemName'] ?></a></div>
                                            <hr><h6>Ordered by: <strong> <?php echo $order['c_name'] ?> </strong></h6>
                                            <h6>Quantity: <?php echo $order['OrderQty'] ?></h6>
                                            <h6>Total Cost: 
                                            <?php 
                                                $total = $order['OrderQty'] * $order['ItemPrice'];
                                                echo "Php".$total;
                                            ?>
                                            </h6>
                                            <span class="badge bg-dark"><?php echo $order['OrderType']; ?></span>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
                        
<?php require 'layouts/Footer.php';?>