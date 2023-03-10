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
            <form action="AddSlide.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label>Image</label>
                        <input type="file" class="form-control form-control my-3" name="slide_img" required>
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
                        <input class="btn btn-success mt-3" id="add-btn" name="add_slide" value="Submit">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>
    </div>
 
 <div id="addModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to add this?</p>
                <div class="modal-footer">
                    <button onClick="addSlide()">OK</button>
                    <button onClick="closeModal()">Cancel</button>
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