<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "yoh_db";
$connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    
    die("Failed to Connect!");
}
?>