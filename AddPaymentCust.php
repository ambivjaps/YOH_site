<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';
    
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
    if(isset($_POST['add_payment'])) {
        $OID = $order['OrderID'];

        $p_mode = $_POST['p_mode'];

        $image = $_FILES['proof_img']['name'];
        $temp_name = $_FILES['proof_img']['tmp_name'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        $temp_name = $_FILES['proof_img']['tmp_name'];  
            if(isset($image) and !empty($image)){
            $location = './assets/img/upload/payment/';      
            $saveImage = 'assets/img/upload/payment/'.$unique.$_FILES['proof_img']['name'];

                if(move_uploaded_file($temp_name, $location.$unique.$image)){
                    echo '';
                }
            } else {
                $saveImage = 'No image uploaded.';
            }
        
        $query = "UPDATE orders_db SET p_mode='$p_mode',proof_img='$saveImage' WHERE OrderID=$OID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['p_mode'] = $_POST['p_mode'];
            header("Location: OrderPageCust.php");
            mysqli_close($con);
            
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Add Payment | Yarn Over Hook </title>
 
<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page payment-page">
        <section class="clean-block payment-form dark" style="background-color: #efe9ef;">
            <div class="container" style="margin-bottom: 35px;margin-top: 20px;">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: center;margin-top:64px; color:black; font-weight:bold;">Add Payment</h2>
                </div>
                <form action="AddPaymentCust.php?id=<?php echo $order['OrderID']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="products" style="margin-bottom: 15px;margin-top: 2px;">
                        <div></div>
                        <div class="item"><span class="price"></span>
                            <div></div>
                            <p class="item-name">Total Amount Due: Php<?php echo $order['OrderTotal']; ?> </p>
                            <p>Send your payment thru.. (insert bank details) </p>
                            <p>Insert more ordering disclaimers here.. </p><hr>
                            <p class="item-name" style="margin-bottom: 13.2px;" input="read-only">Mode of Payment </p>
                            <select class="form-select" id="p_mode" name="p_mode" aria-label=".form-select example" required>
                              <option value="Paymaya">Paymaya</option>
                              <option value="BDO">BDO</option>
                              <option value="GCash">GCash</option>
                              <option value="FullPayment">Paypal</option>
                        		</select> 
                            <p class="item-name" style="margin-bottom: 14.2px;margin-top: 14px;">Proof of Payment</p>
                            <input type="file" class="form-control form-control my-3" name="proof_img" required>
                        </div>
                            <div class="button-group float-end">
                                <input class="btn btn-success" type="submit" name="add_payment" value="Submit">
                                <a href="OrderPageCust.php"><button class="btn btn-primary" type="button" style="margin-left: 14px;">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>