<?php
include("includes/dbh.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

$searchParam = "%" . $_POST['search'] . "%";
$stmt = $con->prepare("SELECT *
    FROM cust_profile
    WHERE c_id LIKE ?
    OR c_name LIKE ?
    AND cust_status='1'
    ORDER BY id
    ");
$stmt->bind_param("is", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $profile) :
?>
        <div class="clean-blog-post">
            <div class="row">
                <div class="col-lg-4">
                    <?php
                    $current_user = $profile['login_id'];
                    $item_av = "SELECT * FROM register WHERE login_id = $current_user";
                    $result_av = mysqli_query($con, $item_av);
                    $prof_avatar = mysqli_fetch_assoc($result_av);
                    mysqli_free_result($result_av);
                    ?>
                    <a href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>">
                        <img class="rounded img-fluid" src="<?php echo $prof_avatar['cust_avatar']; ?>" title="" alt="">
                    </a>
                </div>
                <div class="col-lg-7">
                    <h4><a href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>" style="color:black;text-decoration:none;font-weight:bold; font-size:35px;"><?php echo $profile['c_name']; ?></a></h4>

                    <div class="info">
                        <?php
                        $current_user = $profile['login_id'];
                        $item_order = "SELECT * FROM orders_db WHERE c_id = $current_user ORDER BY OrderID DESC LIMIT 1";
                        $result_order = mysqli_query($con, $item_order);
                        $latest_order = mysqli_fetch_assoc($result_order);
                        mysqli_free_result($result_order);
                        ?>
                        <span class="text-muted">Last Ordered on <i> 
                            <?php if(!empty($latest_order['OrderDate'])){ 
                                echo date("F d, Y h:i:s A (l)", strtotime($latest_order['OrderDate']));
                              } 
                            else{ ?>
                                <p class="text-muted">No Order History </p>
                          <?php } 
                            ?> </i> &nbsp;</span>
                    </div>
                    <a class="btn btn-sm btn-primary" href="ProfileAccntViewAdmin.php?id=<?php echo $profile['id']; ?>" role="button" style="border-color: rgb(119,13,253);background: rgb(119,13,253);"><i class="fas fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        <hr>
<?php
    endforeach;
endif;
?>