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
?>

<title> Tracking Details | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
<main class="page payment-page">
        <div class="container my-5">

        <h1 style="font-weight:bold;"> Tracking Details <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background-color:indigo;width:40px;"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
            <div class="form-group">
                <form action="TrackingDetails.php?id=<?php echo $order['OrderID']; ?>" method="POST" enctype="multipart/form-data" style="border:none;">
            <div class="row my-3">
                <div class="col-md-12">
                    <label style="font-weight:bold;">Courier</label>
                    <select class="form-select rounded" id="courier_id" name="courier_id" aria-label=".form-select example" style="width:450px;font-weight:bold; font-size:18px;" required>
                    <option selected> Select Courier: </option>
                    <option value="J&T Express" <?php if($order['courier_id'] == 'J&T Express') { ?>selected="selected"<?php } ?> style="font-weight:bold;">J&T Express</option>
                    <option value="Fifth Express" <?php if($order['courier_id'] == 'Fifth Express') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Fifth Express</option>
                    <option value="Lalamove (Same day delivery)" <?php if($order['courier_id'] == 'Lalamove (Same day delivery)') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Lalamove (Same day delivery)</option>
                    <option value="Grab Express (Same day delivery)" <?php if($order['courier_id'] == 'Grab Express (Same day delivery)') { ?>selected="selected"<?php } ?> style="font-weight:bold;">Grab Express (Same day delivery)</option>
                    <option value="MrSpeedy (Same day delivery)" <?php if($order['courier_id'] == 'MrSpeedy (Same day delivery)') { ?>selected="selected"<?php } ?> style="font-weight:bold;">MrSpeedy (Same day delivery)</option>  
                    </select> <br>
                </div>
                <div class="col-md-12">
                    <label style="font-weight:bold;">Tracking Number</label>
                        <input class="form-control rounded" type="text" name="tracking_no" id="tracking_no" class="form-control" value="<?php echo $order['tracking_no']; ?>" style="width:450px;height:43px; font-weight:bold; font-size:18px;" required>
                        <input type="text" name="id-order" value="<?php echo $order['OrderID']; ?>" hidden>
                </div>
                <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" name="add_tracking" value="Submit" style="font-weight:bold;width:150px;border-color:indigo;background-color:indigo;">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
            </div>
        </form>
    </div>
</div>
    
    
    </main>

<?php require 'layouts/Footer.php';?>