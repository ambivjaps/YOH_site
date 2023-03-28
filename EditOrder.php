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
        $CurrentQTY = $order['OrderQty'];
        $CustProf = $_POST['CustProf'];
        $InvItem = $_POST['InvItem'];
        $OrderType = $_POST['OrderType'];
        $OrderQty = mysqli_real_escape_string($con, $_POST['OrderQty']);

        if($OrderType == 'On-Going'){
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

        $selectPrice = $selected_item['ItemPrice'];

        $OrderTotal = $OrderQty * $selectPrice;

        if($OrderQty > $selected_item['ItemQty']){
            header("Location: EditOrder.php?id=$id&edit=error");
        }else{
        $query = "UPDATE orders_db SET c_id='$CustProf',ItemID='$InvItem',OrderType='$OrderType',OrderQty='$OrderQty',OrderTotal='$OrderTotal' WHERE OrderID=$OID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['CustProf'] = $_POST['CustProf'];
            $_SESSION['InvItem'] = $_POST['InvItem'];
            $_SESSION['OrderType'] = $_POST['OrderType'];
            $_SESSION['OrderQty'] = $_POST['OrderQty'];

            if($CurrentQTY !== $OrderQty){
            $sql = "UPDATE inventory_db SET ItemQty=ItemQty+$CurrentQTY-$OrderQty WHERE ItemID='$InvItem' ";
            $result = mysqli_query($con, $sql);
            if($result) {
            header("Location: OrdersAdminView.php");
            mysqli_close($con);
            exit();
            }
        }
            header("Location: OrdersAdminView.php");
            mysqli_close($con);
            exit();
        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
        
    }
}
?>

<title> Edit Order | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>


    <?php if($order): ?>

    <div class="container my-5">

        <h1 style="font-weight:bold;"> Edit Order <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background: indigo;width:40px;"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
        <div class="form-group">
            <form action="EditOrder.php?id=<?php echo $order['OrderID']; ?>" method="POST" id="form">
                <div class="row my-3">
                    <h3 class="my-3" style="font-weight:bold;"> Order Details </h3>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Customer</label>
                        <select class="form-select" id="CustProf" name="CustProf" aria-label=".form-select example">
                            <?php foreach($prof_sel as $prof): ?>
                            <option value="<?php echo $prof['c_id'] ?>" <?php if($order['c_name'] == $prof['c_name']) { ?>selected="selected"<?php } ?>><?php echo $prof['c_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Item</label>
                        <select class="form-select" id="InvItem" name="InvItem" aria-label=".form-select example">
                            <?php foreach($inv_item as $inv): ?>
                            <option value="<?php echo $inv['ItemID'] ?>" <?php if($order['ItemName'] == $inv['ItemName']) { ?>selected="selected"<?php } ?>><?php echo $inv['ItemName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Order Type</label>
                        <select class="form-select" id="OrderType" name="OrderType" aria-label=".form-select example">
                            <option value="On-Going" <?php if($order['OrderType'] == 'On-Going') { ?>selected="selected"<?php } ?>>On-Going</option>
                            <option value="Completed" <?php if($order['OrderType'] == 'Completed') { ?>selected="selected"<?php } ?>>Completed</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Order Quantity</label>
                        <input type="text" name="OrderQty" id="OrderQty" class="form-control" value="<?php echo $order['OrderQty']; ?>" required>
                        <br>
                    </div>
                    
                    <?php 
                    if (isset($_GET['edit']) && $_GET['edit'] === 'error') { ?>
                        <p style="font-weight:bold;color:red;text-align:center;"> Error in editing order. 
                    Quantity of order cannot exceed quantity of item.</p>
                             
                    <?php } ?>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editOrder" name="edit_order" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;font-weight:bold;" readonly>
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="editOrder()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
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