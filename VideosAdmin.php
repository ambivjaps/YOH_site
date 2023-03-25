<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if (isset($_GET['page'])) {
        $pageno = $_GET['page'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 15;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM videos";
    $result_page = mysqli_query($con, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result_page)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

	$vid = "SELECT * FROM videos ORDER BY vid_id DESC LIMIT $offset, $no_of_records_per_page";
	$result = mysqli_query($con, $vid);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
?>

<title> Videos | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container my-5">
            <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;"><a href="HomePage.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
            <button class="btn btn-outline-primary text-truncate float-none float-sm-none add-another-btn" type="button" style="border-color:indigo;background:indigo; color:white; font-weight:bold;"><a  href="AddVideo.php" style="color:white; text-decoration:none;"> Add video <i class="fas fa-plus-circle edit-icon"></i></a></button><hr>

                <h1 style="font-weight:bold;"> Videos </h1>
                
                <table class="table table-striped table-hover table-sm mt-5">
                    <tr>
                        <th> # </th>
                        <th> Title </th>
                        <th> Category </th>
                        <th> URL </th>
                        <th> Action </th>
                    </tr>

                    <?php foreach($videos as $video): ?>
                        <tr><td> <?php echo $video['vid_id']; ?> </td>
                        <td> <?php echo $video['vid_title']; ?> </td>
                        <td> <?php echo $video['vid_cat']; ?> </td>
                        <td> <?php echo $video['vid_url']; ?> </td>
                        <td> <a class="btn btn-sm btn-primary" href="Video.php?id=<?php echo $video['vid_id'] ?>" role="button" style="border-color:indigo;background:indigo;"><i class="fas fa-eye"></i> View</a> </td></tr>
                    <?php endforeach; ?>
                </table>
                <p> Showing Page <?php echo $pageno ?> of <?php echo $total_pages ?> </p>

                <nav>
                    <ul class="pagination pagination-sm justify-content-end flex-wrap">
                        <li class="page-item">
                            <a class="page-link" aria-label="Previous" href="?page=1"><span aria-hidden="true">«</span></a>
                        </li>
                        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?page=".($pageno - 1); } ?>">Prev</a>
                        </li>
                        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?page=".($pageno + 1); } ?>">Next</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" aria-label="Next" href="?page=<?php echo $total_pages; ?>"><span aria-hidden="true">»</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </main>
        
<?php require 'layouts/Footer.php';?>