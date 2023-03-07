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
        $slide_desc = mysqli_real_escape_string($con, $_POST['slide_desc']);
        $slide_link = mysqli_real_escape_string($con, $_POST['slide_link']);

        $image = $_FILES['slide_img']['name'];
        $saveImage = 'assets/img/slide/' .$_FILES['slide_img']['name'];

        $temp_name = $_FILES['slide_img']['tmp_name'];  
            if(isset($image) and !empty($image)){
            $location = './assets/img/slide/';      
                if(move_uploaded_file($temp_name, $location.$image)){
                    echo '';
                }
            } else {
                $image = 'No image uploaded.';
            }
        
        $query = "INSERT INTO slides (slide_title, slide_img, slide_desc, slide_link) VALUES ('$slide_title','$saveImage','$slide_desc','$slide_link')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['slide_title'] = $_POST['slide_title'];
            $_SESSION['slide_desc'] = $_POST['slide_desc'];
            $_SESSION['slide_link'] = $_POST['slide_link'];
            header("Location: SlidesAdmin.php");
            mysqli_close($con);
            
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
            <form action="AddSlide.php" method="POST" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Image</label>
                        <input type="file" class="form-control form-control my-3" name="slide_img">
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