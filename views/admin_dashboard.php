<?php 
    access('ADMIN');
    $user_data = check_login($con);

    // retrieves profile count
    $profile_count = "SELECT COUNT(*) FROM cust_profile WHERE cust_status='1'";
    $result_prof = mysqli_query($con, $profile_count);
    $profiles = mysqli_fetch_array($result_prof)[0];
    mysqli_free_result($result_prof);

    // retrieves inventory count
    $inventory_count = "SELECT COUNT(*) FROM inventory_db";
    $result_inv = mysqli_query($con, $inventory_count);
    $inventory = mysqli_fetch_array($result_inv)[0];
    mysqli_free_result($result_inv);

    // retrieves order count
    $order_count = "SELECT COUNT(*) FROM orders_db";
    $result_order = mysqli_query($con, $order_count);
    $orders = mysqli_fetch_array($result_order)[0];
    mysqli_free_result($result_order);

    // retrieves video count
    $video_count = "SELECT COUNT(*) FROM videos";
    $result_vid = mysqli_query($con, $video_count);
    $videos = mysqli_fetch_array($result_vid)[0];
    mysqli_free_result($result_vid);

    // retrieves slide count
    $slide_count = "SELECT COUNT(*) FROM slides";
    $result_slide = mysqli_query($con, $slide_count);
    $slides = mysqli_fetch_array($result_slide)[0];
    mysqli_free_result($result_slide);


    // latest inventory records
    $item_inv = "SELECT * FROM inventory_db ORDER BY ItemID DESC LIMIT 3";
	$result_inv2 = mysqli_query($con, $item_inv);
	$latest_inv = mysqli_fetch_all($result_inv2, MYSQLI_ASSOC);
	mysqli_free_result($result_inv2);

    // latest order records
    $item_order = "SELECT * FROM orders_db INNER JOIN inventory_db 
    ON orders_db.ItemID = inventory_db.ItemID INNER JOIN cust_profile 
    ON orders_db.c_id = cust_profile.c_id
    WHERE cust_profile.cust_status = '1' ORDER BY OrderID DESC LIMIT 3";
	$result_order2 = mysqli_query($con, $item_order);
	$latest_order = mysqli_fetch_all($result_order2, MYSQLI_ASSOC);
	mysqli_free_result($result_order2);

?>

<div class="container my-5">

    <div class="admin-welcome mt-3">
        <h2><strong> <i class="fas fa-user-cog"></i> Administrator Dashboard </strong></h2>
        <h5> Welcome back, <?php echo $_SESSION['cust_name']; ?>!</h5><hr>
    </div>

    <div class="row justify-content-center g-1">
        <div class="col-md-4 my-2">
            <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/bg_og.jpg');">
                <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"><i class="fas fa-user-friends"></i> Profiles </h1>
                <p style="text-shadow: #000 1px 0 5px;"><strong> <?php echo $profiles ?> </strong> records</p>
                <a class="btn btn-light mt-2" href="CustomerProfileListAdmin.php" role="button">View all <i class="fas fa-caret-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/bg_og.jpg');">
                <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"><i class="fas fa-dolly-flatbed"></i> Inventory </h1>
                <p style="text-shadow: #000 1px 0 5px;"><strong> <?php echo $inventory ?> </strong>records</p>
                <a class="btn btn-light mt-2" href="Inventory.php" role="button">View all <i class="fas fa-caret-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/bg_og.jpg');">
                <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"><i class="fas fa-check-square"></i> Orders </h1>
                <p style="text-shadow: #000 1px 0 5px;"><strong> <?php echo $orders ?> </strong> records</p>
                <a class="btn btn-light mt-2" href="OrdersAdminView.php" role="button">View all <i class="fas fa-caret-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 my-2">
            <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/bg_og.jpg');">
                <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"><i class="fas fa-play"></i> Videos </h1>
                <p style="text-shadow: #000 1px 0 5px;"><strong> <?php echo $videos ?> </strong> records</p>
                <a class="btn btn-light mt-2" href="VideosAdmin.php" role="button">View all <i class="fas fa-caret-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 my-2">
            <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/bg_og.jpg');">
                <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"><i class="fas fa-images"></i> Slides </h1>
                <p style="text-shadow: #000 1px 0 5px;"><strong> <?php echo $slides ?> </strong> records</p>
                <a class="btn btn-light mt-2" href="SlidesAdmin.php" role="button">View all <i class="fas fa-caret-right"></i></a>
            </div>
        </div><hr>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 my-2">
            <h3> Latest Inventory Items </h3>
            <?php foreach($latest_inv as $inv): ?>
            <div class="card">
                <div class="row">
                    <div class="col-md-4 col-4">
                        <a href="InventoryItem.php?id=<?php echo $inv['ItemID']; ?>">
                            <div class="card-seg-thumbnail">
                                <img src="<?php echo $inv['ItemImg']; ?>" class="img-fluid rounded-start" title="<?php echo $inv['ItemName']; ?>" alt="<?php echo $inv['ItemName']; ?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8 col-8">
                        <div class="card-body">
                            <a href="InventoryItem.php?id=<?php echo $inv['ItemID']; ?>"><h5><?php echo $inv['ItemName']; ?></h5></a><hr>
                            <h6><span class="badge bg-dark"><?php echo $inv['ItemType']; ?></span></h6>
                            <h6>Price: Php<?php echo $inv['ItemPrice']; ?></h6>
                            <h6>Quantity: <?php echo $inv['ItemQty']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-6 my-2">
            <h3> Latest Orders </h3>
            <?php foreach($latest_order as $order): ?>
            <div class="card">
                <div class="row">
                    <div class="col-md-4 col-4">
                        <a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>">
                            <div class="card-seg-thumbnail">
                                <img src="<?php echo $order['ItemImg']; ?>" class="img-fluid rounded-start" title="<?php echo $order['ItemName']; ?>" alt="<?php echo $order['ItemName']; ?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8 col-8">
                        <div class="card-body">
                            <a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>"><h5><?php echo $order['ItemName']; ?></h5></a><hr>
                            <h6><span class="badge bg-dark"><?php echo $order['OrderType']; ?></span></h6>
                            <h6>Ordered by: <?php echo $order['c_name']; ?></h6>
                            <h6>Total Price: Php<?php echo $order['OrderTotal']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div><hr>
    <p class="text-muted"> Yarn Over Hook | Website developed by Group#2 of 3-ITA </p>  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/js/sessiontimeout.js"></script>
