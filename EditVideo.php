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

?>

<?php 
    if(isset($_POST['edit_video'])) {
        $VID = $video['vid_id'];
    
        $vid_title = mysqli_real_escape_string($con, $_POST['vid_title']);
        $vid_desc = mysqli_real_escape_string($con, $_POST['vid_desc']);
        $vid_cat = $_POST['vid_cat'];
        $vid_url = mysqli_real_escape_string($con, $_POST['vid_url']);
    
        $query = "UPDATE videos SET vid_title='$vid_title',vid_desc='$vid_desc',vid_cat='$vid_cat',vid_url='$vid_url' WHERE vid_id=$VID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['vid_title'] = $_POST['vid_title'];
            $_SESSION['vid_desc'] = $_POST['vid_desc'];
            $_SESSION['vid_cat'] = $_POST['vid_cat'];
            $_SESSION['vid_url'] = $_POST['vid_url'];

            mysqli_close($con);
            header("Location: VideosAdmin.php");
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Edit Video | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>


    <?php if($video): ?>

    <div class="container my-5">

        <h1> Edit Video </h1>
        <div class="form-group">
            <form action="EditVideo.php?id=<?php echo $video['vid_id'] ?>" method="POST" id="form">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="vid_title" id="vid_title" class="form-control" value="<?php echo $video['vid_title'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea type="text" rows="4" class="form-control" name="vid_desc" id="vid_desc"><?php echo $video['vid_desc'] ?></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Category</label>
                        <select class="form-select" id="vid_cat" name="vid_cat" aria-label=".form-select example">
                            <option value="Crochet Tutorial" <?php if($video['vid_cat'] == 'Crochet Tutorial') { ?>selected="selected"<?php } ?>>Crochet Tutorial</option>
                            <option value="Crochet with Me" <?php if($video['vid_cat'] == 'Crochet with Me') { ?>selected="selected"<?php } ?>>Crochet with Me</option>
                            <option value="Craft Vlog" <?php if($video['vid_cat'] == 'Craft Vlog') { ?>selected="selected"<?php } ?>>Craft Vlog</option>
                            <option value="Studio Vlog" <?php if($video['vid_cat'] == 'Studio Vlog') { ?>selected="selected"<?php } ?>>Studio Vlog</option>
                            <option value="Crochet Basics" <?php if($video['vid_cat'] == 'Crochet Basics') { ?>selected="selected"<?php } ?>>Crochet Basics</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>URL</label>
                        <input type="text" name="vid_url" id="vid_url" class="form-control" value="<?php echo $video['vid_url'] ?>">
                    </div>
                  
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editVideo" name="edit_video" value="Submit" style="width:8%">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button onClick="editVideo()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>

    <script>
        document.getElementById('editVideo').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editVideo() {
            document.getElementById("form").submit();
        }
    </script>
    
<?php require 'layouts/Footer.php';?>