<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);


    
    include("includes/Order.php");
    $order = new Order();
    $categories = $order->getCategories();
    $totalRecords = $order->getTotalOrders();
    require 'layouts/Header.php';
?>

<title> Order List | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading" >
                <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Orders</h2>
                </div>
                <div class="content">
                    <div class="row">
                    <div class="col-md-3">
                            <div class="d-none d-md-block">
                            <form method="post" id="search_form">   
                                <div class="filters">
                                    <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: 14px;margin-right: -4px;">
                                        <div class="float-start float-md-end mt-5 mt-md-0 search-area"></div><a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);" data-bs-target="AddOrder.php" href="AddOrder.php"><i class="fas fa-plus" style="text-align: center;"></i></a><a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);" data-bs-target="AddCustomerProf.php" href=""><i class="fas fa-search" style="text-align: center;"></i></a>
                                    </div>
                                    <div class="filter-item">
                                    <h3>Filters</h3>
                                        <?php 
								foreach ($categories as $key => $category) {
                                    if(isset($_POST['category'])) {
                                        if(in_array($order->cleanString($category['TypeID']),$_POST['category'])) {
                                            $categoryCheck ='checked="checked"';
                                        } else {
											$categoryCheck="";
                                        }
									}
                                ?>
								<li class="list-group-item">
									<div class="checkbox"><label><input type="checkbox" value="<?php echo $order->cleanString($category['TypeID']); ?>" <?php echo @$categoryCheck; ?> name="category[]" class="sort_rang category"><?php echo ucfirst($category['OrderType']); ?></label></div>
								</li>
                                <?php } ?></div></div>
                                </div>
                            </div>
                            <section class="col-lg-9 col-md-8">
                        <div class="row" id="results">
                            <div></div>
                        </div>
                    </section>
                </div>
				<input type="hidden" id="totalRecords" value="<?php echo $totalRecords; ?>">
            </form>
        </div>        
    </div>        

<script src="assets/js/order.js"></script>
                        

<?php require 'layouts/Footer.php';?>