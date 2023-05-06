<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    $user_data = check_login($con);
    
    require 'layouts/Header.php';

    $inv = "SELECT * FROM inventory_db ORDER BY ItemID";
	$result_inv = mysqli_query($con, $inv);
	$inv_item = mysqli_fetch_all($result_inv, MYSQLI_ASSOC);
	mysqli_free_result($result_inv);

    $prof = "SELECT * FROM cust_profile WHERE cust_status = '1'";
	$result_prof = mysqli_query($con, $prof);
	$prof_sel = mysqli_fetch_all($result_prof, MYSQLI_ASSOC);
	mysqli_free_result($result_prof);

    $mat = "SELECT * FROM inventory_db WHERE TypeID='2' ORDER BY ItemID";
	$result_mat = mysqli_query($con, $mat);
	$inv_mat = mysqli_fetch_all($result_mat, MYSQLI_ASSOC);
	mysqli_free_result($result_mat);

?>

<?php 
    if(isset($_POST['submit'])) {
        $CustProf = $_POST['CustProf'];
        $InvItem = $_POST['InvItem'];
        $OrderType = $_POST['OrderType'];
        $OrderQty = mysqli_real_escape_string($con, $_POST['OrderQty']);
        $MaterialUsed = $_POST['MaterialUsed'];
        $MaterialQty = mysqli_real_escape_string($con, $_POST['MaterialQty']);
        $PaymentDue = date('Y-m-d', strtotime($_POST['PaymentDue']));

        if($OrderType == 'On-Going'){
            $TypeID = "1";
        } else if($OrderType == 'Completed') {
            $TypeID = "2";
        } else if($OrderType == 'Pending') {
            $TypeID = "3";
        } else {
            die;
        }

        $item = "SELECT * FROM inventory_db WHERE ItemID = $InvItem";
		$result = mysqli_query($con, $item);
		$selected_item = mysqli_fetch_assoc($result);

        $material = "SELECT ItemQty FROM inventory_db WHERE ItemName = '$MaterialUsed'";
		$result1 = mysqli_query($con, $material);
		$selected_mat = mysqli_fetch_assoc($result1);

        $selectPrice = $selected_item['ItemPrice'];

        $OrderTotal = $OrderQty * $selectPrice;

        
            if($OrderQty > $selected_item['ItemQty'] || $MaterialQty > $selected_mat['ItemQty']){
                ?>
                    <script>
                        window.location.replace("AddOrder.php?add=error");
                    </script>
                <?php
            }
            else{
        $query = "INSERT INTO orders_db (ItemID,c_id,OrderType,TypeID,OrderQty,OrderTotal,MaterialUsed,MaterialQty,PaymentDue) VALUES ('$InvItem','$CustProf','$OrderType','$TypeID','$OrderQty','$OrderTotal','$MaterialUsed','$MaterialQty','$PaymentDue')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['CustProf'] = $_POST['CustProf'];
            $_SESSION['InvItem'] = $_POST['InvItem'];
            $_SESSION['OrderType'] = $_POST['OrderType'];
            $_SESSION['OrderQty'] = $_POST['OrderQty'];

            $sql = "UPDATE inventory_db SET ItemQty=ItemQty-$OrderQty WHERE ItemID='$InvItem' ";
            $sql2 = "UPDATE inventory_db SET ItemQty=ItemQty-$MaterialQty WHERE TypeID='2' ";
            $result = mysqli_query($con, $sql);
            $result2 = mysqli_query($con, $sql2);
            if($result && $result2) {
            ?>
                <script>
                    window.location.replace("OrdersAdminView.php");
                </script>
            <?php
            mysqli_close($con);
            exit();
            }

            mysqli_close($con);
            ?>
                <script>
                    window.location.replace("OrdersAdminView.php");
                </script>
            <?php
            exit();
        
        } else {
            echo "<script> alert('Problem occured.') </script>";
            }
        }
    }
?>
<head>
        <title> Add Order | Yarn Over Hook </title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  	<script>
	  		$( function() {
	   			$( "#PaymentDue" ).datepicker({
	   				minDate: 0
	   			});
	  		});
	  	</script>
</head>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div class="container my-5">

    <h1 style="font-weight:bold;"> Add Order <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color: indigo;background: indigo;width:40px;"><a href="OrdersAdminView.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h1>
        <div class="form-group">
            <form action="AddOrder.php" method="POST">
                <div class="row my-3">
                    <h3 class="my-3" style="font-weight:bold;"> Order Details </h3>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Customer</label>
                        <select class="form-select rounded" id="CustProf" name="CustProf" aria-label=".form-select example" required>
                
                            <?php foreach($prof_sel as $prof): ?>
                            <option value="<?php echo $prof['c_id'] ?>"><?php echo $prof['c_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Item</label>
                        <select class="form-select rounded" id="InvItem" name="InvItem" aria-label=".form-select example" required>
                            <?php foreach($inv_item as $inv): ?>
                            <option value="<?php echo $inv['ItemID'] ?>"><?php echo $inv['ItemName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Order Type</label>
                        <select class="form-select rounded" id="OrderType" name="OrderType" aria-label=".form-select example" required>
                            <option value="Pending">Pending</option>
                            <option value="On-Going">On-Going</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Material Used: </label>
                        <select class="form-select rounded" id="MaterialUsed" name="MaterialUsed" aria-label=".form-select example" required>
                           
                        <?php foreach($inv_mat as $inv): ?>
                            <option value="<?php echo $inv['ItemName'] ?>"><?php echo $inv['ItemName'] ?></option>
                            <?php endforeach; ?>
                            <input type="text" name="MaterialQty" id="MaterialQty" placeholder="Total number of materials used" onkeypress="return restrictAlphabets(event)" class="form-control rounded mt-2" required>
                        </select>
                    </div>
                    
                    <div class="col-md-2 col-5">
                        <label style="font-weight:bold;">Order Quantity</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger btn-number text-white me-2" disabled="disabled" data-type="minus" data-field="OrderQty"> <i class="fas fa-minus"></i> </button>
                            </span>
                            <input type="text" name="OrderQty" id="OrderQty" onkeypress="return restrictAlphabets(event)" class="form-control rounded input-number me-2" value="1" min="1" max="100" required>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-number text-white" data-type="plus" data-field="OrderQty"> <i class="fas fa-plus"></i> </button>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label style="font-weight:bold;">Order Due</label>
                        <input type="date" name="PaymentDue" id="PaymentDue" min="<?php echo date('Y-m-d'); ?>" class="form-control rounded" required>
                    </div>
                    <?php 
                    if (isset($_GET['add']) && $_GET['add'] === 'error') { ?>
                        <p style="font-weight:bold;color:red;text-align:center;"> Error in adding order. 
                    Quantity of order cannot exceed quantity of item in inventory.</p>
                             
                    <?php } ?>
                   
                
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;font-weight:bold;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;font-weight:bold;">
                    </div>
                </div>
            </form>
        </div>
    </div>

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
        function restrictAlphabets(e){
            var x = e.which || e.keycode;
            if((x >= 48 && x <=57 ))
                return true;
            else
                return false;
        }
        </script>
<?php require 'layouts/Footer.php';?>