<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    require 'layouts/Header.php';
    
    /* This is a comment! * /

    /* slide carousel */
    $carousel = "SELECT * FROM slides ORDER BY slide_id LIMIT 5";
    $result = mysqli_query($con, $carousel);
    $slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    /* featured video */
	$feat_vid = "SELECT * FROM videos ORDER BY vid_id DESC LIMIT 3";
	$result = mysqli_query($con, $feat_vid);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
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