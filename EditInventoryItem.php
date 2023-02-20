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

<title> Edit Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;">Edit Inventory Item</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view" id="profile" style="background: #ffffff;width: 1354px;">
                <div class="row">
                    <div class="col-md-12 alert-col relative">
                        <div class="alert alert-info alert-dismissible absolue center" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><span>Profile save with success</span></div>
                    </div>
                </div>
                <form>
                    <div class="row profile-row" method="post">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div class="avatar-bg center" style="background: url(<?php echo $inv['ItemImg']; ?>); background-size: cover; background-position: 50% 50%;"></div>
                            </div>
                            <input class="form-control form-control" type="file" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="col-form-label" for="item-id">Item ID </label>
                                    <input class="form-control item" type="text" id="name-4" value="<?php echo $inv['ItemID']; ?>" required>
                                </div>
                                <div class="col-md-10">
                                    <label class="col-form-label" for="item-name">Item Name </label>
                                    <input class="form-control item" type="text" id="name-3" value="<?php echo $inv['ItemName']; ?>" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="item-desc">Item Description </label>
                                    <textarea type="text" rows="10" class="form-control" id="#" required><?php echo $inv['ItemDesc']; ?></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-qty">Item Quantity </label>
                                    <input class="form-control item" type="text" id="name-6" value="<?php echo $inv['ItemQty']; ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-type">Item Type </label>
                                    <input class="form-control item" type="text" id="name-1" value="<?php echo $inv['ItemType']; ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-price">Item Price (in Php) </label>
                                    <input class="form-control item" type="text" id="name-1" value="<?php echo $inv['ItemPrice']; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right">
                                    <button class="btn btn-primary form-btn" type="submit" href="modal_show">SAVE </button>
                                    <button class="btn btn-danger form-btn" type="reset">CANCEL </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
                
        <div class="modal" id="modal_show">
            <div class="modal__content">
                <h1>Message</h1>

                <p>
                    Details Successfully Changed!
                </p>

                <a href="Inventory.php" class="modal__close">&times;</a>
            </div>
        </div>
    </main>
    
<?php require 'layouts/Footer.php';?>