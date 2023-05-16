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
			?>
                <script>
                    window.location.replace("VideosAdmin.php");
                </script>
            <?php
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

                <form class="mb-3" method="POST" id="form">
                <button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;"><a href="VideosAdmin.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> Back </a></button>
			        <a class="btn btn-dark" href="EditVideo.php?id=<?php echo $video['vid_id'] ?>" type="submit" name="edit" role="button" style="border-color:indigo;background:indigo; color:white; font-weight:bold;"><i class="fas fa-edit"></i> Edit</a>
			        <input type="hidden" class="delete_id" name="delete_id" value="<?php echo $video['vid_id']; ?>" style="width:100px;" readonly >
			        <input class="btn btn-danger" name="delete" role="button" value="Delete" style="width: 8%; font-weight:bold;" readonly>
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

        <div id="deleteModal" class="modal" style="display: none">
            <div class="modal-content" style="width:300px;">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to delete this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="deleteVideoForm()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;width:100px;color:white;">Cancel</button>
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

        function deleteVideoForm() {
            document.getElementById("form").submit();
        }
    </script>

<?php require 'layouts/Footer.php';?>