<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);
    
    require 'layouts/Header.php';
    
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $item = "SELECT * FROM orders_db WHERE OrderID = $id";
        $result = mysqli_query($con, $item);
        $orders = mysqli_fetch_assoc($result);
        
        mysqli_free_result($result);
    }
    if(isset($_POST['submit'])){
        $pay_status = $_POST['pay_status'];
         $sql = "UPDATE `orders_db` SET `pay_status`='$pay_status' WHERE OrderID=$id ";
             $run = mysqli_query($con, $sql);
        
            if($run) {
            $_SESSION['pay_status'] = $_POST['pay_status'];
              
                echo'
            <script>
            window.location.replace("OrderPageAdmin.php?id='.$_GET['id'].'");
            </script>';
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
        <section class="clean-block payment-form dark" style="height: 663.328px;background-color: #efe9ef;">
            <div class="container" style="margin-bottom: 35px;margin-top: 20px;">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black; font-weight:bold;">Add Payment<span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: #AC99CF;background: #AC99CF;width:40px;"><a href="" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h2>
                </div>
                <form action="AddPaymentAdmin.php?id=<?php echo $orders['OrderID']?>" method="POST">
                    <div class="products" style="margin-bottom: 15px;margin-top: 2px;">
                        <div></div>
                        <div class="item"><span class="price"></span>
                            <div></div>
                            <p class="item-name">Amount <input placeholder="<?php echo $orders['ItemPrice']?>" name="ItemPrice" class="form-control form-control" type="text" style="width: 240px;height: 30px;margin-left: 89px;margin-bottom: 16px;margin-top: -30px;" readonly></p>
                            <p class="item-name" style="margin-bottom: 13.2px;" input="read-only">Mode of Payment</p>
                            <p>Status of Payment <strong></strong>
                        <select class="form-select" id="pay_status" name="pay_status" value="<?php echo $orders['pay_status']?>"aria-label=".form-select example">
                            <option value="Downpayment">Downpayment</option>
                            <option value="Full Payment">Full Payment</option>
                        </select></p>
                            <p class="item-name" style="margin-bottom: 14.2px;margin-top: 14px;" input="read-only">Proof of Payment</p>
                        </div>
                    <div class="button-group float-end">
                    <div class="item"></div>
                    <div class="total">
                    <div class="item"></div>
                        <div class="total">
                            <button class="btn btn-primary" name="submit" type="submit" id="submit" style="margin-left: 344px;width: 80.4844px;" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;">Save</button>
                        <a href="OrderPageAdmin.php?id=<?php echo $orders['OrderID']?>"><button class="btn btn-primary" type="button" style="margin-left: 14px;font-weight:bold;">Cancel</button></a></div>
            </div>
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>