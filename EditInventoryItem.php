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
		$item = "SELECT * FROM inventory_db WHERE ItemID = $id";
		$result = mysqli_query($con, $item);
		$inv = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<?php 
     if(isset($_POST['edit_inventory'])) {
        $InvID = $inv['ItemID'];
    
        $ItemName = mysqli_real_escape_string($con, $_POST['ItemName']);
        $ItemDesc = mysqli_real_escape_string($con, $_POST['ItemDesc']);
        $ItemQty = mysqli_real_escape_string($con, $_POST['ItemQty']);
        $ItemType = $_POST['ItemType'];
        $ItemPrice = mysqli_real_escape_string($con, $_POST['ItemPrice']);

        $new_image = $_FILES['ItemImg']['name'];
        $old_image = $_POST['ItemImg_old'];
        $unique = strtotime("now").'_'.uniqid(rand()).'_';

        if($new_image != '') {
            $update_filename = 'assets/img/upload/inventory/' . $unique . $_FILES['ItemImg']['name'];
        } else {
            $update_filename = $old_image;
        }

        if(file_exists("assets/img/upload/inventory/" . $_FILES['ItemImg']['name'])) {
        } else {
            $query = "UPDATE inventory_db SET ItemImg='$update_filename' WHERE ItemID='$InvID' ";
            $query_run = mysqli_query($con, $query);

            if($query_run) {
                if($_FILES['ItemImg']['name'] != '') {
                    move_uploaded_file($_FILES['ItemImg']['tmp_name'], "assets/img/upload/inventory/" . $unique . $_FILES['ItemImg']['name']);
                    unlink($old_image);
                }
            } else {
                echo "<script> alert('Problem occured.') </script>";
            }
        }

        if($ItemType == 'Raw'){
            $query = "UPDATE inventory_db SET TypeID='2' WHERE ItemID=$InvID";
            $query_run = mysqli_query($con, $query);
        } else if($ItemType == 'Finished') {
            $query = "UPDATE inventory_db SET TypeID='1' WHERE ItemID=$InvID";
            $query_run = mysqli_query($con, $query);
        } else {
            die;
        }
    
        $query = "UPDATE inventory_db SET ItemName='$ItemName',ItemDesc='$ItemDesc',ItemQty='$ItemQty',ItemType='$ItemType',ItemPrice='$ItemPrice' WHERE ItemID=$InvID";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            ?>
                <script>
                    window.location.replace("Inventory.php");
                </script>
            <?php
            exit();
        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> Edit Inventory Item | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

<?php if($inv): ?>

    <div class="container my-5">

        <h1 style="font-weight:bold;"> Edit Inventory Item <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="InventoryItem.php?id=<?php echo $inv['ItemID'] ?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span></h1><hr>
        <div class="form-group">
            <form action="EditInventoryItem.php?id=<?php echo $inv['ItemID'] ?>" method="POST" id="form" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-md-2">
                        <img class="img-fluid rounded avatar-fit" src="<?php echo $inv['ItemImg']; ?>" id="imgDisplay">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;">Image</label>
                        <input class="form-control rounded" type="file" onchange="readURL(this)" class="form-control form-control my-3" name="ItemImg">
                        <input class="form-control rounded" type="hidden" onchange="readURL(this)" name="ItemImg_old" value="<?php echo $inv['ItemImg']; ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="ItemName" id="ItemName" class="form-control rounded" value="<?php echo $inv['ItemName'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;"style="font-weight:bold;">Type</label>
                        <select class="form-select" id="ItemType" name="ItemType" aria-label=".form-select example">
                            <option value="Raw" <?php if($inv['ItemType'] == 'Raw') { ?>selected="selected"<?php } ?>>Raw</option>
                            <option value="Finished" <?php if($inv['ItemType'] == 'Finished') { ?>selected="selected"<?php } ?>>Finished</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-5">
                        <label style="font-weight:bold;">Quantity</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger btn-number text-white me-2" disabled="disabled" data-type="minus" data-field="ItemQty"> <i class="fas fa-minus"></i> </button>
                            </span>
                            <input type="text" name="ItemQty" id="ItemQty" onkeypress="return restrictAlphabets(event)" class="form-control rounded input-number me-2" min="1" max="100" value="<?php echo $inv['ItemQty'] ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-number text-white" data-type="plus" data-field="ItemQty"> <i class="fas fa-plus"></i> </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Price (in Php)</label>
                        <input type="text" name="ItemPrice" id="ItemPrice" onkeypress="return restrictAlphabets(event)" class="form-control rounded" value="<?php echo $inv['ItemPrice'] ?>">
                    </div>      
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Description</label>
                        <textarea type="text" rows="5" class="form-control rounded" name="ItemDesc" id="ItemDesc"><?php echo $inv['ItemDesc'] ?></textarea>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="editInventory" name="edit_inventory" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>

        <div id="editModal" class="modal" style="display: none">
            <div class="modal-content" style="width:300px;">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to edit this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="editInventory()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
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

    $('.btn-number').click(function(e){
        e.preventDefault();
        
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                
                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                } 
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
    $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        
        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
        
        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        
        
    });
    $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    </script>

    <script>
        document.getElementById('editInventory').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('editModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function editInventory() {
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