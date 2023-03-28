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
            header("Location: Inventory.php");
            mysqli_close($con);
            
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Add Inventory | Yarn Over Hook </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/ProdListDesign.css.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <style>
        #myModal2 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }
        #myModal3 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            top: 30%;
            width: 23%;
            background-color: #fee8e8;
            margin: auto;
            padding: 20px;
        }

        .modal-footer {
            border: none;
        }

        .modal-footer button {
            background-color: white;
            margin: 0 auto;
            border: none;
        }
    </style>


<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
<div class="container my-5">

<h1 style="font-weight:bold;"> Add Inventory Item <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: indigo;background: indigo;width:40px;"><a href="Inventory.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
            <form action="AddInventoryItem.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Image</label>
                        <input type="file" class="form-control rounded" name="ItemImg">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Item ID</label>
                        <input type="text" name="ItemID" id="ItemID" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="ItemName" id="ItemName" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Type</label>
                        <select class="form-select" id="ItemType" name="ItemType" aria-label=".form-select example" required>
                            <option value="Raw">Raw</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Quantity</label>
                        <input type="text" name="ItemQty" id="ItemQty" onkeypress="return restrictAlphabets(event)" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Price (in Php)</label>
                        <input type="text" name="ItemPrice" id="ItemPrice" class="form-control rounded" required>
                    </div>      
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Description</label>
                        <textarea type="text" rows="5" class="form-control rounded" name="ItemDesc" id="ItemDesc" required></textarea>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="add-btn" name="add_item" value="Submit" style="font-weight:bold;width:150px;border-color:indigo;background-color:indigo;font-weight:bold;">
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style=" font-weight:bold;width:150px;font-weight:bold;">
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

    <div id="myModal3" class="modal">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;color:red;font-size:32px;">Unable to add!</p>
                <p style="text-align:center;" id="error-message"></p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="errorBtnClode" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                </div>
            </div>
        </div>
    
        <script>
            document.getElementById('add-btn').addEventListener('click', (e) => {
            var modalError = document.getElementById("myModal3");
            var errorBtn = document.getElementById("errorBtnClode");
            
            errorBtn.onclick = function() {
                modalError.style.display = "none";
            }
            
            document.getElementById('add-btn').onclick = function() {
                let fields = {
                    'ItemID': 'ItemID',
                    'ItemName': 'Name',
                    'ItemType': 'Type',
                    'ItemQty': 'Quantity',
                    'ItemPrice': 'Price',
                    'ItemDesc': 'Description',
                    
                }

                for (const key in fields) {
                    if (document.getElementsByName(key)[0].value.length === 0) {
                        document.getElementById('error-message').innerHTML = fields[key] + ' is required';
                        modalError.style.display = "block";
                        return;
                    }
                }
                
            e.preventDefault();
            document.getElementById('addModal').style.display = 'block';
        }});

        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function addItem() {
            
            document.getElementById("form").submit();
            window.location.href('Inventory.php');
        }
    
        </script>
        
         <script>
        function restrictAlphabets(e){
            var x = e.which || e.keycode;
            if((x >= 48 && x <=57 ))
                return true;
            else
                return false;
        }
        </script>

<?php require 'layouts/Footer.php';?>