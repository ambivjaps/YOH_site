<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    require 'layouts/Header.php';
?>

<title> Home | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

        <?php 
            if (isset($_SESSION['login_id']) && $_SESSION['user_rank'] == 'user') {
                include_once("views/customer_home.php");
            } else if (isset($_SESSION['login_id']) && $_SESSION['user_rank'] == 'admin') {
                include_once("views/admin_dashboard.php");
            } else {
                include_once("views/customer_home.php");
            }
        ?>

<?php require 'layouts/Footer.php';?>

<script>
      $('.owl-carousel').owlCarousel({
        stagePadding:0,
        loop:false,
        margin:10,
        dots:true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
          }
      })
</script>