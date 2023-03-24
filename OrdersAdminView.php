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
                    <h2 style="margin:54px; color:black; font-size:54px;">Orders</h2>
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
                                            <h3 style="font-size: 32px;">Filters</h3>
                                            <input type="text" id="searchOrder">
                                            <button type="submit" class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color: rgb(119,13,253);background: rgb(119,13,253);">
                                                <i class="fas fa-search" style="text-align: center;"></i>
                                            </button>

                                            <h3>Categories</h3>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">All Orders</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2">In Process</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3">Completed Orders</label></div>
                                        </div>
                                    </div>


                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="products"><a class="btn btn-primary active" role="button" style="margin-left: 834px;margin-right: -7px;margin-bottom: -12px;margin-top: -16px;" href="AddOrder.php">Add</a>

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