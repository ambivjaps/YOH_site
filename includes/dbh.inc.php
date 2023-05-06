<?php

//$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$dbname = "yoh_db";

$dbhost = "us-cdbr-east-06.cleardb.net";
$dbuser = "b482ac2f48aa9e";
$dbpass = "18325e71";
$dbname = "heroku_c42bdf175a13f3c";

$connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    
    die("Failed to Connect!");
}
?>