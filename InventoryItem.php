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
		$sql = "DELETE FROM inventory_db WHERE ItemID = $delete_id";

		if(mysqli_query($con, $sql)) {
			header('Location: Inventory.php');
		} else {
			echo 'Error: ' . mysqli_error($con);
		}
	}

?>

<title> Inventory Item: <?php echo $inv['ItemName']; ?>  | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<?php if($inv): ?>

        <main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef; border:none; ">
            <div class="container">

            <form class="mb-3" action="InventoryItem.php" method="POST">
			    <a class="btn btn-dark" href="EditInventoryItem.php?id=<?php echo $inv['ItemID'] ?>" type="submit" name="edit" role="button">Edit</a>
			    <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $inv['ItemID']; ?>">
			    <input class="btn btn-dark" type="submit" name="delete" role="button" value="Delete">
		    </form>

        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body" style="background: #f4e3ff;">
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
            <div class="card-body" style="background: #f4e3ff;">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 style="font-weight: bold; font-size:40px; text-align:center; " >Item Details</h6>
                        <hr>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold; font-size:30px; ">Type</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $inv['ItemType']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold;font-size:30px; ">Quantity</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $inv['ItemQty']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold;font-size:30px; " >Price</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;">Php<?php echo $inv['ItemPrice']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label style="font-weight:bold;font-size:30px; ">Description</label>
                            <p class="rounded" style="font-size:15px;background:#cbc3e3; font-weight:bold; text-align:center;"><?php echo $inv['ItemDesc']; ?></p>
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


<?php require 'layouts/Footer.php';?>