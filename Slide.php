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
        $filePath = $_POST['delete_img'];

        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
        }

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
                <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;"><a href="SlidesAdmin.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
			        <a class="btn btn-dark" href="EditSlide.php?id=<?php echo $slide['slide_id'] ?>" type="submit" name="edit" role="button" style="border-color:indigo;background-color:indigo;font-weight:bold;" ><i class="fas fa-edit" ></i> Edit</a>
			        <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $slide['slide_id']; ?>">
                    <input type="hidden" name="delete_img" value="<?php echo $slide['slide_img']; ?>">
			        <input class="btn btn-danger" type="submit" name="delete" role="button" value="Delete" style="font-weight:bold;" >
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
<div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this?</p>
                <div class="modal-footer">
                    <button onClick="deleteSlideForm()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementsByName('delete')[0].addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('deleteModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        function deleteSlideForm() {
            document.getElementById("form").submit();
        }
    </script>
<?php require 'layouts/Footer.php';?>