<?php
include("includes/dbh.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') :
$searchParam = "%" . $_POST['search'] . "%";
$query = "SELECT * FROM orders_db INNER JOIN inventory_db
    ON orders_db.ItemID = inventory_db.ItemID INNER JOIN cust_profile
    ON orders_db.c_id = cust_profile.c_id
    ";

if (!$_POST['inprocess'] && !$_POST['completed']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ?
        OR cust_profile.c_name LIKE ?
        OR orders_db.OrderQty LIKE ?
        OR orders_db.OrderTotal LIKE ?
        AND cust_profile.cust_status = '1'
        ";
}

if ($_POST['inprocess'] && $_POST['completed']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'In Process' OR orders_db.OrderType = 'Completed'
        OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'In Process' OR orders_db.OrderType = 'Completed'
        OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'In Process' OR orders_db.OrderType = 'Completed'
        OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'In Process' OR orders_db.OrderType = 'Completed'
        AND cust_profile.cust_status = '1'";
} else {
    if ($_POST['inprocess']) {
        $query .= "
            WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'In Process'
            OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'In Process'
            OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'In Process'
            OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'In Process'
            AND cust_profile.cust_status = '1'";
    }
    
    if ($_POST['completed']) {
        $query .= "
            WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'Completed'
            OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'Completed'
            OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'Completed'
            OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'Completed'
            AND cust_profile.cust_status = '1'";
    }
}


$query .= " ORDER BY OrderID";
$type = "In Process";
$stmt = $con->prepare($query);

$stmt->bind_param(
    "ssii",
    $searchParam,
    $searchParam,
    $searchParam,
    $searchParam,
    );

$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $order) :
?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="clean-product-item">
                <div class="image"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>"><img class="img-fluid d-block mx-auto rounded" src="<?php echo $order['ItemImg'] ?>" title="<?php echo $order['ItemName'] ?>"></a></div>
                <div class="product-name"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>" style="color: rgb(111,66,193);">Order#<?php echo $order['OrderID'] ?> - <?php echo $order['ItemName'] ?></a></div>
                <hr>
                <h6>Ordered by: <strong> <?php echo $order['c_name']; ?> </strong></h6>
                <h6>Quantity: <?php echo $order['OrderQty']; ?></h6>
                <h6>Total Cost: Php<?php echo $order['OrderTotal']; ?></h6>
                <span class="badge" style="background-color: indigo;"><?php echo $order['OrderType']; ?></span>
            </div>
        </div>
<?php
    endforeach;
endif;
?>