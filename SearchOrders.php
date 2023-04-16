<?php
include("includes/dbh.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') :
$searchParam = "%" . $_POST['search'] . "%";
$query = "SELECT * FROM orders_db INNER JOIN inventory_db
    ON orders_db.ItemID = inventory_db.ItemID INNER JOIN cust_profile
    ON orders_db.c_id = cust_profile.c_id AND orders_db.cust_status = cust_profile.cust_status
    ";

if (!$_POST['inprocess'] && !$_POST['completed'] && !$_POST['pending']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ?
        OR cust_profile.c_name LIKE ?
        OR orders_db.OrderQty LIKE ?
        OR orders_db.OrderTotal LIKE ?
        AND cust_profile.cust_status = '1'
        ";
}
if ($_POST['inprocess'] && $_POST['completed'] && $_POST['pending']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending'
        OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending'
        OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending' 
        OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending'
        AND cust_profile.cust_status = '1'";
}
else if ($_POST['inprocess'] && $_POST['completed']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed'
        OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed'
        OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed'
        OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Completed'
        AND cust_profile.cust_status = '1'";
}
else if ($_POST['inprocess'] && $_POST['pending']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Pending'
        OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Pending'
        OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Pending'
        OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'On-Going' OR orders_db.OrderType = 'Pending'
        AND cust_profile.cust_status = '1'";
}
else if ($_POST['completed'] && $_POST['pending']) {
    $query .= "
        WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending'
        OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending'
        OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'Completedimage.png' OR orders_db.OrderType = 'Pending'
        OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'Completed' OR orders_db.OrderType = 'Pending'
        AND cust_profile.cust_status = '1'";
}
else {
    if ($_POST['inprocess']) {
        $query .= "
            WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'On-Going'
            OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'On-Going'
            OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'On-Going'
            OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'On-Going'
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

    if ($_POST['pending']) {
        $query .= "
            WHERE inventory_db.ItemName LIKE ? AND orders_db.OrderType = 'Pending'
            OR cust_profile.c_name LIKE ? AND orders_db.OrderType = 'Pending'
            OR orders_db.OrderQty LIKE ? AND orders_db.OrderType = 'Pending'
            OR orders_db.OrderTotal LIKE ? AND orders_db.OrderType = 'Pending'
            AND cust_profile.cust_status = '1'";
    }
}


$query .= " ORDER BY OrderID";
$type = "On-Going"; 
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
                <h6 style="font-weight:bold;">Ordered by: <span style="color:rgb(111,66,193);font-weight:bold;"><?php echo $order['c_name']; ?> </strong></h6>
                <h6 style="font-weight:bold;">Material Used: <span style="color:rgb(111,66,193);font-weight:bold;"><?php echo $order['MaterialUsed']; ?> </strong></h6>
                <h6 style="font-weight:bold;">Quantity: <span style="font-weight:bold;color:rgb(111,66,193);"><?php echo $order['OrderQty']; ?></h6>
                <h6 style="font-weight:bold;">Total Cost: <span style="font-weight:bold;color:rgb(111,66,193);"> PHP <?php echo $order['OrderTotal']; ?></h6>
                <span class="badge"style="background-color:pink; border-color: pink; color:purple;text-decoration:none;"><?php echo $order['OrderType']; ?></span>
            </div>
        </div>
<?php
    endforeach;
endif;
?>