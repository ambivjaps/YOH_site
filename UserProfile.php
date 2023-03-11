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
		$item = "SELECT * FROM register WHERE login_id = $id";
		$result = mysqli_query($con, $item);
		$user = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

        $cust_prof = mysqli_real_escape_string($con, $_SESSION['login_id']);
		$main = "SELECT * FROM cust_profile WHERE c_id = $cust_prof AND current_profile='1'";
		$result_prof = mysqli_query($con, $main);
		$select = mysqli_fetch_all($result_prof, MYSQLI_ASSOC);

		mysqli_free_result($result_prof);

		$other = "SELECT * FROM cust_profile WHERE c_id = $cust_prof AND current_profile='0'";
		$result_choice = mysqli_query($con, $other);
		$option = mysqli_fetch_all($result_choice, MYSQLI_ASSOC);

		mysqli_free_result($result_choice);
	}

?>

<?php
    if(isset($_POST['submit'])) {
        $new_id = $_POST['selected_prof'];
        $old_id = $_POST['old_id'];

        $query = "UPDATE cust_profile SET current_profile='1' WHERE id=$new_id";
        $query2 = "UPDATE cust_profile SET current_profile='0' WHERE id=$old_id";

        $query_run = mysqli_query($con, $query);
        $query_run2 = mysqli_query($con, $query2);
    
        if($query_run) {
            if($query_run2) {

            }
            
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
            <h3><strong> User Profile </strong></h3><hr>

            <div class="col-md-2">
                <img class="img-fluid rounded" src="assets/img/default/default_user.jpg">
            </div>

            <div class="col-md-10">
                <h1> <?php echo $user['cust_name'] ?> </h1>
                <p> Address: <?php echo $user['cust_address'] ?> </p>
                <p> Phone Number: <?php echo $user['cust_phone'] ?> </p>
                <p> Email: <?php echo $user['cust_email'] ?> </p>
                <p> User since <?php echo date("F d, Y", strtotime($user['date'])); ?>  </p>
            </div>
        </div>

        <hr><div class="row my-3">
        <h3><strong> Customer Profile </strong></h3>

        <?php foreach($select as $prof): ?>
            <p> Current customer profile used: <strong> <?php echo $prof['c_label']; ?> </strong> </p>
            <table class="table table-striped table-hover table-sm mt-2">
                <tr>
                    <th> Name </th>
                    <th> Address </th>
                    <th> E-mail </th>
                    <th> Phone Number </th>
                    <th> Action </th>
                </tr>

                <tr><td> <?php echo $prof['c_name']; ?> </td>
                <td> <?php echo $prof['address']; ?>  </td>
                <td> <?php echo $prof['email']; ?> </td>
                <td> <?php echo $prof['phone_no']; ?> </td>
                <td> <a class="btn btn-sm btn-primary" href="ProfileAccnt.php?id=<?php echo $prof['id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>
            </table>
        <?php endforeach; ?>
            
            <div class="form-group">
                <form action="UserProfile.php?id=<?php echo $_SESSION['login_id'] ?>" method="POST">
                    <div class="row my-3">
                        <div class="col-md-4">
                            <label>Change current customer profile to use:</label>
                            <select class="form-select" id="selected_prof" name="selected_prof" aria-label=".form-select example">
                                <?php foreach($option as $change): ?>
                                <option value="<?php echo $change['id']; ?>"><?php echo $change['c_label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php foreach($select as $prof): ?>
                            <input type="hidden" name="old_id" value="<?php echo $prof['id'] ?>">
                            <?php endforeach; ?>
                        </div>
                        <div class="button-group float-end">
                            <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr><div class="row my-3">
            <h3><strong> User Settings </strong></h3>
            <div class="float-end mt-2">
                <a class="btn btn-dark" href="ProfileAccntView.php" role="button"> See your customer profiles </a>
                <a class="btn btn-dark" href="OrderPageCust.php" role="button"> See your orders </a>
                <a class="btn btn-dark" href="ResetPass.php" role="button"> Change password </a>
            </div>
        </div>

        <?php else: ?>
                <div class="container my-5">
                    <h2> Oops.. Page not found. Please try again. </h2>
                </div>
        <?php endif ?>
    </div>

<?php require 'layouts/Footer.php';?>