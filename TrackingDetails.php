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
        
   <div class="container my-5">

        <h1 style="font-weight:bold;"> Tracking Details <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: #AC99CF;background: #AC99CF;width:40px;"><a href="OrderPageAdmin.php?id=<?php echo $order['OrderID']; ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1>
        <hr>
        <div class="form-group">
            <form action="TrackingDetails.php?id=<?php echo $order['OrderID']; ?>" method="POST">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Courier</label>
                        <input type="text" name="courier_id" id="courier_id" class="form-control" value="<?php echo $order['courier_id']; ?>">
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
                        <div class="col-md-">
                            <h1></h1>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Courier<br><input class="form-control item" type="text" id="name-4" style="width: 171px;margin-bottom: 4px;" required=""></label></div>
                                <div class="col-sm-12 col-md-6 col-xxl-10"><label class="col-form-label" for="name" style="margin-left: 31px;">Tracking ID<br><input class="form-control item" type="text" id="name-3" style="width: 121px;margin-bottom: 4px;" required=""></label></div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit">SAVE </button><a class="btn btn-danger form-btn" role="button" href="OrderPageAdmin.php?id=<?php echo $orders['OrderID']?>">CANCEL </a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>