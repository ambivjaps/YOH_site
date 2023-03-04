<?php

function check_login($con)
{
    
    if(isset($_SESSION['login_id']))
    {
        
        $id = $_SESSION['login_id'];
        $query = "select * from register where login_id = '$id' limit 1";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        mysqli_close($con);
    }
  

    if(isset($_SESSION['user_rank']))
    {
        
        $urank = $_SESSION['user_rank'];
        $query = "select * from register where user_rank = '$urank' limit 1 ";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        mysqli_close($con);
    }

      
    if(isset($_SESSION['c_id']))
    {
        $sql = "select * from cust_profile;";
        
        $result = mysqli_query($con,$sql);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        mysqli_close($con);
    }
       
    if(isset($_SESSION['inv_db']))
    {
        $sql = "select * from inventory_db;";
        
        $result = mysqli_query($con,$sql);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        mysqli_close($con);
    }
    header("Location: Login.php");
    die;
}

function random_num($length)
{
    $text = "";
   
    for ($i=0; $i < $length; $i++){
        $text .= rand(0,9);
    }
    
    return $text;
}
