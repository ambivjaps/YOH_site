<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    require 'layouts/Header.php';
    
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $item = "SELECT * FROM orders_db WHERE OrderID = $id";
        $result = mysqli_query($con, $item);
        $orders = mysqli_fetch_assoc($result);
        
        mysqli_free_result($result);
    }
?>

<title> Add Payment | Yarn Over Hook </title>
 
<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page payment-page">
        <section class="clean-block payment-form dark" style="height: 663.328px;background-color: #efe9ef;">
            <div class="container" style="margin-bottom: 35px;margin-top: 20px;">
                <div class="block-heading">
                    <h2 style="margin-bottom: 17.2px;font-size: 54px;text-align: left;margin-top:64px; color:black; font-weight:bold;">Add Payment</h2>
                </div>
                <form>
                    <div class="products" style="margin-bottom: 15px;margin-top: 2px;">
                        <div></div>
                        <div class="item"><span class="price"></span>
                            <div></div>
                            <p class="item-name" >Amount <input placeholder="<?php echo $orders['ItemPrice']; ?>" class="form-control form-control" type="text" style="width: 240px;height: 30px;margin-left: 89px;margin-bottom: 16px;margin-top: -30px;"></p>
                            <p class="item-name" style="margin-bottom: 13.2px;" input="read-only">Mode of Payment 
                            <select name="" id="sel" >
                              <option value="Paymaya">Paymaya</option>
                              <option value="BDO">BDO</option>
                              <option value="GCash">GCash</option>
                              <option value="FullPayment">Paypal</option>
                        		</select> </p>
                            <p class="item-name">Status of Payment </p>
                            <p class="item-name" style="margin-bottom: 14.2px;margin-top: 14px;">Proof of Payment</p>
                        </div>
                        <div class="item"></div>
                        <div class="total"><button class="btn btn-primary" type="button" style="margin-left: 344px;width: 80.4844px;">Save</button><a href="OrderPageCust.php?id=<?php echo $orders['OrderID']?>"><button class="btn btn-primary" type="button" style="margin-left: 14px;">Cancel</button></a></div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
<?php require 'layouts/Footer.php';?>