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

		$item = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id INNER JOIN inventory_db 
        ON orders_db.ItemID = inventory_db.ItemID  WHERE OrderID = $id AND cust_status = '1'";

		$result = mysqli_query($con, $item);
		$order = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}

?>

<?php 
    if(isset($_POST['edit_order'])) {
        $OID = $order['OrderID'];
    
        $OrderType = mysqli_real_escape_string($con, $_POST['OrderType']);
    
        $query = "UPDATE orders_db SET OrderType='$OrderType' WHERE OrderID=$OID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['OrderType'] = $_POST['OrderType'];

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
            <form action="EditOrder.php?id=<?php echo $order['id'] ?>" method="POST" id="form">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Order Type</label>
                        <input type="text" name="OrderType" id="OrderType" class="form-control" value="<?php echo $order['OrderType'] ?>">
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