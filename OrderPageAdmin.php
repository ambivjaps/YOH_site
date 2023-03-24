<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);

		$item = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id INNER JOIN inventory_db 
        ON orders_db.ItemID = inventory_db.ItemID  WHERE OrderID = $id AND cust_profile.cust_status = '1'";

		$result = mysqli_query($con, $item);
		$order = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}

    if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);
		$sql = "DELETE FROM orders_db WHERE OrderID = $delete_id";

		if(mysqli_query($con, $sql)) {
			header('Location: OrdersAdminView.php');
		} else {
			echo 'Error: ' . mysqli_error($con);
		}
	}
    
    require 'layouts/Header.php';
?>

<title> View Order | Yarn Over Hook </title>

<style>
.column {
  float: left;
  width: 33.33%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

#sel{
    width: 160px;
}
</style>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">

        <form class="mb-3" method="POST" id="form">
        <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;"><a href="OrdersAdminView.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
            <a class="btn btn-dark" href="EditOrder.php?id=<?php echo $order['OrderID']; ?>" type="submit" name="edit" role="button" style="font-weight:bold;border-color:indigo;background-color:indigo;"><i class="fas fa-edit"></i> Edit</a>
            <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $order['OrderID']; ?>" >
            <input class="btn btn-danger" name="delete" role="button" value="Delete" style="width: 8%;font-weight:bold;">
        </form><hr>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <img class="rounded img-fluid" src="<?php echo $order['ItemImg']; ?>">
                    </div>
                    <div class="col-md-8">
                        <h3 style="font-size:40px; color:indigo;"><strong> Order Details </strong></h3><hr style="width:50%;">
                        <h6 style="font-weight:bold;"> Order# <?php echo $order['OrderID']; ?> </h6>
                        <h6 style="font-weight:bold;"> Item Name: <?php echo $order['ItemName']; ?></h6>
                        <h6 style="font-weight:bold;"> Price: Php<?php echo $order['ItemPrice']; ?></h6>
                        <h6 style="font-weight:bold;"> Quantity: <?php echo $order['OrderQty']; ?></h6>
                        <h6 style="font-weight:bold;"> Materials Used: </h6>
                        <h6 style="font-weight:bold;"> Ordered by: <?php echo $order['c_name']; ?></h6>
                        <h6 style="font-weight:bold;"> Due on: <?php echo date("F d, Y", strtotime($order['OrderDate'])); ?></h6>
                        <h6 style="font-weight:bold;"> Status: <?php echo $order['OrderType']; ?></h6>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                    <h3 style="font-size:40px; color:indigo;"><strong> Payment </strong></h3><hr style="width:50%;">
                    <h6 style="font-weight:bold;"> Total Cost: Php<?php echo $order['OrderTotal']; ?></h6>
                    <h6 style="font-weight:bold;"> Mode of Payment: <?php echo $order['p_mode']; ?></h6>
                    <h6 style="font-weight:bold;"> Payment Status: <?php echo $order['pay_status']; ?></h6>
                    <h6 style="font-weight:bold;"> Proof of Payment: <a href="<?php echo $order['proof_img']; ?>" > Click here to view receipt. </a></h6>
                </div>
        </div>
        <br><hr>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                    <img class="rounded img-fluid" src="<?php echo $order['c_avatar']; ?>">
                    </div>
                    <div class="col-md-8">
                    <h3 style="font-size:40px; color:indigo;"><strong> Customer Details </strong></h3><hr style="width:50%;">
                        <h6 style="font-weight:bold;"> Customer Profile used: <?php echo $order['c_label']; ?></h6>
                        <h6 style="font-weight:bold;"> Name: <?php echo $order['c_name']; ?> </h6>
                        <h6 style="font-weight:bold;"> Address: <?php echo $order['address']; ?></h6>
                        <h6 style="font-weight:bold;"> Email: <?php echo $order['email']; ?></h6>
                        <h6 style="font-weight:bold;"> Region: <?php echo $order['region']; ?></h6>
                        <h6 style="font-weight:bold;"> City: <?php echo $order['city']; ?></h6>
                        <h6 style="font-weight:bold;"> Barangay: <?php echo $order['barangay']; ?></h6>
                        <h6 style="font-weight:bold;"> Phone No: <?php echo $order['phone_no']; ?></h6>
                        <h6 style="font-weight:bold;"> ZIP Code: <?php echo $order['zip_code']; ?></h6>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                    <h3 style="font-size:40px; color:indigo;"><strong> Tracking Details </strong></h3><hr style="width:50%;">
                    <h6 style="font-weight:bold;"> Courier: <?php echo $order['courier_id']; ?></h6>
                    <h6 style="font-weight:bold;"> Tracking Number: <?php echo $order['tracking_no']; ?></h6>
                </div>
        </div>
            
        <div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this?</p>
                <div class="modal-footer">
                    <button onClick="deleteOrderForm()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
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

            function deleteOrderForm() {
                document.getElementById("form").submit();
            }
        </script>

    </div>
	
<?php require 'layouts/Footer.php';?>