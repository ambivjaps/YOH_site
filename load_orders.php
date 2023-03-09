<?php
include("includes/Order.php");
$order = new Order();
$orders = $order->getOrders();
$orderData = array(
	"orders" => $orders
);
echo json_encode($orderData);
?>