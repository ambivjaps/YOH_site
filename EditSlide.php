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

?>

<?php 
    if(isset($_POST['submit'])) {
        $SID = $slide['slide_id'];
    
        $slide_title = mysqli_real_escape_string($con, $_POST['slide_title']);
        $slide_img = mysqli_real_escape_string($con, $_POST['slide_img']);
        $slide_desc = mysqli_real_escape_string($con, $_POST['slide_desc']);
        $slide_link = mysqli_real_escape_string($con, $_POST['slide_link']);
    
        $query = "UPDATE slides SET slide_title='$slide_title',slide_img='$slide_img',slide_desc='$slide_desc',slide_link='$slide_link' WHERE slide_id=$SID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['slide_title'] = $_POST['slide_title'];
            $_SESSION['slide_img'] = $_POST['slide_img'];
            $_SESSION['slide_desc'] = $_POST['slide_desc'];
            $_SESSION['slide_link'] = $_POST['slide_link'];

            mysqli_close($con);
            header("Location: SlidesAdmin.php");
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Edit Slide | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <?php if($slide): ?>

    <div class="container my-5">

        <h1> Edit Slide </h1>
        <div class="form-group">
            <form action="EditSlide.php?id=<?php echo $slide['slide_id'] ?>" method="POST">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Image</label>
                        <input type="text" name="slide_img" id="slide_img" class="form-control" value="<?php echo $slide['slide_img'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="slide_title" id="slide_title" class="form-control" value="<?php echo $slide['slide_title'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <input type="text" name="slide_desc" id="slide_desc" class="form-control" value="<?php echo $slide['slide_desc'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Link</label>
                        <input type="text" name="slide_link" id="slide_link" class="form-control" value="<?php echo $slide['slide_link'] ?>">
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php else: ?>
        <div class="container my-5">
            <h2> Oops.. Page not found. Please try again. </h2>
        </div>
    <?php endif ?>
    
<?php require 'layouts/Footer.php';?>