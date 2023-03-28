
<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    if(isset($_SESSION['login_id'])) {
        // current orders
		$id = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$item = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id INNER JOIN inventory_db 
        ON orders_db.ItemID = inventory_db.ItemID  WHERE cust_profile.cust_status = '1' AND orders_db.c_id = $id AND orders_db.TypeID = '1'";

		$result_process = mysqli_query($con, $item);
		$orders = mysqli_fetch_all($result_process, MYSQLI_ASSOC);
	    mysqli_free_result($result_process);

        // past orders
        $item_history = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id INNER JOIN inventory_db 
        ON orders_db.ItemID = inventory_db.ItemID  WHERE cust_profile.cust_status = '1' AND orders_db.c_id = $id AND orders_db.TypeID = '2'";

		$result_past = mysqli_query($con, $item_history);
		$orders_past = mysqli_fetch_all($result_past, MYSQLI_ASSOC);
	    mysqli_free_result($result_past);
	}

    require 'layouts/Header.php';
?>

<title> Orders Page | Yarn Over Hook </title>

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

    <main class="page payment-page;">
        <section class="clean-block payment-form dark" style="background-color:#efe9ef;"><br><br>
        <?php if (!empty($orders)) { ?>
        <?php foreach($orders as $order): ?>
            <div class="container" style="color: var(--bs-btn-hover-border-color);">
                <div class="block-heading">
             
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: center;margin-top:64px; color:black;font-weight:bold;"> Order # <span style="color: rgb(111, 66, 193);"><?php echo $order['OrderID']; ?> </h2><hr>
                    <h2 style="font-size: 18px;text-align: left;margin-bottom: 10.2px;margin-top:10px; color:black;"></h2> 
                </div>
            </div>
			<div class="container">
        <div class="row">
        
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;color: rgb(111, 66, 193);"><?php echo $order['ItemName']; ?></h5><hr> <br>
						<div class="image">
		<div class="column">
		<img src="<?php echo $order['ItemImg']; ?>" height="120px" width="120px"></div>
      </div>
	  
      <div class="text">
		  <div class="column">
		  
		 <!-- ORDER DETAILS AS PER USER INPUT -->
        
		<b> Order Details:  </b> <br> 
		 <br> <br>
		 <div class="row" style="font-weight:bold;"><b> Shipping Details: <span style="font-weight:bold;color:indigo;"><?php echo $order['address']; ?></b></div> </div>
		<div class="column" style="font-weight:bold;"><b>Order Due: <span style="font-weight:bold;color:indigo;"><?php echo date("F d, Y", strtotime($order['OrderDate'])); ?> </b>  <br>
		<br>
		<br>
		<div class="row"> <b>Order Status: </b> <span class="badge bg-warning text-dark"> <?php echo $order['OrderType']; ?> </span>
		
		</select> </div> </div>
		
      </div> 
		</div>
        </div>
        </div>
			
			
            <div class="col-lg-6 mb-4">
                <div class="card">
				<i class="fa fa-trash-o" style="font-size:36px"></i>
                    <img class="card-img-top" src="" alt="">
                    <div class="card-body">
                        <h5 ><a href="AddPaymentCust.php?id=<?php echo $order['OrderID']; ?>" style="font-weight:bold; text-decoration:none;color: rgb(111, 66, 193);">Payment</h5></a><hr>
                        <p class="card-text">
                            <br> <b style="font-weight:bold;">Amount:  <span style="font-weight:bold;color:indigo;"> PHP <?php echo $order['OrderTotal']; ?> </b>
							<br> <b style="font-weight:bold;">Mode of Payment: 
                            <?php if (!empty($order['p_mode'])) { ?>
                                <span style="font-weight:bold;color:indigo; text-transform:capitalize;"> <?php echo $order['p_mode']; ?></span> </b> 
                            <?php } else {  ?>
                                <span style="font-weight:bold;color:indigo;">No mode of payment chosen yet.</span> </b> 
                            <?php } ?>

							<br> <b style="font-weight:bold;">Status of Payment: 
                            <?php if (!empty($order['pay_status'])) { ?>
                                <span style="font-weight:bold;color:indigo; text-transform:capitalize;"><?php echo $order['pay_status']; ?></span> </b> 
                            <?php } else {  ?>
                                <span style="font-weight:bold;color:indigo;">No payment status chosen yet.</span> </b> 
                            <?php } ?>

							<br> <b style="font-weight:bold;">
                            Proof of Payment:
                            <?php if (!empty($order['proof_img'])) { ?>
                                <a class="btn btn-primary btn-sm rounded" href="<?php echo $order['proof_img']; ?>" style="font-weight:bold;background:indigo;border-color:indigo;"> Click here to view receipt </a>
                            <?php } else { ?>
                                <a class="btn btn-primary btn-sm rounded no-receipt" style="font-weight:bold;background:indigo;border-color:indigo;"> Click here to view receipt </a>
                            <?php }?>
                        </p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
	
	<div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card"> 
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;color: rgb(111, 66, 193);">Tracking Details</h5><hr>
                        <p class="card-text">
                            <br> <b>Courier: </b>
                            <?php if (!empty($order['courier_id'])) { ?>
                            <span style="font-weight:bold;color:indigo;"><?php echo $order['courier_id']; ?> </span>
                            <?php } else { ?>
                            <span style="font-weight:bold;color:indigo;">No courier selected yet. </span>
                            <?php } ?>
                            
                            <br> <b>Tracking Number: </b>
                            <?php if (!empty($order['tracking_no'])) { ?>
							<span style="font-weight:bold;color:indigo;"><?php echo $order['tracking_no']; ?> </span>
                            <?php } else { ?>
                            <span style="font-weight:bold;color:indigo;">No tracking number added yet. </span>
                            <?php } ?>
							<br> <br>
                        </p>
						<br>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php } else { ?>
                <div class="container my-5">
                    <h2 class="card-text" style="font-weight:bold;"> You have no orders in process. Please place an order. </h2>
                </div>
        <?php } ?>

        <div class="container my-5">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;color: rgb(111, 66, 193);">Your Order History</h5><hr>

                        <?php if (!empty($orders_past)) { ?>
                            <p class="card-text">
                                <div class="row">
                                    <table class="table table-striped table-hover table-sm mt-5">
                                    <tr>
                                        <th> Order# </th>
                                        <th> Item Name: </th>
                                        <th> Total Price: </th>
                                        <th> Order Date: </th>
                                        <th> Order Status: </th>
                                    </tr>
                
                                <?php $loop=1; foreach($orders_past as $history): ?>
                                    <tr><td>  <?php echo $loop; ?> </td>
                                    <td>  <?php echo $history['ItemName']; ?> </td>
                                    <td> <?php echo $history['OrderTotal']; ?> </td>
                                    <td> <?php echo date("F d, Y", strtotime($history['OrderDate'])); ?> </td>
                                    <td> <span class="badge bg-success"><?php echo $history['OrderType']; ?> </span> </td></tr>
                                <?php $loop++; endforeach; ?>
                                </table>
                                </div>
                            <br> <br>
                            </p>
                        <?php } else { ?>
                            <p class="card-text"> No completed order history available for your account. </p>
                        <?php } ?>

						<br>
                    </div>
                </div>
            </div>
        
                </div>
            </div>
        </div>

        </section>
        <div id="myModal2" class="modal">
            <div class="modal-content">
                <p style="text-align:center;font-weight:bold">No uploaded receipt</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="okBtn" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        [...document.getElementsByClassName('no-receipt')].forEach((e) => {
            e.addEventListener('click', () => {
                document.getElementById('myModal2').style.display='block';
            });
        });

        document.getElementById('okBtn').addEventListener('click', () => {
            document.getElementById('myModal2').style.display='none';
        });
    </script>

<?php require 'layouts/Footer.php';?>