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
		$item = "SELECT * FROM slides WHERE slide_id = $id";
		$result = mysqli_query($con, $item);
		$slide = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}

    if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);

		$sql = "DELETE FROM slides WHERE slide_id = $delete_id";

		if(mysqli_query($con, $sql)) {
			header('Location: SlidesAdmin.php');
		} else {
			echo 'Error: ' . mysqli_error($con);
		}
	}

?>

<title> Slide Details | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
<main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container my-5">

                <form class="mb-3" action="Slide.php" method="POST">
			        <a class="btn btn-dark" href="EditSlide.php?id=<?php echo $slide['slide_id'] ?>" type="submit" name="edit" role="button"><i class="fas fa-edit"></i> Edit</a>
			        <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $slide['slide_id']; ?>">
			        <input class="btn btn-danger" type="submit" name="delete" role="button" value="Delete">
		        </form><hr>

                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid" src="<?php echo $slide['slide_img'] ?>">
                    </div>

                    <div class="col-md-6">
                        <h3><strong> Slide Details: </strong></h3>
                        <p> Title: <?php echo $slide['slide_title']; ?> </p>
                        <p> Description: <?php echo $slide['slide_desc']; ?> </p>
                        <p> Link: <?php echo $slide['slide_link']; ?> </p>
                        <p> Last Updated: <?php echo $slide['created_at']; ?> </p>
                    </div>
                </div>

            </div>
        </section>
    </main>

<?php require 'layouts/Footer.php';?>