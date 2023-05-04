<?php
function access($rank)
{
 
    if(isset($_SESSION["ACCESS"]) && !$_SESSION["ACCESS"][$rank])
    {
        header("Location: HomePage.php");
        die;
    }
}

$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['user_rank']) && $_SESSION['user_rank'] == "admin";

$_SESSION["ACCESS"]["USER"] = isset($_SESSION['user_rank']) && $_SESSION['user_rank'] == "user";