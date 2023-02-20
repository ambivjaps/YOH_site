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

<?php
    if(isset($_POST['submit'])) {
        $InvID = $inv['id'];

        $ItemID = mysqli_real_escape_string($con, $_POST['ItemID']);
        $ItemName = mysqli_real_escape_string($con, $_POST['ItemName']);
        $ItemImg = mysqli_real_escape_string($con, $_POST['ItemImg']);
        $ItemDesc = mysqli_real_escape_string($con, $_POST['ItemDesc']);
        $ItemType = mysqli_real_escape_string($con, $_POST['ItemType']);
        $ItemPrice = mysqli_real_escape_string($con, $_POST['ItemPrice']);
        $ItemQty = mysqli_real_escape_string($con, $_POST['ItemQty']);

        $query = "UPDATE inventory_db SET ItemID='$ItemID',ItemName='$ItemName',ItemImg='$ItemImg',ItemDesc='$ItemDesc',ItemType='$ItemType',ItemPrice='$ItemPrice',ItemQty='$ItemQty' WHERE id=$InvID";
        
        $query_run = mysqli_query($con, $query);

        if($query_run) {
            ?>
            <script>
                swal("Success!", "Inventory item has been updated!", "success");
            </script>
            <?php
            $_SESSION['ItemID'] = $_POST['ItemID'];
            $_SESSION['ItemName'] = $_POST['ItemName'];
            $_SESSION['ItemImg'] = $_POST['ItemImg'];
            $_SESSION['ItemDesc'] = $_POST['ItemDesc'];
            $_SESSION['ItemType'] = $_POST['ItemType'];
            $_SESSION['ItemPrice'] = $_POST['ItemPrice'];
            $_SESSION['ItemQty'] = $_POST['ItemQty'];
            mysqli_close($con);

        } else {
            ?>
            <script>
                swal("Error.", "Error occured while submitting form.", "error");
            </script>
            <?php
        }
    }
?>

<title> Edit Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <?php if($inv): ?>
        
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="font-size: 54px;text-align: left;color:black;">Edit Inventory Item</h2>
                </div>
                <div class="content"></div>
            </div>
            <div class="container profile profile-view" id="profile" style="background: #ffffff">
                <div class="row">
                    <div class="col-md-12 alert-col relative">
                        <div class="alert alert-info alert-dismissible absolue center" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><span>Profile save with success</span></div>
                    </div>
                </div>
                <form action="EditInventoryItem.php?id=<?php echo $inv['id'] ?>" method="POST">
                    <div class="row profile-row">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div class="avatar-bg center" style="background: url(<?php echo $inv['ItemImg']; ?>); background-size: cover; background-position: 50% 50%;"></div>
                            </div>
                            <input class="form-control form-control my-3" type="file" id="ItemImg" name="ItemImg" name="avatar-file">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="col-form-label" for="item-id">Item ID </label>
                                    <input class="form-control item" type="text" id="ItemID" name="ItemID" value="<?php echo $inv['ItemID']; ?>" required>
                                </div>
                                <div class="col-md-10">
                                    <label class="col-form-label" for="item-name">Item Name </label>
                                    <input class="form-control item" type="text" id="ItemName" name="ItemName" value="<?php echo $inv['ItemName']; ?>" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="item-desc">Item Description </label>
                                    <textarea type="text" rows="10" class="form-control" id="ItemDesc" name="ItemDesc" required><?php echo $inv['ItemDesc']; ?></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-qty">Item Quantity </label>
                                    <input class="form-control item" type="text" id="ItemQty" name="ItemQty" value="<?php echo $inv['ItemQty']; ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-type">Item Type </label>
                                    <input class="form-control item" type="text" id="ItemType" name="ItemType" value="<?php echo $inv['ItemType']; ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="item-price">Item Price (in Php) </label>
                                    <input class="form-control item" type="text" id="ItemPrice" name="ItemPrice" value="<?php echo $inv['ItemPrice']; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right">
                                    <input class="btn btn-primary form-btn" type="submit" id="submit" name="submit" value="SAVE" href="modal_show" >
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