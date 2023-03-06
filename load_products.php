<?php
include("includes/Product.php");
$product = new Product();
$products = $product->getProducts();
$productData = array(
	"products" => $products	
);
echo json_encode($productData);
?>