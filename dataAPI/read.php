<?php
session_start();
//print_r($_SESSION['userID']);
require_once('mysql_connect.php');

$query = "SELECT * FROM `test` ";
$result = null;
$result = mysqli_query($conn, $query);

if(empty($result)) {
    $output['error'][] = mysqli_error($conn);
} else {
    if(mysqli_num_rows($result) > 0){
        $output['success'] = true;
        while($row=mysqli_fetch_assoc($result)) {
            $output['data'][] = $row;
        }
    } 
    else {
        $output['error'][] = 'no data available'; 
    }
}

?>