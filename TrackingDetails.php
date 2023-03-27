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
    $order = mysqli_fetch_assoc($result);
    
    mysqli_free_result($result);
}

require 'layouts/Header.php';
?>

<?php 
    if(isset($_POST['add_tracking'])) {
        $OID = $order['OrderID'];

        $courier_id = $_POST['courier_id'];
        $tracking_no = $_POST['tracking_no'];
    
        $query = "UPDATE orders_db SET courier_id='$courier_id', tracking_no='$tracking_no' WHERE OrderID=$OID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['courier_id'] = $_POST['courier_id'];
            $_SESSION['tracking_no'] = $_POST['tracking_no'];
            header("Location: OrderPageAdmin.php?id=".$OID);
            mysqli_close($con);
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
    
    if(isset($_GET['delete'])){
        
        $OID = $order['OrderID'];
        
        $query = "UPDATE orders_db WHERE OrderID=$OID";
        $query_run = mysqli_query($con, $query);
        if($query_run) {
            header("Location: OrderPageAdmin.php");
            
            exit();
        }
    }
?>

<title> Tracking Details | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
   <div class="container my-5">

        <h1 style="font-weight:bold;"> Tracking Details <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: #AC99CF;background: #AC99CF;width:40px;"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1>
        <hr>
        <div class="form-group">
            <form action="TrackingDetails.php?id=<?php echo $order['OrderID']; ?>" method="POST">
                <div class="row my-3">
                    <div class="col-md-12">
                        <p class="item-name" style="margin-bottom: 13.2px;color: rgb(111, 66, 193);font-weight:bold;" input="read-only" style="font-weight:bold;">Courier </p>
                            <select class="form-select" id="p_mode" name="courier_id" aria-label=".form-select example" required>
                              <option value="Paymaya" <?php if($order['courier_id'] == 'J&T') { ?>selected="selected"<?php } ?> style="font-weight:bold;">J&T</option>
                              <option value="BDO" <?php if($order['courier_id'] == 'Fifth Express') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Fifth Express</option>
                              <option value="GCash" <?php if($order['courier_id'] == 'Lalamove') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Lalamove</option>
                              <option value="Paypal" <?php if($order['courier_id'] == 'Grab') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Grab</option>
                              <option value="Paypal" <?php if($order['courier_id'] == 'Mr. Speedy') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Mr. Speedy</option>
                            </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Tracking Number</label>
                        <input type="text" name="tracking_no" id="tracking_no" class="form-control" value="<?php echo $order['tracking_no']; ?>">
                    </div>

                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" name="add_tracking" value="Submit" style="width:150px;border-color:rgb(119,13,253);background-color:rgb(119,13,253);">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;">
                    </div>
                </div>
                <form>

                    </div>
                </form>
            </div>
        </section>
    </main>
    
    <div id="myModal2" class="modal">
            <div class="modal-content">
                <p style="text-align:center;font-weight:bold;">Do you want to reset the tracking details?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="okBtn" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                    <button class="btn bg-danger text-white mt-3" id="cancelBtn" style="border-color:indigo;font-weight:bold;width:100px;">Cancel</button>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        document.getElementsByName('delete')[0].addEventListener('click', () => {
            document.getElementById('myModal2').style.display='block';
        });

        document.getElementById('cancelBtn').addEventListener('click', () => {
            document.getElementById('myModal2').style.display='none';
        });

        document.getElementById('okBtn').addEventListener('click', () => {
            const id = document.getElementsByName('id-order')[0].value;
            window.location.href = 'AddPaymentCust.php?id=' + id + '&delete=true';
        });
    </script>

<?php require 'layouts/Footer.php';?>