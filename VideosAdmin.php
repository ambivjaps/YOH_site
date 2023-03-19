<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';

	$vid = "SELECT * FROM videos ORDER BY vid_id DESC";
    $count = "SELECT COUNT(*) FROM videos";

	$result = mysqli_query($con, $vid);
    $result_count = mysqli_query($con, $count);

	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $r_count = mysqli_fetch_array($result_count)[0];
	mysqli_free_result($result);
?>

<title> Videos | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container my-5">

                <a class="btn btn-success" href="AddVideo.php" role="button"> Add video </a><hr>

                <h1> Videos </h1>
                
                <table class="table table-striped table-hover table-sm mt-5">
                    <tr>
                        <th> # </th>
                        <th> Title </th>
                        <th> Category </th>
                        <th> Last Updated </th>
                        <th> Action </th>
                    </tr>

                    <?php foreach($videos as $video): ?>
                        <tr><td> <?php echo $video['vid_id']; ?> </td>
                        <td> <?php echo $video['vid_title']; ?> </td>
                        <td> <?php echo $video['vid_cat']; ?> </td>
                        <td> <?php echo $video['created_at']; ?> </td>
                        <td> <a class="btn btn-sm btn-dark" href="Video.php?id=<?php echo $video['vid_id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>
                    <?php endforeach; ?>
                </table>
                <p> Showing <strong> <?php echo $r_count ?> </strong> records found. </p>

                <nav style="margin-bottom: 15px;margin-top: 10px;">
                    <ul class="pagination pagination-sm justify-content-end flex-wrap">
                        <li class="page-item"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                        <li class="page-item previous">
                            <a class="page-link" href="#">Prev</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                        <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </main>
        
<?php require 'layouts/Footer.php';?>