<?php

session_start();

require "dbh.inc.php";


if(isset($_POST['login-submit'])){
    
    $username = $_POST['uid'];
    //$email = $_POST['mailuid'];
    $password = $_POST['pwd'];
    $passwordhash = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
    

    $s = "SELECT * FROM users WHERE uidUsers = '$username'";
    $conn;
    $result = mysqli_query($conn, $s);
    $data_array = array();
    if(empty($conditions)){
        while($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
    }  
    
    }
    $hasharray = $data_array[0];
    //dd($hasharray);
    
    //dd($data_array);
    
    if(password_verify($password, $hasharray['pwdUsers'])){
        $_SESSION['uid'] = $username;
        header("Location: ../TatyDashboard.php");
        exit();
    } else {
        
        header("Location: ../Tatylogin.php");
        exit();
    }

        
    /*$result = mysqli_query($conn, $s);
    
    $num = mysqli_num_rows($result);
    echo $password;
    if($num == 1) {
        if(password_verify($password, $passwordhash)){
            echo "yes";
        }
    }*/
    

    /*if($num == 1) {
        $_SESSION['uid'] = $username;
        header("Location: ../TatyDashboard.php");
        //echo $num;
    } else {
        header("Location: ../Tatylogin.php");
        //echo $num;
    }*/
    
}


?>