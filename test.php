<?php 
require "includes/dbh.inc.php";





$sql = "SELECT * FROM topics";
$result = mysqli_query($conn, $sql);
$datas = array();
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }
    
}



echo "<pre>" , print_r($datas, true), "</pre";









?>