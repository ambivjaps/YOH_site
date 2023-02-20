<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    $sql = "SELECT * FROM inventory_db ORDER BY id";
	$result = mysqli_query($con, $sql);
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

    require 'layouts/Header.php';
?>

<title> Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">
    
<?php require 'layouts/nav.php';?>

    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading" styl>
                    <h2 style="margin:54px; color:black; font-size:54px;">Inventory</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3" style="margin-top: -1px;">
                            <div class="d-none d-md-block">
                                <div class="filters">
                                    <div class="filter-item">
                                        <h3 style="font-size: 32px;">Filters</h3>
                                        <h3>Categories</h3>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">All Products</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2">Finished Products</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3">Raw Products</label></div>
                                    </div>
                                    <div class="filter-item"></div>
                                    <div class="filter-item"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="products" style="margin-top: -5px;">
                            <a href=""><i class="fas fa-search float-start search-icon" style="font-size: 27px;margin-left: 792px;"></a></i>
                            <a class="btn btn-primary" role="button" style="margin-left: 835px;margin-right: -7px;margin-bottom: -15px;margin-top: -33px;" data-bs-target="AddCustomerProf.html" href="AddInventoryItem.php">New Item</a>
                                <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: -153px;"></div>
                                <nav style="margin-bottom: 15px;margin-top: 10px;">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link">1</a></li>
                                        <li class="page-item"><a class="page-link">2</a></li>
                                        <li class="page-item"><a class="page-link">3</a></li>
                                        <li class="page-item"><a class="page-link" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                                <div class="row g-0">
                                    <?php foreach($items as $item): ?>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="clean-product-item">
                                                <a href="EditInventoryItem.php?id=<?php echo $item['id'] ?>">
                                                    <div class="image"><img class="img-fluid d-block mx-auto rounded" src="<?php echo $item['ItemImg']; ?>" title="<?php echo $item['ItemName']; ?>" alt="<?php echo $item['ItemName']; ?>"></div>
                                                </a>
                                                <a href="EditInventoryItem.php?id=<?php echo $item['id'] ?>" style="text-decoration: none;">
                                                    <div class="product-name"><?php echo $item['ItemName']; ?></div>
                                                </a>
                                                <div class="about">
                                                    <a href="ReOrderPoint.php"><button class="btn btn-primary float-start" type="button">Re-Order</button></a>
                                                    <div class="price">
                                                        <h6>Price: Php<?php echo $item['ItemPrice']; ?></h6>
                                                        <h6>Quantity: <?php echo $item['ItemQty']; ?></h6>
                                                    </div>
                                                </div>
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