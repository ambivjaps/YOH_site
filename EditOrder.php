<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    
    access('ADMIN');
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

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);

		$item = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id INNER JOIN inventory_db 
        ON orders_db.ItemID = inventory_db.ItemID  WHERE OrderID = $id AND cust_profile.cust_status = '1'";

		$result = mysqli_query($con, $item);
		$order = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}

?>

<?php 
    if(isset($_POST['edit_order'])) {
        $OID = $order['OrderID'];

        $CustProf = $_POST['CustProf'];
        $InvItem = $_POST['InvItem'];
        $OrderType = $_POST['OrderType'];

        $OrderQty = mysqli_real_escape_string($con, $_POST['OrderQty']);
        $courier_id = mysqli_real_escape_string($con, $_POST['courier_id']);
        $tracking_no = mysqli_real_escape_string($con, $_POST['tracking_no']);

        if($OrderType == 'In Process'){
            $query = "UPDATE orders_db SET TypeID='1' WHERE OrderID=$OID";
            $query_run = mysqli_query($con, $query);
        } else if($OrderType == 'Completed') {
            $query = "UPDATE orders_db SET TypeID='2' WHERE OrderID=$OID";
            $query_run = mysqli_query($con, $query);
        } else {
            die;
        }

        $item = "SELECT * FROM inventory_db WHERE ItemID = $InvItem";
		$result = mysqli_query($con, $item);
		$selected_item = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

        $selectPrice = $selected_item['ItemPrice'];

        $OrderTotal = $OrderQty * $selectPrice;
    
        $query = "UPDATE orders_db SET c_id='$CustProf',ItemID='$InvItem',OrderType='$OrderType',OrderQty='$OrderQty',OrderTotal='$OrderTotal',courier_id='$courier_id',tracking_no='$tracking_no' WHERE OrderID=$OID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['CustProf'] = $_POST['CustProf'];
            $_SESSION['InvItem'] = $_POST['InvItem'];
            $_SESSION['OrderType'] = $_POST['OrderType'];
            $_SESSION['OrderQty'] = $_POST['OrderQty'];
            $_SESSION['courier_id'] = $_POST['courier_id'];
            $_SESSION['tracking_no'] = $_POST['tracking_no'];

            mysqli_close($con);
            header("Location: OrdersAdminView.php");
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
        
    }
?>

<title> Edit Order | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>


    <?php if($order): ?>

    <div class="container my-5">

        <h1> Edit Order </h1>
        <div class="form-group">
            <form action="EditOrder.php?id=<?php echo $order['OrderID']; ?>" method="POST" id="form">
                <div class="row my-3">
                    <h3 class="my-3"> Order Details </h3>

                    <div class="col-md-12">
                        <label>Customer (Current: <?php echo $order['c_name']; ?>)</label>
                        <select class="form-select" id="CustProf" name="CustProf" aria-label=".form-select example">
                            <?php foreach($prof_sel as $prof): ?>
                            <option value="<?php echo $prof['c_id'] ?>"><?php echo $prof['c_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Item (Current: <?php echo $order['ItemName']; ?>)</label>
                        <select class="form-select" id="InvItem" name="InvItem" aria-label=".form-select example">
                            <?php foreach($inv_item as $inv): ?>
                            <option value="<?php echo $inv['ItemID'] ?>"><?php echo $inv['ItemName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label>Order Type (Current: <?php echo $order['OrderType']; ?>)</label>
                        <select class="form-select" id="OrderType" name="OrderType" aria-label=".form-select example">
                            <option value="In Process">In Process</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Order Quantity</label>
                        <input type="text" name="OrderQty" id="OrderQty" class="form-control" value="<?php echo $order['OrderQty']; ?>">
                    </div>

                    <h3 class="my-3"> Shipping Details </h3>
                    <div class="col-md-12">
                        <label>Courier</label>
                        <input type="text" name="courier_id" id="courier_id" class="form-control" value="<?php echo $order['courier_id']; ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Tracking Number</label>
                        <input type="text" name="tracking_no" id="tracking_no" class="form-control" value="<?php echo $order['tracking_no']; ?>">
                    </div>

                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editOrder" name="edit_order" value="Submit" style="width:8%">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button onClick="editOrder()">OK</button>
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
        document.getElementById('editOrder').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editOrder() {
            document.getElementById("form").submit();
        }
    </script>
    
<?php require 'layouts/Footer.php';?>