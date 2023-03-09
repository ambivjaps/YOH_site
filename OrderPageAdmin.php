<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $item = "SELECT * FROM orders_db WHERE OrderID = $id";
        $result = mysqli_query($con, $item);
        $orders = mysqli_fetch_assoc($result);
        
        mysqli_free_result($result);
    }
        if($orders){
            $profile = "SELECT * FROM cust_profile";
            $result = mysqli_query($con, $profile);
            $profiles = mysqli_fetch_array($result);

            if(isset($orders['c_id']) == isset($profiles['c_id'])){

            mysqli_free_result($result);
            }
        }
    
    
    
    
    require 'layouts/Header.php';
?>

<title> Orders Admin | Yarn Over Hook </title>

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
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black;">Order # <?php echo $orders['OrderID']?></h2>
                    <h2 style="font-size: 20px;text-align: left;margin-bottom: 10.2px;margin-top: 10px; color:black;">Customer Name: <?php echo $profiles['c_name']?></h2>
                    
                </div><a class="btn btn-primary" role="button" style="margin-left: 1168px;margin-bottom: 5px;margin-top: -162px;width: 123.1406px;background: rgb(220,53,69);border-style: none;" href="OrdersAdminView.php">Cancel</a><button class="btn btn-primary" type="button" style="margin-left: 1030px;margin-bottom: 5px;margin-top: -210px;width: 123.1406px; border-color: rgb(119,13,253);background: rgb(119,13,253); " href="OrdersPageAdminView.php">Save</button>
         
            </div>
			<div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5> <br>
						<div class="image">
		<div class="column">
		<img src="assets/img/avatars/nopic1.jpg" height="120px" width="120px"></div>
      </div>
	  
      <div class="text">
		  <div class="column">
		  
		 <!-- ORDER DETAILS AS PER USER INPUT -->
		 Order Details:
		 <br> <br> <br>
		 <div class="row"> Shipping Details: </div> </div>
		<div class="column">
		Order Due:
		<br> <input type="date">
		<br> <br>
		<div class="row"> Order Status: 
		<select name="" id="sel" >
      <option value="ON-GOING">ON-GOING</option>
      <option value="COMPLETED">COMPLETED</option>
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
                        <h5 class="card-title"> <a href="AddPaymentAdmin.php?id=<?php echo $orders['OrderID']?>">Payment</h5></a>
                        <p class="card-text">
                            <br> <b>Amount: <?php echo $orders['ItemPrice']?> </b>
							<br> <b>Mode of Payment: </b>
							<br> <b>Status of Payment: <?php echo $orders['pay_status']?> </b>
							<br> <b>Proof of Payment: </b>
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
                        <h5 class="card-title"> Order History</h5>
                        <p class="card-text">
                            <br> Some quick example text to build on 
                            the card title and make up the bulk 
                            of the card's content.
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
                        <h5 class="card-title"> <a href="TrackingDetails.php?id=<?php echo $orders['OrderID']?>">Tracking Details</h5>  </a>
                        <p class="card-text">
                            <br> <b>Courier: </b>
							<br> <b>Tracking Number: </b>
							<br> <br>
                        </p>
						<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
        </section>
    </main>
	
<?php require 'layouts/Footer.php';?>