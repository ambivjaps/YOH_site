<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    require 'layouts/Header.php';

    $inv = "SELECT * FROM inventory_db ORDER BY ItemID";
	$result_inv = mysqli_query($con, $inv);
	$inv_item = mysqli_fetch_all($result_inv, MYSQLI_ASSOC);
	mysqli_free_result($result_inv);

    $prof = "SELECT * FROM cust_profile WHERE cust_status = '1'";
	$result_prof = mysqli_query($con, $prof);
	$prof_sel = mysqli_fetch_all($result_prof, MYSQLI_ASSOC);
	mysqli_free_result($result_prof);
?>

<?php 
    if(isset($_POST['submit'])) {

        $CustProf = $_POST['CustProf'];
        $InvItem = $_POST['InvItem'];
        $OrderType = $_POST['OrderType'];
        $OrderQty = mysqli_real_escape_string($con, $_POST['OrderQty']);

        if($OrderType == 'In Process'){
            $TypeID = "1";
        } else if($OrderType == 'Completed') {
            $TypeID = "2";
        } else {
            die;
        }

        $item = "SELECT * FROM inventory_db WHERE ItemID = $InvItem";
		$result = mysqli_query($con, $item);
		$selected_item = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

        $selectPrice = $selected_item['ItemPrice'];

        $OrderTotal = $OrderQty * $selectPrice;

        $query = "INSERT INTO orders_db (ItemID,c_id,OrderType,TypeID,OrderQty,OrderTotal) VALUES ('$InvItem','$CustProf','$OrderType','$TypeID','$OrderQty','$OrderTotal')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['CustProf'] = $_POST['CustProf'];
            $_SESSION['InvItem'] = $_POST['InvItem'];
            $_SESSION['OrderType'] = $_POST['OrderType'];
            $_SESSION['OrderQty'] = $_POST['OrderQty'];

            mysqli_close($con);
            header("Location: OrdersAdminView.php");
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Add Order | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">

    <h1> Add Order </h1>
        <div class="form-group">
            <form action="AddOrder.php" method="POST">
                <div class="row my-3">
                    <h3 class="my-3"> Order Details </h3>

                    <div class="col-md-12">
                        <label>Customer</label>
                        <select class="form-select" id="CustProf" name="CustProf" aria-label=".form-select example" required>
                            <?php foreach($prof_sel as $prof): ?>
                            <option value="<?php echo $prof['c_id'] ?>"><?php echo $prof['c_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Item</label>
                        <select class="form-select" id="InvItem" name="InvItem" aria-label=".form-select example" required>
                            <?php foreach($inv_item as $inv): ?>
                            <option value="<?php echo $inv['ItemID'] ?>"><?php echo $inv['ItemName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label>Order Type</label>
                        <select class="form-select" id="OrderType" name="OrderType" aria-label=".form-select example" required>
                            <option value="In Process">In Process</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Order Quantity</label>
                        <input type="text" name="OrderQty" id="OrderQty" class="form-control" required>
                    </div>
                   
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php require 'layouts/Footer.php';?>