<?php 
    access('ADMIN');
    $user_data = check_login($con);

    // retrieves profile count
    $profile_count = "SELECT COUNT(*) FROM cust_profile";
    $result = mysqli_query($con, $profile_count);
    $profiles = mysqli_fetch_array($result)[0];
    mysqli_free_result($result);

    // retrieves inventory count
    $inventory_count = "SELECT COUNT(*) FROM products";
    $result = mysqli_query($con, $inventory_count);
    $inventory = mysqli_fetch_array($result)[0];
    mysqli_free_result($result);

    // retrieves order count
    $order_count = "SELECT COUNT(*) FROM orders_db";
    $result = mysqli_query($con, $order_count);
    $orders = mysqli_fetch_array($result)[0];
    mysqli_free_result($result);

    // retrieves video count
    $video_count = "SELECT COUNT(*) FROM videos";
    $result = mysqli_query($con, $video_count);
    $videos = mysqli_fetch_array($result)[0];
    mysqli_free_result($result);

    // retrieves slide count
    $slide_count = "SELECT COUNT(*) FROM slides";
    $result = mysqli_query($con, $slide_count);
    $slides = mysqli_fetch_array($result)[0];
    mysqli_free_result($result);
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
                <a class="btn btn-light mt-2" href="#" role="button">View all <i class="fas fa-caret-right"></i></a>
            </div>
        </div><hr>
        <p class="text-muted"> Yarn Over Hook | Website developed by Group#2 of 3-ITA </p>
    </div>

</div>