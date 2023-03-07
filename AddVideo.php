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
        $vid_title = mysqli_real_escape_string($con, $_POST['vid_title']);
        $vid_desc = mysqli_real_escape_string($con, $_POST['vid_desc']);
        $vid_cat = $_POST['vid_cat'];
        $vid_url = mysqli_real_escape_string($con, $_POST['vid_url']);
        
        $query = "INSERT INTO videos (vid_title, vid_desc, vid_cat, vid_url) VALUES ('$vid_title','$vid_desc','$vid_cat','$vid_url')";
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

<title> Add Video | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">

        <h1> Add Video </h1>
        <div class="form-group">
            <form action="AddVideo.php" method="POST">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="vid_title" id="vid_title" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea type="text" rows="4" class="form-control" name="vid_desc" id="vid_desc" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Category</label>
                        <select class="form-select" id="vid_cat" name="vid_cat" aria-label=".form-select example" required>
                            <option value="Crochet Tutorial">Crochet Tutorial</option>
                            <option value="Crochet with Me">Crochet with Me</option>
                            <option value="Craft Vlog">Craft Vlog</option>
                            <option value="Studio Vlog">Studio Vlog</option>
                            <option value="Crochet Basics">Crochet Basics</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>URL</label>
                        <input type="text" name="vid_url" id="vid_url" class="form-control" required>
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