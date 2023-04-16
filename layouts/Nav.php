<header>
    <style>
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
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            z-index: 1;
        }

        .dropdown-content a {
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            width: 200px;
            background-color:#efe9ef;
            align-items: center;
            justify-content: center;
            
        }

        .dropbtn {
            
            padding: 10px;
            font-size: 16px;
            border: none;
        }

        .dropbtn:hover {
            color:indigo;
        }
    </style>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top clean-navbar">
        <div class="container">
        <a class="navbar-brand logo mx-auto" href="HomePage.php" style="padding-left: 55px;padding-right: 0px;margin-right: 44px;font-size: 30px;font-family: Alata, sans-serif;">
        <img width="70" style="padding-left: 0px;margin-left: -58px;padding-bottom: 0px;" src="assets/img/LOGOEXAMPLE.png" title="Yarn Over Hook" alt="Yarn Over Hook">&nbsp; Yarn Over Hook</a>
        
        <button data-bs-toggle="collapse" class="navbar-toggler custom-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse my-2" id="navcol-1">

            <?php
                if (isset($_SESSION['login_id']) && $_SESSION['user_rank'] == 'user'){
                    echo '<ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="HomePage.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="OrderItem.php"><i class="fas fa-check-square"></i> Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="UserProfile.php"><h6><span class="badge rounded-pill text-white" style="background-color: #4a3a4b;"><i class="fas fa-user-circle"></i> '.$_SESSION['cust_name'].'</span></h6></a></li>
                    <button class="btn btn-light my-3 my-sm-0" id="logout" name="logout" type="submit" style="background-color:indigo;border-color:indigo;color:white;font-weight:bold;"> <i class="fas fa-sign-out-alt"></i> Logout</button>
                    </ul>';
                    ?>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                    <script src="assets/js/sessiontimeout.js"></script>
                    <?php

                } else if (isset($_SESSION['login_id']) && $_SESSION['user_rank'] == 'admin') {
                    echo '<ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="HomePage.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="CustomerProfileListAdmin.php"><i class="fas fa-user-friends"></i> Profiles</a></li>
                    <li class="nav-item"><a class="nav-link" href="Inventory.php"><i class="fas fa-dolly-flatbed"></i> Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="OrdersAdminView.php"><i class="fas fa-check-square"></i> Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="UserProfileAdmin.php"><h6><span class="badge rounded-pill text-white" style="background-color: #4a3a4b;"><i class="fas fa-user-cog"></i> '.$_SESSION['cust_name'].'</span></h6></a></li>
                    <button class="btn btn-light my-3 my-sm-0" id="logout" name="logout" type="submit" style="background-color:indigo;border-color:indigo;color:white;font-weight:bold;"> <i class="fas fa-sign-out-alt"></i> Logout</button>
                    </ul>';
                    ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="assets/js/sessiontimeout.js"></script>
            <?php

                } else {
                    echo '<ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="HomePage.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="Videos.php"><i class="fas fa-play"></i> Videos</a></li>
                    <li class="nav-item" style="border-right: 2px solid dimgray;"><a class="nav-link" href="FAQ.php"><i class="fas fa-question-circle"></i> FAQ</a></li>
                    <li class="nav-item"></li>
                    <div class="dropdown">
                    <a aria-expanded="false" data-bs-toggle="dropdown" style="color:grey;"><i class="fas fa-user my-2"></i> Login/Register</a>
                    <div class="dropdown-content rounded" style="align-content">
                    <a class="nav-link dropbtn" href="Login.php" style="font-size:15px;"><i class="fas fa-sign-in-alt"></i>  L<span style="text-transform:lowercase;">ogin </a></li>
                    <a class="nav-link dropbtn" href="registration.php" style="font-size:15px;"> <i class="fas fa-user-plus"></i> R<span style="text-transform:lowercase;">egister </a></li>
                    </div>
                    </div>
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

    <div id="logoutconfirmation" class="modal">
        <div class="modal-content">
            <p style="text-align:center; font-weight: bold; font-size:20px;">Are you sure you want to logout?</p>
            <div class="modal-footer">
                <button class="btn btn-success mt-3" id="okLogout" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                <button class="btn  mt-3" value="Cancel" id="cancelLogout" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let logoutBtn = document.getElementsByName('logout')[0];
        let okBtn = document.getElementById('okLogout');
        let cancelBtn = document.getElementById('cancelLogout');

        logoutBtn.addEventListener('click', () => {
            document.getElementById('logoutconfirmation').style.display = 'block';
        });

        cancelBtn.addEventListener('click', () => {
            document.getElementById('logoutconfirmation').style.display = 'none';
        });

        okBtn.addEventListener('click', () => {
            window.location.href = "includes/logout.inc.php";
        });


    </script>
</header>