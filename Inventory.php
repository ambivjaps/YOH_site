<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $no_of_records_per_page = 9;

    $offset = ($page-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM inventory_db";
    $result = mysqli_query($con, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $sql = "SELECT * FROM inventory_db LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($con, $sql);
    $items = mysqli_fetch_all($res_data, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);

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
                                <div class="filters">
                                    <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: 14px;margin-right: -4px;">
                                        <div class="float-start float-md-end mt-5 mt-md-0 search-area"></div><a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);" data-bs-target="AddInventoryItem.php" href="AddInventoryItem.php"><i class="fas fa-plus" style="text-align: center;"></i></a><a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);" data-bs-target="AddCustomerProf.php" href=""><i class="fas fa-search" style="text-align: center;"></i></a>
                                    </div>
                                    <div class="filter-item">
                                        <h3>Filters</h3>
                                        <div class="form-check"><input type="checkbox" onclick='window.location.assign("Inventory.php?type=Raw")' class="form-check-input" id="formCheck-2"><label class="form-label form-check-label" for="formCheck-1">Raw &nbsp;</label></div>
                                        <div class="form-check"><input type="checkbox" onclick='window.location.assign("Inventory.php?type=Finished")' class="form-check-input" id="formCheck-3"><label class="form-label form-check-label" for="formCheck-2">Finished</label></div>
                                    </div>
                                    <div class="filter-item"></div>
                                    <div class="filter-item"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="products" style="margin-top: -5px;">
                                <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: -153px;"></div>                  
                                <strong>Page <?php echo $page." of ".$total_pages; ?></strong>        
                                <div class="row g-0">
                                    <?php foreach($items as $item): ?>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="clean-product-item">
                                                <a href="InventoryItem.php?id=<?php echo $item['ItemID'] ?>">
                                                    <div class="image"><img class="img-fluid d-block mx-auto rounded" src="<?php echo $item['ItemImg']; ?>" title="<?php echo $item['ItemName']; ?>" alt="<?php echo $item['ItemName']; ?>"></div>
                                                </a>
                                                <a href="InventoryItem.php?id=<?php echo $item['ItemID'] ?>" style="text-decoration: none;">
                                                    <div class="product-name"><?php echo $item['ItemName']; ?></div>
                                                </a>
                                                <span class="badge bg-dark"><?php echo $item['ItemType']; ?></span>
                                                <hr>
                                                <div class="about">
                                                    <a href="ReOrderPoint.php?id=<?php echo $item['ItemID'] ?>"><button class="btn btn-primary" type="button" style="background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="fas fa-shopping-bag"></i></button></a>
                                                    <div class="price">
                                                        <h6>Php<?php echo $item['ItemPrice']; ?></h6>
                                                        <h6>Quantity: <?php echo $item['ItemQty']; ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <nav style="margin-bottom: 15px;margin-top: 10px;">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" aria-label="Previous" href="?page=1"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                            <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
                                        </li>
                                        <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
                                            <a class="page-link" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" aria-label="Next" href="?page=<?php echo $total_pages; ?>"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>