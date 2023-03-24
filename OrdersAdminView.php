<?php
session_start();

include("includes/dbh.inc.php");
include("includes/functions.inc.php");
include("includes/access.inc.php");
include("includes/Order.php");
access('ADMIN');
$user_data = check_login($con);




require 'layouts/Header.php';
?>
<script src="./assets/js/searchAndSortOrders.js" defer></script>
<title> Order List | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

    <?php require 'layouts/nav.php'; ?>

    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Orders</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <form method="POST" action="javascript:void(0);" id="search_form">
                                    <div class="filters">
                                        <div class="float-start float-md-end mt-5 mt-md-0 search-area" style="margin-left: 14px;margin-right: -4px;">
                                            <div class="float-start float-md-end mt-5 mt-md-0 search-area"></div>
                                        </div>
                                        
                                        <div class="filter-item">
                                            <h3 style="font-size: 32px; font-weight:bold;">Filters</h3>
                                            <div class="d-flex mt-4 mb-5">
                                            <input type="text" id="searchOrder" class="form-control rounded">
                                            <button type="submit" class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: indigo;background: indigo;">
                                                <i class="fas fa-search" style="text-align: center;"></i>
                                            </button>
                                            <a class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: indigo;background: indigo;" href="AddOrder.php"><i class="fas fa-plus" style="text-align: center;"></i></a>
                                        </div>
                                            <hr>
                                            <h3 style="font-size: 20px; font-weight:bold;">Categories</h3>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1" style="font-weight:bold;">All Orders</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2" style="font-weight:bold;">On-Going</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3" style="font-weight:bold;">Completed Orders</label></div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="products">

                                <div class="row g-0" id="searchAndSortOutput">
                                    <!-- DOM CONTENTS ARE LOADED HERE -->
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-0" id="results"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php require 'layouts/Footer.php'; ?>