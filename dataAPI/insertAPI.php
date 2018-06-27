<?php
require_once('mysql_connect.php');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
print_r($_POST);

$insertName = $_GET['app_name'];
$insertID = $_GET['id'];
$inserttype = $_GET['genre'];
$insertPrice = $_GET['price'];

$query = "INSERT INTO `test`(`app_name`, `id`, `genre`, `price`) VALUES ('$insertName', '$insertID', '$inserttype', '$insertPrice')";

$result = null;
//send the query to the database, store the result of the query into $result
$result = mysqli_query($conn, $query);

if(empty($result)) {
    $output['error'][] = 'DB error';
}else {

    if(mysqli_affected_rows($conn)>0) {

        $output['success'] = true;
        $insertnewID = mysqli_insert_id($conn);
        $output['insertID'] = $insertnewID;
        echo "insert success";
    } else {
        $output['error'][] = 'no data';
    }
}

//return back to server.php
?>