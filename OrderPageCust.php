
<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $no_of_records_per_page = 1;

    $offset = ($page-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM orders_db";
    $result = mysqli_query($con, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM orders_db LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con, $sql);
        $orders = mysqli_fetch_all($res_data, MYSQLI_ASSOC);
        mysqli_free_result($result);

        if(isset($_SESSION['login_id'])) {
            $id = mysqli_real_escape_string($con, $_SESSION['login_id']);

            // gets specific records based on current user
            $item = "SELECT orders_db.*, cust_profile.c_name 
                    FROM cust_profile
                    LEFT JOIN orders_db ON orders_db.c_id = cust_profile.c_id
                    WHERE orders_db.c_id = $id
                    LIMIT $offset, $no_of_records_per_page";
            
            $result = mysqli_query($con, $item);

            $result = $con->query($item);
            $orders = $result->fetch_all();

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
            <div class="container" style="color: var(--bs-btn-hover-border-color);">
                <div class="block-heading">
                <?php foreach($orders as $order): ?>
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;"> # <?php echo $order[1] ?></h2>
                    <h2 style="font-size: 18px;text-align: left;margin-bottom: 10.2px;margin-top:10px; color:black;"><?php echo $order[17] ?></h2> 
                </div>
            </div>
			<div class="container">
        <div class="row">
        
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5> <br>
						<div class="image">
		<div class="column">
		<img src="<?php echo $order[3] ?> " height="120px" width="120px"></div>
      </div>
	  
      <div class="text">
		  <div class="column">
		  
		 <!-- ORDER DETAILS AS PER USER INPUT -->
		<b> Order Details: </b> <br> <?php echo $order[2] ?> 
		 <br> <br>
		 <div class="row"><b> Shipping Details: </b><?php echo $order[15] ?></div> </div>
		<div class="column"><b>Order Due: </b>  <br> <?php echo $order[9] ?>
		<br>
		<br>
		<div class="row"> <b>Order Status: </b><?php echo $order[16] ?>
		
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
                        <h5 class="card-title"> <a href="AddPaymentCust.php?id=<?php echo $order[1] ?>">Payment</h5></a>
                        <p class="card-text">
                            <br> <b>Amount: </b>
							<br> <b>Mode of Payment: </b> <?php echo $order[12] ?> 
							<br> <b>Status of Payment: </b> <?php echo $order[16] ?> 
							<br> <b>Proof of Payment: </b> <?php echo $order[11] ?> 
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
                            <div class="column"><b> Item Name: </b> <br> <?php echo $order[2] ?> </div>
                            <div class="column"><b> Item Price: </b> <br> PHP <?php echo $order[10] ?> </div>
                            <div class="column"><b> Order Date: </b> <br> <?php echo $order[9] ?> </div>
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
                            <br> <b>Courier: </b> <?php echo $order[14] ?> 
							<br> <b>Tracking Number: </b> <?php echo $order[13] ?> 
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
OrderPageCust.php
Displaying OrderPageCust.php.