<?php 


session_start();

require "dbh.inc.php";

if(isset($_POST['signup-submit'])){
    
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $passwordhash = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
    //echo $password;
    

    $s = "SELECT * FROM users WHERE uidUsers = '$username'";

    $result = mysqli_query($conn, $s);

    $num = mysqli_num_rows($result);

    if($num == 1) {
        echo "username taken";

    } else {
        $reg = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES ('$username', '$email', '$passwordhash')";
        mysqli_query($conn, $reg);
        header ("Location: ../index.php");
    }
}







?>