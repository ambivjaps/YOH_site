<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);
    
    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$item = "SELECT * FROM inventory_db WHERE ItemID = $id";
		$result = mysqli_query($con, $item);
		$inv = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<?php 
     if(isset($_POST['edit_inventory'])) {
        $InvID = $inv['ItemID'];
    
        $ItemName = mysqli_real_escape_string($con, $_POST['ItemName']);
        $ItemDesc = mysqli_real_escape_string($con, $_POST['ItemDesc']);
        $ItemQty = mysqli_real_escape_string($con, $_POST['ItemQty']);
        $ItemType = $_POST['ItemType'];
        $ItemPrice = mysqli_real_escape_string($con, $_POST['ItemPrice']);

        $new_image = $_FILES['ItemImg']['name'];
        $old_image = $_POST['ItemImg_old'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        if($new_image != '') {
            $update_filename = 'assets/img/upload/inventory/' . $unique . $_FILES['ItemImg']['name'];
        } else {
            $update_filename = $old_image;
        }

        if(file_exists("assets/img/upload/inventory/" . $_FILES['ItemImg']['name'])) {
        } else {
            $query = "UPDATE inventory_db SET ItemImg='$update_filename' WHERE ItemID='$InvID' ";
            $query_run = mysqli_query($con, $query);

            if($query_run) {
                if($_FILES['ItemImg']['name'] != '') {
                    move_uploaded_file($_FILES['ItemImg']['tmp_name'], "assets/img/upload/inventory/" . $unique . $_FILES['ItemImg']['name']);
                    unlink($old_image);
                }
            } else {
                echo "<script> alert('Problem occured.') </script>";
            }
        }

        if($ItemType == 'Raw'){
            $query = "UPDATE inventory_db SET TypeID='2' WHERE ItemID=$InvID";
            $query_run = mysqli_query($con, $query);
        } else if($ItemType == 'Finished') {
            $query = "UPDATE inventory_db SET TypeID='1' WHERE ItemID=$InvID";
            $query_run = mysqli_query($con, $query);
        } else {
            die;
        }
    
        $query = "UPDATE inventory_db SET ItemName='$ItemName',ItemDesc='$ItemDesc',ItemQty='$ItemQty',ItemType='$ItemType',ItemPrice='$ItemPrice' WHERE ItemID=$InvID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['ItemName'] = $_POST['ItemName'];
            $_SESSION['ItemDesc'] = $_POST['ItemDesc'];
            $_SESSION['ItemQty'] = $_POST['ItemQty'];
            $_SESSION['ItemType'] = $_POST['ItemType'];
            $_SESSION['ItemPrice'] = $_POST['ItemPrice'];
            header("Location: Inventory.php");
            mysqli_close($con);
            exit();
        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Edit Inventory Item | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<?php if($inv): ?>

    <div class="container my-5">

        <h1 style="font-weight:bold;"> Edit Inventory Item <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: #AC99CF;background: #AC99CF;width:40px;"><a href="" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
        <div class="form-group">
            <form action="EditInventoryItem.php?id=<?php echo $inv['ItemID'] ?>" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Image</label>
                        <input class="form-control rounded" type="file" class="form-control form-control my-3" name="ItemImg">
                        <input  class="form-control rounded"type="hidden" name="ItemImg_old" value="<?php echo $inv['ItemImg']; ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="ItemName" id="ItemName" class="form-control rounded" value="<?php echo $inv['ItemName'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;"style="font-weight:bold;">Type</label>
                        <select class="form-select" id="ItemType" name="ItemType" aria-label=".form-select example">
                            <option value="Raw" <?php if($inv['ItemType'] == 'Raw') { ?>selected="selected"<?php } ?>>Raw</option>
                            <option value="Finished" <?php if($inv['ItemType'] == 'Finished') { ?>selected="selected"<?php } ?>>Finished</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Quantity</label>
                        <input type="text" name="ItemQty" id="ItemQty" class="form-control rounded" value="<?php echo $inv['ItemQty'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Price (in Php)</label>
                        <input type="text" name="ItemPrice" id="ItemPrice" class="form-control rounded" value="<?php echo $inv['ItemPrice'] ?>">
                    </div>      
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Description</label>
                        <textarea type="text" rows="5" class="form-control rounded" name="ItemDesc" id="ItemDesc"><?php echo $inv['ItemDesc'] ?></textarea>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editInventory" name="edit_inventory" value="Submit" style="width:150px;border-color:rgb(119,13,253);background-color:rgb(119,13,253);">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button onClick="editInventory()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>

    <script>
        document.getElementById('editInventory').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editInventory() {
            document.getElementById("form").submit();
        }
    </script>

<?php require 'layouts/Footer.php';?>