<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$item = "SELECT * FROM inventory_db WHERE id = $id";
		$result = mysqli_query($con, $item);
		$inv = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<title> Edit Inventory Item: <?php echo $inv['ItemName']; ?> | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <?php if($inv): ?>
        
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black; font-weight:bold;">Edit Inventory Item</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view" id="profile" style="background: #ffffff">
                <div class="row">
                    <div class="col-md-12 alert-col relative">
                        <div class="alert alert-info alert-dismissible absolue center" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><span>Profile save with success</span></div>
                    </div>
                </div>
                <form action="EditInventoryItem.php?id=<?php echo $inv['id']; ?>" method="POST">
                    <div class="row profile-row">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div class="avatar-bg center" style="background: url(<?php echo $inv['ItemImg']; ?>); background-size: cover; background-position: 50% 50%;"></div>
                            </div>
                            <input class="form-control form-control my-3" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="col-form-label" for="item-id">Item ID </label>
                                    <input class="form-control item" type="text" name="ItemID" value="<?php echo $inv['ItemID']; ?>" required>
                                </div>
                                <div class="col-md-10">
                                    <label class="col-form-label" for="item-name">Item Name </label>
                                    <input class="form-control item" type="text" name="ItemName" value="<?php echo $inv['ItemName']; ?>" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="item-desc">Item Description </label>
                                    <textarea type="text" rows="10" class="form-control" name="ItemDesc" required><?php echo $inv['ItemDesc']; ?></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-qty">Item Quantity </label>
                                    <input class="form-control item" type="text" name="ItemQty" value="<?php echo $inv['ItemQty']; ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-type">Item Type </label>
                                    <input class="form-control item" type="text" name="ItemType" value="<?php echo $inv['ItemType']; ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-price">Item Price (in Php) </label>
                                    <input class="form-control item" type="text" name="ItemPrice" value="<?php echo $inv['ItemPrice']; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right">
                                    <input class="btn btn-primary form-btn" type="submit" id="submit" name="submit" value="SAVE">
                                    <input class="btn btn-danger form-btn" type="reset" id="reset" value="CANCEL">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php else: ?>
                <div class="container my-5">
                    <h2> Oops.. Page not found. Please try again. </h2>
                </div>
            <?php endif ?>
        
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>