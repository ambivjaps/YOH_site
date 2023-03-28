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
    if(isset($_POST['edit_slide'])) {
        $SID = $slide['slide_id'];
    
        $slide_title = mysqli_real_escape_string($con, $_POST['slide_title']);
        $slide_desc = mysqli_real_escape_string($con, $_POST['slide_desc']);
        $slide_link = mysqli_real_escape_string($con, $_POST['slide_link']);

        $new_image = $_FILES['slide_img']['name'];
        $old_image = $_POST['slide_img_old'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        if($new_image != '') {
            $update_filename = 'assets/img/upload/slides/' . $unique . $_FILES['slide_img']['name'];
        } else {
            $update_filename = $old_image;
        }

        if(file_exists("assets/img/upload/slides/" . $_FILES['slide_img']['name'])) {
        } else {
            $query = "UPDATE slides SET slide_img='$update_filename' WHERE slide_id='$SID' ";
            $query_run = mysqli_query($con, $query);

            if($query_run) {
                if($_FILES['slide_img']['name'] != '') {
                    move_uploaded_file($_FILES['slide_img']['tmp_name'], "assets/img/upload/slides/" . $unique . $_FILES['slide_img']['name']);
                    unlink($old_image);
                }
            } else {
                echo "<script> alert('Problem occured.') </script>";
            }
        }

        $query = "UPDATE slides SET slide_title='$slide_title',slide_desc='$slide_desc',slide_link='$slide_link' WHERE slide_id=$SID";
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

<title> Edit Slide | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <?php if($slide): ?>

    <div class="container my-5">

        <h1 style="font-weight:bold;"> Edit Slide <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="Slide.php?id=<?php echo $slide['slide_id'] ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
        <div class="form-group">
            <form action="EditSlide.php?id=<?php echo $slide['slide_id'] ?>" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-5">
                        <img class="img-fluid rounded" src="<?php echo $slide['slide_img']; ?>" id="imgDisplay">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Image</label>
                        <input type="file" onchange="readURL(this)" class="form-control rounded my-3" name="slide_img">
                        <input type="hidden" onchange="readURL(this)" class="form-control rounded my-3" name="slide_img_old" value="<?php echo $slide['slide_img']; ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Title</label>
                        <input type="text" name="slide_title" id="slide_title" class="form-control rounded" value="<?php echo $slide['slide_title'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Description</label>
                        <input type="text" name="slide_desc" id="slide_desc" class="form-control rounded" value="<?php echo $slide['slide_desc'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Link</label>
                        <input type="text" name="slide_link" id="slide_link" class="form-control rounded" value="<?php echo $slide['slide_link'] ?>">
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editSlide" name="edit_slide" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;font-weight:bold;">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>
    
        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="editSlide()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
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
        document.getElementById('editSlide').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editSlide() {
            document.getElementById("form").submit();
        }

        function readURL(el) {
            if (el.files && el.files[0]) {
                var FR= new FileReader();
                FR.onload = function(e) {
                    $("#imgDisplay").attr("src", e.target.result);
                    socket.emit('image', e.target.result);
                    console.log(e.target.result);
                };       
                FR.readAsDataURL( el.files[0] );
            } 
        };
    </script>
    
<?php require 'layouts/Footer.php';?>