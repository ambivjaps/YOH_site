<?php
session_start();

include("includes/dbh.inc.php");
include("includes/functions.inc.php");
include("includes/access.inc.php");
access('ADMIN');
$user_data = check_login($con);

require 'layouts/Header.php';


?>

<script src="./assets/js/searchProfile.js" defer></script>
<title> Customer Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

    <?php require 'layouts/nav.php'; ?>

    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark" style="background-color:#efe9ef;">
            <div class="container">
                <div class="block-heading">
                    <h2 style="margin:40px; color: black;font-size: 50px;font-weight: bold;">Customer Profiles</h2>
                </div>
                <div class="d-flex justify-content-center mt-10 mb-5">
                <input class="form-control rounded" type="text" name="searchInput" id="searchCustomerProfile" placeholder="Search Profile Here" style="width:500px;">
                
                <button type="submit" id="searchInventory" class="btn btn-primary" role="button" style="text-align: center;width: 40px;margin-left: 7px;border-color:indigo;background:indigo;">
                    <i class="fas fa-search" style="text-align: center;" ></i>
                </button>
                </div>
                <div class="block-content" id="searchOutput">
                    
                    <!-- DOM CONTENT in JS -->
                </div>
            </div>
        </section>
    </main>

    <?php require 'layouts/Footer.php'; ?>