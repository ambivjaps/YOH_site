<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<title> FAQ's | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <main class="page catalog-page"> 
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container-xxl mt-5">
                <div class="block-heading">
                    <h2 style="font-size: 43px;text-align: center;">Frequently Asked Questions</h2>
                </div>
                <div class="content">
                    <div class="row my-5">
                        <div class="col-md-3">
                            <div class="position-sticky" style="top: 7rem;">
                                <nav class="faq-nav my-3">
                                    <ul class="nav nav-pills flex-md-column">
                                        <li class="nav-item" role="presentation"> <button class="nav-link active" id="faq-product-tab" data-bs-toggle="pill" data-bs-target="#faq-product" type="button" role="tab" aria-controls="faq-product" aria-selected="true">About our Products</button> </li>
                                        <li class="nav-item" role="presentation"> <button class="nav-link" id="faq-order-tab" data-bs-toggle="pill" data-bs-target="#faq-order" type="button" role="tab" aria-controls="faq-order" aria-selected="false">Order Process</button> </li>
                                        <li class="nav-item" role="presentation"> <button class="nav-link" id="faq-payment-tab" data-bs-toggle="pill" data-bs-target="#faq-payment" type="button" role="tab" aria-controls="faq-payment" aria-selected="false">Mode of Payment</button> </li>
                                        <li class="nav-item" role="presentation"> <button class="nav-link" id="faq-refund-tab" data-bs-toggle="pill" data-bs-target="#faq-refund" type="button" role="tab" aria-controls="faq-refund" aria-selected="false">Refunds</button> </li>
                                        <li class="nav-item" role="presentation"> <button class="nav-link" id="faq-misc-tab" data-bs-toggle="pill" data-bs-target="#faq-misc" type="button" role="tab" aria-controls="faq-misc" aria-selected="false">Miscellaneous</button> </li>
                                    </ul>
                                </nav><hr class="d-md-none">
                            </div>
                        </div>
                        <div class="col-md-9 p-5">
                            <div class="tab-content" id="faq-tabContent">
                                <div class="tab-pane fade show active" id="faq-product" role="tabpanel" aria-labelledby="faq-product-tab">
                                    <strong> 1. What is the height of the dolls? </strong>
                                    <ul> 
                                        <li> Height of chibi dolls is 4.5” x 3”. </li>
                                        <li> Dolls include stand when requested. </li>
                                    </ul>

                                    <strong> 2. How do you wash the products? </strong>
                                    <ul>
                                        <li> For clothing, wash the piece with cold water and detergent. Lightly scrub areas with dirt and gently soak the garment with the cold water solution. Gently squeeze out the water when you feel like it’s clean, lay flat or surface and reshape when needed. </li>
                                        <li> Do not put in direct sunlight as it might shrink. </li>
                                        <li> For dolls and keychains, take a lint roller and gently roll it down on the body of the doll to collect dirt. No need to wash with water. </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="faq-order" role="tabpanel" aria-labelledby="faq-order-tab">
                                    <strong> Steps to follow when ordering: </strong>
                                    <ol>
                                        <li> Fill up the order form through the link in our bio. </li>
                                        <li> Don't forget to read the terms and conditions. </li>
                                        <li> Double check your entry. Make sure the information you provided is valid. </li>
                                        <li> Wait for our reply regarding your order. </li>
                                        <li> Please message us with the word <strong> “PING” </strong> to discuss about the details. </li>
                                    </ol>
                                </div>
                                <div class="tab-pane fade" id="faq-payment" role="tabpanel" aria-labelledby="faq-payment-tab">
                                    <strong> Payment is accepted through the following: </strong>
                                    <ul>
                                        <li> BDO </li>
                                        <li> PAYMAYA </li>
                                        <li> GCASH </li>
                                        <li> PAYPAL </li>
                                    </ul>
                                    <p> Please ensure that both sender and receiver information are correct before proceeding to payment. </p>
                                
                                </div>
                                <div class="tab-pane fade" id="faq-refund" role="tabpanel" aria-labelledby="faq-refund-tab">
                                    <strong> Rules regarding refund: </strong>
                                    <ol>
                                        <li> Strictly no refunds once the products is in the making process. </li>
                                        <li> SPECIFIC DETAILS shall be discussed with the customer after submitting the form. </li>
                                        <li> The shop is not responsible for any damage/loss made by the courier. </li>
                                        <li> The shop is not liable for any delays in shipping due to natural disasters or the like. </li>
                                        <li> All customer rights are revoked if product isn’t paid in full after 1 month of the product being finished without notices from the customers. </li>
                                    </ol>
                                </div>
                                <div class="tab-pane fade" id="faq-misc" role="tabpanel" aria-labelledby="faq-misc-tab">
                                    <strong> 1. Are the products of excellent quality? </strong>
                                    <p> Yes, all of our products are 100% handmade with love and are sturdy. </p>
                                    
                                    <strong> 2. Does Yarn Over Hook accept commission work? </strong>
                                    <p> Yes, we accept commissions. 50% downpayment first for commissions, and full payment before we ship out your product. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </section>
    </main>

<?php require 'layouts/Footer.php';?>