<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    require 'layouts/Header.php';
?>

<title> FAQ | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    <div class="container my-5">
        <p> This is your user profile! </p>
    </div>

<?php require 'layouts/Footer.php';?>