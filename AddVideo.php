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
            ?>
                <script>
                    window.location.replace("VideosAdmin.php");
                </script>
            <?php
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

        <h1 style="font-weight:bold;"> Add Video <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="VideosAdmin.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
        <div class="form-group">
            <form action="AddVideo.php" method="POST">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Title</label>
                        <input type="text" name="vid_title" id="vid_title" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Description</label>
                        <textarea type="text" rows="4" class="form-control rounded" name="vid_desc" id="vid_desc" style="resize:none;" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Category</label>
                        <select class="form-select rounded" id="vid_cat" name="vid_cat" aria-label=".form-select example" required>
                            <option value="Crochet Tutorial">Crochet Tutorial</option>
                            <option value="Crochet with Me">Crochet with Me</option>
                            <option value="Craft Vlog">Craft Vlog</option>
                            <option value="Studio Vlog">Studio Vlog</option>
                            <option value="Crochet Basics">Crochet Basics</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">URL</label>
                        <input type="text" name="vid_url" id="vid_url" class="form-control rounded" required>
                    </div>
                  
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>
    </div>
  
<?php require 'layouts/Footer.php';?>