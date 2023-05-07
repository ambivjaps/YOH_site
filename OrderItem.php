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

    $order_count = "SELECT COUNT(*) FROM orders_db WHERE c_id = $user AND (OrderType='On-Going' OR OrderType='Pending' OR OrderType='Cart')";
    $res = mysqli_query($con, $order_count);
    $r_count = mysqli_fetch_array($res)[0];
    mysqli_free_result($res);

    if(isset($_POST['addtocart'])) {
        $add_order = mysqli_real_escape_string($con, $_POST['add_order']);
        $qty = mysqli_real_escape_string($con, $_POST['qty']);
        $selectPrice = $_POST['itemprice'];
        $OrderTotal = $qty * $selectPrice;

        $add_cart = "INSERT INTO orders_db (ItemID,c_id,OrderType,TypeID,OrderQty,OrderTotal) VALUES ('$add_order','$user','Cart','4','$qty','$OrderTotal')";
        $add = mysqli_query($con, $add_cart);
        header("Location: OrderPageCust.php");
            
    }
    require 'layouts/Header.php';
?>
<head>
<link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/ProdListDesign.css.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
    <link rel="stylesheet" href="assets/css/modal.css">
<style>
        #myModal2 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }
        #myModal3 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            top: 30%;
            width: 100%;
            background-color: #fee8e8;
            margin: auto;
            padding: 20px;
        }

        .modal-footer {
            border: none;
        }

        .modal-footer button {
            background-color: white;
            margin: 0 auto;
            border: none;
        }
    </style>
</head>
<title> Product Catalog | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">
    
<?php require 'layouts/nav.php';?>

    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Product Catalog</h2>
                </div>
                <div class="content rounded" style="width:auto;">
                    <br><br>
                    <a href="OrderPageCust.php">
                    <button role="button" class="btn btn-primary position-relative mx-4"  style="text-align: center;border-color:indigo;background:indigo;">
                        <i class="fas fa-eye" style="text-align:center;width:7%;font-weight:bold;"></i> <span style="font-weight:bold;"> View Orders</span>
                        <?php if ($r_count > 0) { ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?php echo $r_count; ?> </span>
                        <?php } else { ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display:none"> </span>
                        <?php } ?>
                    </button>
                    </a>
                    <br>
                    
                    <div class="row" style="margin-left:10px;">
                        <div class="col-md-12">
                            <div class="products">                 
                                <strong>Page <?php echo $page." of ".$total_pages; ?></strong>        
                                <div class="row">
                                    <?php foreach($items as $item): ?>
                                    <div class="col-md-4">
                                        <div class="clean-product-item">
                                            <a href="OrderItemProd.php?id=<?php echo $item['ItemID']; ?>">
                                                <div class="image"><img class="img-fluid d-block mx-auto rounded" src="<?php echo $item['ItemImg']; ?>" title="<?php echo $item['ItemImg']; ?>" alt="<?php echo $item['ItemImg']; ?>"></div>
                                            </a>
                                            <a href="OrderItemProd.php?id=<?php echo $item['ItemID']; ?>" style="text-decoration: none;color:rgb(111,66,193); font-weight:bold;">
                                                <div class="product-name"><?php echo $item['ItemName']; ?></div>
                                            </a>
                                            <hr>
                                            <div class="about"><br>
                                                <h5 style="font-weight:bold;text-align:start;width:100%;"> PHP <span style="color:rgb(111,66,193);"><?php echo $item['ItemPrice']; ?></span></h5> 
                                            <div class="container"> 
                                            <!-- Button trigger modal -->
                                                <button type="button" role="button" href="#" class="btn btn-primary" style="border-color:indigo;background:indigo;margin-left:80%;" data-toggle="modal" data-target="#exampleModal<?php echo $item['ItemID']; ?>"><i class="fas fa-shopping-cart"></i></button>
                                            
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?php echo $item['ItemID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog" role="document">
                                                    <div class="modal-content" style="width:100%;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight:bold;font-size:17px;"><span style="text-align:center;"><?php echo $item['ItemName']; ?></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form method = "POST" action="OrderItem.php">
                                                  <div class="form-group">
                                                    <label for="quantity" style="font-weight:bold;">Quantity</label><br>
                                                    <input type="number" class="form-control rounded" name="qty" id="quantity">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="quantity" style="font-weight:bold;">Stocks</label>
                                                    <input type="text" class="form-control rounded" id="stocks" placeholder="<?php echo $item['ItemQty']; ?> " readonly>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="quantity" style="font-weight:bold;">Price</label>
                                                    <input type="text" class="form-control rounded" id="stocks" name="itemprice" value="<?php echo $item['ItemPrice']; ?> " readonly>
                                                  </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="addtocart" class="btn mt-3" style="color:white;border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">Order</button>
                                                            <button type="button" class="btn mt-3" data-dismiss="modal" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Close</button>
                                                        </div>
                                                        <input type="hidden" class="add_order" name="add_order" value="<?php echo $item['ItemID']; ?>">
                                                     </form>
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                            </div>
                                        </div>
								    </div>
                                    <?php endforeach; ?>
                                </div>
                                <nav style="margin-bottom: 15px;margin-top: 10px;">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" aria-label="Previous" href="?page=1"><span aria-hidden="true" style="color:rgb(119,13,253);">«</span></a></li>
                                        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                            <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" style="color:indigo;font-weight:bold;">Prev</a>
                                        </li>
                                        <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
                                            <a class="page-link" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" style="color:indigo;font-weight:bold;">Next</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" aria-label="Next" href="?page=<?php echo $total_pages; ?>"><span aria-hidden="true" style="color:rgb(119,13,253);">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="assets/js/DesignB.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/DesignA.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/DesignAnimation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<?php require 'layouts/Footer.php';?>