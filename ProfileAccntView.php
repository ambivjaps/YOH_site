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
        // gets specific records based on current user
		$item = "SELECT * FROM cust_profile WHERE c_id = $id";
        // retrieves total number of records
        $count = "SELECT COUNT(*) FROM cust_profile WHERE c_id = $id";

		$result = mysqli_query($con, $item);
        $result_count = mysqli_query($con, $count);

		$c_prof = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $r_count = mysqli_fetch_array($result_count)[0];
        mysqli_free_result($result);
        mysqli_close($con);
	}
?>

<title> Profiles | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <main class="page blog-post">
        <section class="clean-block clean-post dark" style="background-color:#efe9ef;">
            <div class="container my-5">

                <a class="btn btn-success" href="AddCustomerProf.php" role="button"> Add a profile </a><hr>

                <h1> Profiles for <?php echo $_SESSION['cust_name'] ?> </h1>
                
                <table class="table table-striped table-hover table-sm mt-5">
                    <tr>
                        <th> # </th>
                        <th> Label </th>
                        <th> Name </th>
                        <th> Address </th>
                        <th> Updated At </th>
                        <th> Action </th>
                    </tr>

                    <?php $loop=1; foreach($c_prof as $profile): ?>
                        <tr><td> <?php echo $loop; ?> </td>
                        <td> <?php echo $profile['c_label']; ?> </td>
                        <td> <?php echo $profile['c_name']; ?> </td>
                        <td> <?php echo $profile['address']; ?> </td>
                        <td> <?php echo $profile['date']; ?> </td>
                        <td> <a class="btn btn-sm btn-primary" href="ProfileAccnt.php?id=<?php echo $profile['id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>
                    <?php $loop++; endforeach; ?>
                </table>
                <p> Showing <strong> <?php echo $r_count ?> </strong> records found. </p>
                
            </div>
        </section>
    </main>
		
<?php require 'layouts/Footer.php';?>