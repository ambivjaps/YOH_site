<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<title> Re-Ordering | Yarn Over Hook </title>
    
<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <main class="page payment-page">
        <section class="clean-block payment-form dark" style="min-height: 17px;height: 971px; background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Re - Ordering</h2>
                </div>
                <form>
                    <div class="products">
                        <h3 class="title">Item 1<span class="price">$120</span></h3>
                        <p class="item-description">Item Description</p>
                        <div class="item"></div>
                        <div class="item"><span class="price">$120</span>
                            <p class="item-name">Item 2</p>
                            <p class="item-description">Item Description</p>
                        </div>
                        <div class="total"><span>Re - Order Cost</span><span class="price">$320</span></div>
                        <a href="Inventory.php"><button class="btn btn-primary d-block w-100" type="submit" style="margin-top: 19px;">Proceed</button></a>
                        <a href="Inventory.php"><button class="btn btn-primary d-block w-100" type="button" style="margin-top: 19px;">Cancel</button></a>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>