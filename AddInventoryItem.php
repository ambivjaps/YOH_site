<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('ADMIN');
    $user_data = check_login($con);

    if(isset($_POST['ItemID'])) {
        $ItemID = $_POST['ItemID'];
        $ItemName = $_POST['ItemName'];
        $ItemDesc = $_POST['ItemDesc'];
        $ItemQty = $_POST['ItemQty'];
        $ItemType = $_POST['ItemType'];
        $ItemPrice = $_POST['ItemPrice'];

        if($ItemType == 'Raw'){
        $addr = "insert into inventory_db (ItemID, ItemName, ItemQty, ItemPrice, ItemDesc, ItemType, TypeID) values
         ('$ItemID', '$ItemName', '$ItemQty', '$ItemPrice', '$ItemDesc', '$ItemType', '2')";
         $run = mysqli_query($con, $addr);

         }else if($ItemType == 'Finished'){
            $addf = "insert into inventory_db (ItemID, ItemName, ItemQty, ItemPrice, ItemDesc, ItemType, TypeID) values
         ('$ItemID', '$ItemName', '$ItemQty', '$ItemPrice', '$ItemDesc', '$ItemType', '1')";
         $run = mysqli_query($con, $addf);
         }else {die;}

         if($run) {
            $_SESSION['ItemID'] = $_POST['ItemID'];
            $_SESSION['ItemName'] = $_POST['ItemName'];

            $_SESSION['ItemDesc'] = $_POST['ItemDesc'];
            $_SESSION['ItemQty'] = $_POST['ItemQty'];
            $_SESSION['ItemType'] = $_POST['ItemType'];
            $_SESSION['ItemPrice'] = $_POST['ItemPrice'];
            mysqli_close($con);
            header("Location: Inventory.php");
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
    
    require 'layouts/Header.php';
?>

<title> Add Inventory | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
        
    
                        
                    </div>
                </div>
                <form action="AddInventoryItem.php" method="POST" name="Add_inv">
                    <div class="row profile-row">
                        <div class="col-md-4 relative">
                            <div class="avatar">
                                <div ><img class="img-fluid d-block mx-auto rounded" src="assets/img/avatars/nopicinv.png"></div>
                                <br>
                            </div><input class="form-control form-control" type="file" name="avatar-file">
                        </div>
                        <div class="form-group">
                        <div class="col-md-12">
                        <label>Item ID</label>
                        <input type="text" name="ItemID" id="ItemID" class="form-control" value="">
                    </div>
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="ItemName" id="ItemName" class="form-control" value="">
                    </div>
                    <div class="col-md-12">
                        <label>Type <strong></strong></label>
                        <select class="form-select" id="ItemType" name="ItemType" aria-label=".form-select example">
                            <option value="Raw">Raw</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Quantity</label>
                        <input type="text" name="ItemQty" id="ItemQty" class="form-control" value="">
                    </div>
                    <div class="col-md-12">
                        <label>Price (in Php)</label>
                        <input type="text" name="ItemPrice" id="ItemPrice" class="form-control" value="">
                    </div>      
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea type="text" rows="5" class="form-control" name="ItemDesc" id="ItemDesc"></textarea>
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