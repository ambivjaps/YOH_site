<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    require 'layouts/Header.php';

    /* videos */
	$vid = "SELECT * FROM videos ORDER BY vid_id DESC";
	$result = mysqli_query($con, $vid);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
?>

<title> Videos | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">
        <div class="row my-3">
            <?php foreach($videos as $video): ?>
            <div class="col-md-4 mb-3">
                <div class="youtube-player rounded-1" data-id="<?php echo $video['vid_url'] ?>"></div>
            </div>

            <div class="col-md-8">
                <h3 style="color:rgb(111,66,193); font-weight:bold;"> <?php echo $video['vid_title']; ?> </h3>
                <span class="badge" style="background-color:pink; border-color: pink; color:purple;"><?php echo $video['vid_cat']; ?></span><hr>
                <p><?php echo $video['vid_desc']; ?></p>
            </div>

            <?php endforeach; ?>
        </div>
    </div>
        
<?php require 'layouts/Footer.php';?>