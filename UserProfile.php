<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

    if(isset($_SESSION['login_id'])) {

		$id = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$item = "SELECT * FROM register WHERE login_id = $id AND user_rank = 'user'";
		$result = mysqli_query($con, $item);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

        $cust_prof = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$main = "SELECT * FROM cust_profile WHERE c_id = $cust_prof AND cust_status='1'";
		$result_prof = mysqli_query($con, $main);
		$select = mysqli_fetch_all($result_prof, MYSQLI_ASSOC);
		mysqli_free_result($result_prof);

		$other = "SELECT * FROM cust_profile WHERE c_id = $cust_prof AND cust_status='0'";
        $other_count = "SELECT COUNT(*) FROM cust_profile WHERE c_id = $cust_prof AND cust_status='0'";

		$result_choice = mysqli_query($con, $other);
        $result_count = mysqli_query($con, $other_count);

		$option = mysqli_fetch_all($result_choice, MYSQLI_ASSOC);
        $count = mysqli_fetch_array($result_count)[0];
		mysqli_free_result($result_choice);
        mysqli_free_result($result_count);
	}

?>

<?php
    if(isset($_POST['change_current'])) {
        $new_id = $_POST['selected_prof'];
        $old_id = $_POST['old_id'];
        $query = "UPDATE cust_profile SET cust_status='1' WHERE id=$new_id";
        $query2 = "UPDATE cust_profile SET cust_status='0' WHERE id=$old_id";

        $query_run = mysqli_query($con, $query);
        $query_run2 = mysqli_query($con, $query2);
    
        if($query_run && $query_run2) {
            header("Location: UserProfile.php");
            mysqli_close($con);

            exit();
        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    }
?>

<title> User Profile | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
    
    <div class="container my-5">

        <?php if($user): ?>

        <div class="row my-3">
            <h3 style="font-weight:bold;"><strong> <i class="fas fa-user"></i> User Profile </strong></h3><hr>

            <div class="col-md-2">
                <img class="img-fluid rounded avatar-fit" src="<?php echo $user['cust_avatar'] ?>" title="<?php echo $user['cust_name'] ?>" alt="<?php echo $user['cust_name'] ?>">
            </div>

            <div class="col-md-10">
                <h1 style="font-weight:bold;color: rgb(111, 66, 193);"> <?php echo $user['cust_name'] ?> </h1>
                <h6 style="font-weight:bold;"> <span class="badge" style="background-color:green;"> Verified User </span></h6>
                <p style="font-weight:bold;"> Address: <?php echo $user['cust_address'] ?> </p>
                <p style="font-weight:bold;"> Mobile Number: <?php echo $user['cust_phone'] ?> </p>
                <p style="font-weight:bold;"> E-mail Address: <?php echo $user['cust_email'] ?> </p>
                <p style="font-weight:bold;"> Instagram Handle: <?php echo $user['cust_ig'] ?> </p>
                <p style="font-weight:bold;"> Account last updated on: <i><?php echo date("F d, Y", strtotime($user['date'])); ?></i>  </p>
            </div>

            <div class="float-end mt-2">
                <a class="btn btn-dark" href="UserProfileEdit.php" role="button" style="font-weight:bold;border-color:indigo;background-color:indigo;;"> Edit Profile </a>
                <a class="btn btn-dark" href="ChangePassword.php" role="button" style="font-weight:bold;border-color:indigo;background-color:indigo;"> Change Password </a>
            </div>
        </div>

        <hr><div class="row my-3">
        <h3><strong> <i class="fas fa-address-card" ></i> Customer Records </strong></h3>

        <?php foreach($select as $prof): ?>
            <div class="float-end mt-2 mb-5">
                <a class="btn btn-dark" href="ProfileAccntView.php" role="button" style="font-weight:bold;border-color:indigo;background-color:indigo;"> See your customer profiles </a>
                <a class="btn btn-dark" href="OrderPageCust.php" role="button" style="font-weight:bold;border-color:indigo;background-color:indigo;"> See your orders </a>
            </div>
            
            <p> Current customer profile used: <strong> <?php echo $prof['c_label']; ?> </strong> </p>
            <table class="table table-striped table-hover table-sm mt-2">
                <tr>
                    <th style="font-weight:bold;"> Name </th>
                    <th style="font-weight:bold;"> Address </th>
                    <th style="font-weight:bold;"> Mobile No. </th>
                    <th style="font-weight:bold;"> Action </th>
                </tr>

                <tr><td> <?php echo $prof['c_name']; ?> </td>
                <td> <?php echo $prof['address']; ?>  </td>
                <td> <?php echo $prof['phone_no']; ?> </td>
                <td> <a class="btn btn-sm btn-primary" href="ProfileAccnt.php?id=<?php echo $prof['id'] ?>" role="button" style="border-color:indigo;background-color:indigo;;"><i class="fas fa-eye"></i> View</a> </td></tr>
            </table>
        <?php endforeach; ?>

        <?php if($count < 1) {
            echo "<p> Please create a new record in the Profiles page in order to change your current customer profile. </p>";
            ?>
        <?php } else if ($count >= 1) {
            ?>
            <div class="form-group mt-3">
                <p> Change current customer profile: </p>
                <form class="row g-3" action="UserProfile.php?id=<?php echo $_SESSION['login_id'] ?>" method="POST">
                    <div class="col-md-4">
                        <select class="form-select" id="selected_prof" name="selected_prof" aria-label=".form-select example">
                            <?php foreach($option as $change): ?>
                            <option value="<?php echo $change['id']; ?>"><?php echo $change['c_label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php foreach($select as $prof): ?>
                        <input type="hidden" name="old_id" value="<?php echo $prof['id'] ?>">
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <input class="btn btn-success" type="submit" id="submit" name="change_current" value="Select"  style="font-weight:bold;background-color:indigo;border-color:indigo;">
                    </div>
                </form>
            </div>
            <?php
        }
        ?>
        
        </div>
        
        <?php else: ?>
                <div class="container my-5">
                    <h2> Oops.. Page not found. Please try again. </h2>
                </div>
        <?php endif ?>
    </div>

<?php require 'layouts/Footer.php';?>