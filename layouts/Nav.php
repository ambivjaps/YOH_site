<header>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top clean-navbar">
        <div class="container">
        <a class="navbar-brand logo mx-auto" href="HomePage.php" style="padding-left: 55px;padding-right: 0px;margin-right: 44px;font-size: 30px;font-family: Alata, sans-serif;">
        <img width="70" style="padding-left: 0px;margin-left: -58px;padding-bottom: 0px;" src="assets/img/LOGOEXAMPLE.png" title="Yarn Over Hook" alt="Yarn Over Hook">&nbsp; Yarn Over Hook</a>
        
        <button data-bs-toggle="collapse" class="navbar-toggler custom-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse my-2" id="navcol-1">

            <?php
                if (isset($_SESSION['cust_id']) && $_SESSION['user_rank'] == 'user'){
                    echo '<ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="HomePage.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="ProfileAccntView.php"><i class="fas fa-user-friends"></i> Profiles</a></li>
                    <li class="nav-item"><a class="nav-link" href="OrderPageCust.php"><i class="fas fa-check-square"></i> Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Welcome, '.$_SESSION['cust_name'].'!</a></li>
                    <form class="form-inline" action="includes/logout.inc.php">
                        <button class="btn btn-light my-3 my-sm-0" id="logout" name="logout" type="submit"> <i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                    </ul>';

                } else if (isset($_SESSION['cust_id']) && $_SESSION['user_rank'] == 'admin') {
                    echo '<ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="HomePage.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="CustomerProfileListAdmin.php"><i class="fas fa-user-friends"></i> Profiles</a></li>
                    <li class="nav-item"><a class="nav-link" href="Inventory.php"><i class="fas fa-dolly-flatbed"></i> Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="OrdersAdminView.php"><i class="fas fa-check-square"></i> Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Welcome, '.$_SESSION['cust_id'].'!</a></li>
                    <form class="form-inline" action="includes/logout.inc.php">
                        <button class="btn btn-light my-3 my-sm-0" id="logout" name="logout" type="submit"> <i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                    </ul>';

                } else {
                    echo '<ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="HomePage.php"><i class="fas fa-home"></i> Home</a></li>
                    <form class="form-inline" action="Login.php">
                        <button class="btn btn-light my-3 my-sm-0" type="submit"> <i class="fas fa-sign-in-alt"></i> Login</button>
                    </form>
                    </ul>';
                }
            ?>

                <div class="soc-med d-lg-none">
                    <hr>
                    <strong> FOLLOW US </strong>
                    <ul class="navbar-nav soc-nav">
                        <li><a class="nav-link" href="https://www.facebook.com/y.o.h.plus" target="_blank"> <i class="fab fa-facebook fa-lg"></i></a></li>
                        <li><a class="nav-link" href="https://www.instagram.com/y.o.h.plus" target="_blank"> <i class="fab fa-instagram fa-lg"></i></a></li>
                        <li><a class="nav-link" href="https://www.youtube.com/channel/UCSxg8KwMRQxEk8v5vjpXKcg" target="_blank"> <i class="fab fa-youtube fa-lg"></i></a></li>
                        <li><a class="nav-link" href="https://vt.tiktok.com/ZScNM2Lx" target="_blank"> <i class="fab fa-tiktok fa-lg"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>