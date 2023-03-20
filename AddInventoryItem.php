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
    if(isset($_POST['add_item'])) {
        $ItemID = mysqli_real_escape_string($con, $_POST['ItemID']);
        $ItemName = mysqli_real_escape_string($con, $_POST['ItemName']);
        $ItemDesc = mysqli_real_escape_string($con, $_POST['ItemDesc']);
        $ItemType = $_POST['ItemType'];
        $ItemPrice = mysqli_real_escape_string($con, $_POST['ItemPrice']);
        $ItemQty = mysqli_real_escape_string($con, $_POST['ItemQty']);

        $image = $_FILES['ItemImg']['name'];
        $temp_name = $_FILES['ItemImg']['tmp_name']; 
        $unique = strtotime("now").'_'.uniqid(rand()).'_';
        
        
            if(isset($image) and !empty($image)){    
                $location = './assets/img/upload/inventory/';  
                $saveImage = 'assets/img/upload/inventory/'.$unique.$_FILES['ItemImg']['name'];

                if(move_uploaded_file($temp_name, $location.$unique.$image)){
                    echo '';
                }
            } else {
                $default = 'assets/img/default/default_inv.jpg';
                $default_name = 'default_inv.jpg';
                $saveImage = 'assets/img/upload/inventory/'.$unique.$default_name;

                $copyDefault = copy($default, $saveImage);
            }

        if($ItemType == 'Raw'){
            $TypeID = "2";
        } else if($ItemType == 'Finished') {
            $TypeID = "1";
        } else {
            die;
        }
        
        $query = "INSERT INTO inventory_db (ItemID, ItemName, ItemImg, ItemDesc, ItemType, TypeID, ItemPrice, ItemQty) VALUES ('$ItemID','$ItemName','$saveImage','$ItemDesc','$ItemType','$TypeID','$ItemPrice','$ItemQty')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['ItemID'] = $_POST['ItemID'];
            $_SESSION['ItemName'] = $_POST['ItemName'];
            $_SESSION['ItemDesc'] = $_POST['ItemDesc'];
            $_SESSION['ItemType'] = $_POST['ItemType'];
            $_SESSION['ItemPrice'] = $_POST['ItemPrice'];
            $_SESSION['ItemQty'] = $_POST['ItemQty'];

            header("Location: Inventory.php");
            mysqli_close($con);
            
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Add Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
<div class="container my-5">

    <h1> Add Inventory Item </h1>
        <div class="form-group">
            <form action="AddInventoryItem.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" class="form-control rounded"" name="ItemImg">
                    </div>
                    <div class="col-md-12">
                        <label>Item ID</label>
                        <input type="text" name="ItemID" id="ItemID" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="ItemName" id="ItemName" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label>Type</label>
                        <select class="form-select" id="ItemType" name="ItemType" aria-label=".form-select example" required>
                            <option value="Raw">Raw</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Quantity</label>
                        <input type="text" name="ItemQty" id="ItemQty" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label>Price (in Php)</label>
                        <input type="text" name="ItemPrice" id="ItemPrice" class="form-control rounded" required>
                    </div>      
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea type="text" rows="5" class="form-control rounded" name="ItemDesc" id="ItemDesc" required></textarea>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="add-btn" name="add_item" value="Submit" style="width:150px;border-color:rgb(119,13,253);background-color:rgb(119,13,253);">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form">
                    </div>
                </div>
            </form>
        </div>

        <div id="addModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to add this?</p>
                <div class="modal-footer">
                    <button onClick="addItem()">OK</button>
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

        function addItem() {
            document.getElementById("form").submit();
        }
    </script>

<?php require 'layouts/Footer.php';?>