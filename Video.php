<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$item = "SELECT * FROM videos WHERE vid_id = $id";
		$result = mysqli_query($con, $item);
		$video = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}

    if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);

		$sql = "DELETE FROM videos WHERE vid_id = $delete_id";

		if(mysqli_query($con, $sql)) {
			header('Location: VideosAdmin.php');
		} else {
			echo 'Error: ' . mysqli_error($con);
		}
	}

?>

<title> Video Details | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
<main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container my-5">

                <form class="mb-3" action="Video.php" method="POST">
			        <a class="btn btn-dark" href="EditVideo.php?id=<?php echo $video['vid_id'] ?>" type="submit" name="edit" role="button"><i class="fas fa-edit"></i> Edit</a>
			        <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $video['vid_id']; ?>">
			        <input class="btn btn-danger" type="submit" name="delete" role="button" value="Delete">
		        </form><hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="youtube-player rounded-1" data-id="<?php echo $video['vid_url'] ?>"></div>
                    </div>

                    <div class="col-md-6">
                        <h3><strong> Video Details: </strong></h3>
                        <p> Title: <?php echo $video['vid_title']; ?> </p>
                        <p> Description: <?php echo $video['vid_desc']; ?> </p>
                        <p> Category: <?php echo $video['vid_cat']; ?> </p>
                        <p> URL: <?php echo $video['vid_url']; ?> </p>
                        <p> Last Updated: <?php echo $video['created_at']; ?> </p>
                    </div>
                </div>

            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>