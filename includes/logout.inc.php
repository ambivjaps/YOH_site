<?php

session_start();

if(isset($_SESSION['cust_id']))
{
    unset($_SESSION['cust_id']);
}

header("Location: ../index.php");
die;