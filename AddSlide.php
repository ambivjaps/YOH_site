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
    if(isset($_POST['add_slide'])) {
        $slide_title = mysqli_real_escape_string($con, $_POST['slide_title']);
        $slide_desc = mysqli_real_escape_string($con, $_POST['slide_desc']);
        $slide_link = mysqli_real_escape_string($con, $_POST['slide_link']);

        $image = $_FILES['slide_img']['name'];
        $temp_name = $_FILES['slide_img']['tmp_name'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        $temp_name = $_FILES['slide_img']['tmp_name'];  
            if(isset($image) and !empty($image)){
            $location = './assets/img/upload/slides/';      
            $saveImage = 'assets/img/upload/slides/'.$unique.$_FILES['slide_img']['name'];

                if(move_uploaded_file($temp_name, $location.$unique.$image)){
                    echo '';
                }
            } else {
                $saveImage = 'No image uploaded.';
            }
        
        $query = "INSERT INTO slides (slide_title, slide_img, slide_desc, slide_link) VALUES ('$slide_title','$saveImage','$slide_desc','$slide_link')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            ?>
                <script>
                    window.location.replace("SlidesAdmin.php");
                </script>
            <?php
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

        <h1 style="font-weight:bold;"> Add Slide <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="SlidesAdmin.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1>
        <hr>
        <div class="form-group">
            <form action="AddSlide.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Image</label>
                        <input type="file" class="form-control rounded" name="slide_img" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Title</label>
                        <input type="text" class="form-control rounded" name="slide_title" id="slide_title" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Description</label>
                        <input type="text" class="form-control rounded"name="slide_desc" id="slide_desc" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Link</label>
                        <input type="text" class="form-control rounded"name="slide_link" id="slide_link"  required>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="add-btn" name="add_slide" value="Submit"  style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>
    </div>
 
 <div id="addModal" class="modal" style="display: none">
            <div class="modal-content" style="width:300px;">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to add this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="addSlide()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">OK</button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;color:white;">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-btn').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('addModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function addSlide() {
            document.getElementById("form").submit();
        }
    </script>
  
<?php require 'layouts/Footer.php';?>