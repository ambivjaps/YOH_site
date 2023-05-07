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

    if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);
        $filePath = $_POST['delete_img'];

        $sql_error = "SELECT * FROM inventory_db WHERE ItemID = $delete_id ";
        $error_run = mysqli_query($con, $sql_error);
        if($error_run && mysqli_num_rows($error_run) > 0){
            $user_data = mysqli_fetch_assoc($error_run);

            $sql_err = "SELECT * FROM orders_db WHERE ItemID = $delete_id ";
            $err_run = mysqli_query($con, $sql_err);

            if($err_run && mysqli_num_rows($err_run) > 0){
            $order_data = mysqli_fetch_assoc($err_run);

            if($order_data["ItemID"] == $user_data["ItemID"]){
            echo '<script> window.location.replace("InventoryItem.php?id='.$delete_id.'&delete=error");</script>';
                }
            }
		else{
            $sql = "DELETE FROM inventory_db WHERE ItemID = $delete_id";
            $run = mysqli_query($con, $sql);
            if($run){
                if (file_exists($filePath)) {
                    unlink($filePath);
                } 
                ?>
                    <script>
                        window.location.replace("Inventory.php");
                    </script>
                <?php
            }
			
		} 
	}}

?>
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
            width: 23%;
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

<title> Inventory Item: <?php echo $inv['ItemName']; ?>  | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<?php if($inv): ?>

        <main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef; border:none; ">
            <div class="container">

            <form class="mb-3" action="InventoryItem.php?id=<?php echo $inv['ItemID'] ?>" method="POST" id="form">
            <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: indigo;background: indigo;"><a href="Inventory.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
			    <a class="btn btn-dark" href="EditInventoryItem.php?id=<?php echo $inv['ItemID'] ?>" type="submit" name="edit" role="button" style="font-weight:bold;border-color:indigo;background-color:indigo;"><i class="fas fa-edit"></i> Edit</a>
			    <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $inv['ItemID']; ?>">
                <input type="hidden" name="delete_img" value="<?php echo $inv['ItemImg']; ?>">
			    <input class="btn btn-danger" name="delete" role="button" value="Delete" style="font-weight:bold;width:100px;">
		    </form>

        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body" style="background:#efe9ef;">
                <div class="account-settings">
                    <div class="user-profile">
                        <div class="user-avatar" >
                            <img src="<?php echo $inv['ItemImg']; ?>" style="height:200px; width:200px;">
                        </div>
                        <h5 class="user-name" style="font-weight: bold; font-size:40px; color: var(--bs-indigo);"><?php echo $inv['ItemName']; ?></h5>
                        <p style="font-weight: bold; ">ID: <?php echo $inv['ItemID']; ?></p>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body" style="background:#efe9ef;">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 style="font-weight: bold; font-size:40px; text-align:center; " >Item Details</h6>
                        <?php 
                if (isset($_GET['delete']) && $_GET['delete'] === 'error') { ?>
                    <p class="rounded" style="font-weight:bold;text-align:center;color:white;background-color:red;">
                     Error in deleting item. 
                    Item in order cannot be deleted. 
                    <p>     
                <?php } ?> 
                        <hr>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold; font-size:30px; ">Type</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $inv['ItemType']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold;font-size:30px; ">Quantity</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $inv['ItemQty']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold;font-size:30px; " >Price</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;">Php<?php echo $inv['ItemPrice']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold;font-size:30px; ">Description</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo nl2br($inv['ItemDesc']) ?></p>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
        </div>
        </div>
        </div>
        
        <?php else: ?>
            <div class="container my-5">
                <h2> Oops.. Page not found. Please try again. </h2>
            </div>
        <?php endif ?>

    </section>
</main>
        <div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;" onClick="deleteInventory()">OK
                    <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $inv['ItemID']; ?>">
                </button>
                    <button class="btn mt-3" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;" onClick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>

        <script>
            document.getElementsByName('delete')[0].addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('deleteModal').style.display = 'block';
            });

            function closeModal() {
                document.getElementById('deleteModal').style.display = 'none';
            }

            function deleteInventory() {
                document.getElementById("form").submit();
            }
        </script>

<?php require 'layouts/Footer.php';?>