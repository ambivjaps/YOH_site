<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    
    access('ADMIN');
    $user_data = check_login($con);

    require 'layouts/Header.php';
?>

<?php 
    if(isset($_POST['submit'])) {
        $slide_title = mysqli_real_escape_string($con, $_POST['slide_title']);
        $slide_img = mysqli_real_escape_string($con, $_POST['slide_img']);
        $slide_desc = mysqli_real_escape_string($con, $_POST['slide_desc']);
        $slide_link = mysqli_real_escape_string($con, $_POST['slide_link']);
        
        $query = "INSERT INTO slides (slide_title, slide_img, slide_desc, slide_link) VALUES ('$slide_title','$slide_img','$slide_desc','$slide_link')";
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

<title> Add Slide | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">

        <h1> Add Slide </h1>
        <div class="form-group">
            <form action="AddSlide.php" method="POST">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Image</label>
                        <input type="text" name="slide_img" id="slide_img" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="slide_title" id="slide_title" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <input type="text" name="slide_desc" id="slide_desc" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Link</label>
                        <input type="text" name="slide_link" id="slide_link" class="form-control" required>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>
  
<?php require 'layouts/Footer.php';?>