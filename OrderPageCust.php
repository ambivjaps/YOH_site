
<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    if(isset($_SESSION['login_id'])) {
		$id = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$item = "SELECT * FROM orders_db INNER JOIN cust_profile 
        ON orders_db.c_id = cust_profile.c_id INNER JOIN inventory_db 
        ON orders_db.ItemID = inventory_db.ItemID  WHERE cust_status = '1' LIMIT 1";

		$result = mysqli_query($con, $item);
		$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    mysqli_free_result($result);
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
        <section class="clean-block payment-form dark" style="height: 1061.328px; background-color:#efe9ef;">
        <?php foreach($orders as $order): ?>
            <div class="container" style="color: var(--bs-btn-hover-border-color);">
                <div class="block-heading">
             
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;"> Order # <?php echo $order['OrderID']; ?> </h2>
                    <h2 style="font-size: 18px;text-align: left;margin-bottom: 10.2px;margin-top:10px; color:black;"></h2> 
                </div>
            </div>
			<div class="container">
        <div class="row">
        
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $order['ItemName']; ?></h5> <br>
						<div class="image">
		<div class="column">
		<img src="<?php echo $order['ItemImg']; ?>" height="120px" width="120px"></div>
      </div>
	  
      <div class="text">
		  <div class="column">
		  
		 <!-- ORDER DETAILS AS PER USER INPUT -->
        
		<b> Order Details: </b> <br> 
		 <br> <br>
		 <div class="row"><b> Shipping Details: <?php echo $order['address']; ?></b></div> </div>
		<div class="column"><b>Order Due: <?php echo date("F d, Y", strtotime($order['OrderDate'])); ?> </b>  <br>
		<br>
		<br>
		<div class="row"> <b>Order Status: <?php echo $order['OrderType']; ?> </b>
		
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
                        <h5 class="card-title"> <a href="AddPaymentCust.php?id=">Payment</h5></a>
                        <p class="card-text">
                            <br> <b>Amount: Php<?php echo $order['OrderTotal']; ?> </b>
							<br> <b>Mode of Payment: <?php echo $order['p_mode']; ?> </b> 
							<br> <b>Status of Payment: <?php echo $order['pay_status']; ?> </b> 
							<br> <b>Proof of Payment: <?php echo $order['proof_img']; ?> </b> 
                        </p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
	
	<div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="" alt="">
  
                    <div class="card-body">
                        <h5 class="card-title">Order History</h5>
                        <p class="card-text">
                            <div class="column"><b> Item Name: </b> <br> </div>
                            <div class="column"><b> Item Price: </b> <br> PHP  </div>
                            <div class="column"><b> Order Date: </b> <br>  </div>
						<br> <br>
						</p>
						<br>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="" alt="">
  
                    <div class="card-body">
                        <h5 class="card-title">Tracking Details</h5>
                        <p class="card-text">
                            <br> <b>Courier: <?php echo $order['courier_id']; ?>
							<br> <b>Tracking Number: <?php echo $order['tracking_no']; ?>
							<br> <br>
                        </p>
						<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

        </section>
    </main>

<?php require 'layouts/Footer.php';?>