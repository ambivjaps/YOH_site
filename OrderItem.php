<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $no_of_records_per_page = 9;

    $offset = ($page-1) * $no_of_records_per_page;

    $user = $_SESSION['login_id'];

    $total_pages_sql = "SELECT COUNT(*) FROM inventory_db WHERE ItemType = 'Finished'";
    $result = mysqli_query($con, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $sql = "SELECT * FROM inventory_db WHERE ItemType = 'Finished' LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($con, $sql);
    $items = mysqli_fetch_all($res_data, MYSQLI_ASSOC);
    mysqli_free_result($result);

    $order_count = "SELECT COUNT(*) FROM orders_db WHERE c_id = $user AND (OrderType='On-Going' OR OrderType='Pending')";
    $res = mysqli_query($con, $order_count);
    $r_count = mysqli_fetch_array($res)[0];
    mysqli_free_result($res);

    mysqli_close($con);

    require 'layouts/Header.php';
?>

<title> Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">
    
<?php require 'layouts/nav.php';?>

    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Product Catalog</h2>
                </div>
                <div class="content">
                    <a href="OrderPageCust.php" class="btn btn-primary position-relative mx-1" role="button" style="text-align: center;border-color:indigo;background:indigo;">
                        <i class="fas fa-eye" style="text-align: center;"></i> View Orders
                        <?php if ($r_count > 0) { ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?php echo $r_count; ?> </span>
                        <?php } else { ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display:none"> </span>
                        <?php } ?>
                    </a>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="products">                 
                                <strong>Page <?php echo $page." of ".$total_pages; ?></strong>        
                                <div class="row">
                                    <?php foreach($items as $item): ?>
                                    <div class="col-md-4">
                                        <div class="clean-product-item">
                                            <a href="InventoryItem.php?id=<?php echo $item['ItemID']; ?>">
                                                <div class="image"><img class="img-fluid d-block mx-auto rounded" src="<?php echo $item['ItemImg']; ?>" title="<?php echo $item['ItemImg']; ?>" alt="<?php echo $item['ItemImg']; ?>"></div>
                                            </a>
                                            <a href="InventoryItem.php?id=<?php echo $item['ItemID']; ?>" style="text-decoration: none;color:rgb(111,66,193); font-weight:bold;">
                                                <div class="product-name"><?php echo $item['ItemName']; ?></div>
                                            </a>
                                            <hr>
                                            <div class="about">
                                                <h6 style="font-weight:bold;text-align:start;"> PHP <span style="color:rgb(111,66,193);" ><?php echo $item['ItemPrice']; ?></span></h6>
                                                <a class="btn btn-primary" href="#" role="button" style="border-color:indigo;background:indigo;"><i class="fas fa-shopping-cart"></i></a>
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