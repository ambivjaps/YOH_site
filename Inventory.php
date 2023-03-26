<?php
session_start();

include("includes/dbh.inc.php");
include("includes/functions.inc.php");
include("includes/access.inc.php");
access('ADMIN');
$user_data = check_login($con);

include("includes/Product.php");
$product = new Product();
$categories = $product->getCategories();
$totalRecords = $product->getTotalProducts();

require 'layouts/Header.php';
?>

<title> Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">
    
<?php require 'layouts/nav.php';?>

<main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading" >
                    <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Inventory</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <form method="POST" action="javascript:void(0);" id="search_form">   
                                    <div class="filters">
                                        <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: 14px;margin-right: -4px;">
                                            <div class="float-start float-md-end mt-5 mt-md-0 search-area"></div>
                                        </div>
                                        
                                    <div class="filter-item">
                                        <h3 style="font-size: 32px; font-weight:bold;">Filters</h3>
                                        <div class="d-flex mt-4 mb-5">
                                            <input class="form-control rounded" type="text" name="searchInput">
                                            <button type="submit" id="searchInventory" class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color:indigo;background:indigo;">
                                                <i class="fas fa-search" style="text-align: center;"></i>
                                            </button>
                                            <a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color:indigo;background:indigo;" data-bs-target="AddInventoryItem.php" href="AddInventoryItem.php"><i class="fas fa-plus" style="text-align: center;"></i></a>
                                        </div>
                                        <h3 style="font-size: 20px; font-weight:bold;">Categories</h3>
                                        <?php 
                                            foreach ($categories as $key => $category) {
                                                if(isset($_POST['category'])) {
                                                    if(in_array($product->cleanString($category['TypeID']),$_POST['category'])) {
                                                        $categoryCheck ='checked="checked"';
                                                    } else {
                                                        $categoryCheck="";
                                                    }
                                                }
                                        ?>
                                        
                                        <li class="list-group-item">
                                            <div class="checkbox"><label style="font-weight:bold;"><input type="checkbox" value="<?php echo $product->cleanString($category['TypeID']); ?>" <?php echo @$categoryCheck; ?> name="category[]" class="sort_rang category"><?php echo ucfirst($category['ItemType']); ?></label></div>
                                        </li>

                                    <?php } ?></div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row g-0" id="results"></div>
                        </div>
                    </div>
            
                </div>       
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>

<script src="assets/js/inventory.js"></script>
