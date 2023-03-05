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
     if(isset($_POST['submit'])) {
        $InvID = $inv['ItemID'];
    
        $ItemName = mysqli_real_escape_string($con, $_POST['ItemName']);
        $ItemImg = mysqli_real_escape_string($con, $_POST['ItemImg']);
        $ItemDesc = mysqli_real_escape_string($con, $_POST['ItemDesc']);
        $ItemQty = mysqli_real_escape_string($con, $_POST['ItemQty']);
        $ItemType = $_POST['ItemType'];
        $ItemPrice = mysqli_real_escape_string($con, $_POST['ItemPrice']);
    
        $query = "UPDATE inventory_db SET ItemName='$ItemName',ItemImg='$ItemImg',ItemDesc='$ItemDesc',ItemQty='$ItemQty',ItemType='$ItemType',ItemPrice='$ItemPrice' WHERE ItemID=$InvID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['ItemName'] = $_POST['ItemName'];
            $_SESSION['ItemImg'] = $_POST['ItemImg'];
            $_SESSION['ItemDesc'] = $_POST['ItemDesc'];
            $_SESSION['ItemQty'] = $_POST['ItemQty'];
            $_SESSION['ItemType'] = $_POST['ItemType'];
            $_SESSION['ItemPrice'] = $_POST['ItemPrice'];

            mysqli_close($con);
            header("Location: Inventory.php");
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

        <h1> Edit Inventory Item </h1>
        <div class="form-group">
            <form action="EditInventoryItem.php?id=<?php echo $inv['ItemID'] ?>" method="POST">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label>Avatar</label>
                        <input type="file" class="form-control form-control my-3" name="ItemImg">
                    </div>
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="ItemName" id="ItemName" class="form-control" value="<?php echo $inv['ItemName'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Type <strong>(Current type: <?php echo $inv['ItemType']; ?>)</strong></label>
                        <select class="form-select" id="ItemType" name="ItemType" aria-label=".form-select example">
                            <option value="Raw">Raw</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Quantity</label>
                        <input type="text" name="ItemQty" id="ItemQty" class="form-control" value="<?php echo $inv['ItemQty'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Price (in Php)</label>
                        <input type="text" name="ItemPrice" id="ItemPrice" class="form-control" value="<?php echo $inv['ItemPrice'] ?>">
                    </div>      
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea type="text" rows="5" class="form-control" name="ItemDesc" id="ItemDesc"><?php echo $inv['ItemDesc'] ?></textarea>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>


<?php require 'layouts/Footer.php';?>