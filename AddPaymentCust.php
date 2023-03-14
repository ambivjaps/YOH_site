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
        $pay_status = $_POST['pay_status'];

        $new_image = $_FILES['proof_img']['name'];
        $old_image = $_POST['proof_img_old'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        if($new_image != '') {
            $update_filename = 'assets/img/upload/payment/' . $unique . $_FILES['proof_img']['name'];
        } else {
            $update_filename = $old_image;
        }

        if(file_exists("assets/img/upload/payment/" . $_FILES['proof_img']['name'])) {
        } else {
            $query = "UPDATE orders_db SET proof_img='$update_filename' WHERE OrderID=$OID";
            $query_run = mysqli_query($con, $query);

            if($query_run) {
                if($_FILES['proof_img']['name'] != '') {
                    move_uploaded_file($_FILES['proof_img']['tmp_name'], "assets/img/upload/payment/" . $unique . $_FILES['proof_img']['name']);
                    unlink($old_image);
                }
            } else {
                echo "<script> alert('Problem occured.') </script>";
            }
        }
        
        $query = "UPDATE orders_db SET p_mode='$p_mode', pay_status='$pay_status' WHERE OrderID=$OID";
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
                              <option value="Paymaya" <?php if($order['p_mode'] == 'Paymaya') { ?> selected="selected"<?php } ?>>Paymaya</option>
                              <option value="BDO" <?php if($order['p_mode'] == 'BDO') { ?> selected="selected"<?php } ?>>BDO</option>
                              <option value="GCash" <?php if($order['p_mode'] == 'GCash') { ?> selected="selected"<?php } ?>>GCash</option>
                              <option value="Paypal" <?php if($order['p_mode'] == 'Paypal') { ?> selected="selected"<?php } ?>>Paypal</option>
                            </select>

                            <p class="item-name mt-2" style="margin-bottom: 13.2px;" input="read-only">Status of Payment </p>
                            <select class="form-select" id="pay_status" name="pay_status" aria-label=".form-select example" required>
                              <option value="Installment" <?php if($order['pay_status'] == 'Installment') { ?> selected="selected"<?php } ?>>Installment</option>
                              <option value="Full Payment" <?php if($order['pay_status'] == 'Full Payment') { ?> selected="selected"<?php } ?>>Full Payment</option>
                            </select> 
                            
                            <p class="item-name" style="margin-bottom: 14.2px;margin-top: 14px;">Proof of Payment</p>
                            <input type="file" class="form-control form-control my-3" name="proof_img" required>
                            <input type="hidden" name="proof_img_old" value="<?php echo $order['proof_img']; ?>">
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