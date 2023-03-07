<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';

	$sl = "SELECT * FROM slides ORDER BY slide_id DESC";
    $count = "SELECT COUNT(*) FROM slides";

	$result = mysqli_query($con, $sl);
    $result_count = mysqli_query($con, $count);

	$slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $r_count = mysqli_fetch_array($result_count)[0];
	mysqli_free_result($result);
?>

<title> Slides | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container my-5">

                <a class="btn btn-success" href="AddSlide.php" role="button"> Add slide </a><hr>

                <h1> Slides </h1>
                
                <table class="table table-striped table-hover table-sm mt-5">
                    <tr>
                        <th> # </th>
                        <th> Image </th>
                        <th> Title </th>
                        <th> Last Updated </th>
                        <th> Action </th>
                    </tr>

                    <?php foreach($slides as $slide): ?>
                        <tr><td> <?php echo $slide['slide_id']; ?> </td>
                        <td> <img width="250px" src="<?php echo $slide['slide_img']; ?>"> </td>
                        <td> <?php echo $slide['slide_title']; ?> </td>
                        <td> <?php echo $slide['created_at']; ?> </td>
                        <td> <a class="btn btn-sm btn-dark" href="Slide.php?id=<?php echo $slide['slide_id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>
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