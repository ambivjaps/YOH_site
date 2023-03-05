<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
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

    <div class="container my-5">

        <form class="mb-3" action="InventoryItem.php" method="POST">
			<a class="btn btn-dark" href="EditInventoryItem.php?id=<?php echo $inv['ItemID'] ?>" type="submit" name="edit" role="button">Edit</a>
			<input type="hidden" class="delete_id" name="delete_id" value="<?php echo $inv['ItemID']; ?>">
			<input class="btn btn-dark" type="submit" name="delete" role="button" value="Delete">
		</form>

        <h1> <?php echo $inv['ItemName'] ?> </h1>
        <h1> <?php echo $inv['ItemType'] ?> </h1>




    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>


<?php require 'layouts/Footer.php';?>