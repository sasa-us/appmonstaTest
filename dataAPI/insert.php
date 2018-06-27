<?php
require_once('mysql_connect.php');

if(empty($_GET['app_name'])){
	$output['errors'][] = 'No app_name given.';
};
if(empty($_GET['id'])) {
	$output['errors'][] = 'No id given.';
};
if(empty($_GET['genre'])) {
	$output['errors'][] = 'No genre given.';
};


$jsonString = file_get_contents('data.json');
//var_dump($jsonString);

//converting json object to php associative array
$data = json_decode($jsonString, true);
//ar_dump ($data); 
//echo $data['app_name'].'<br>'.$data['id'].'<br>'.$data['genre'].'<br>'.$data['price'];
$insertName = $data['app_name'];
$insertID = $data['id'];
$inserttype = $data['genre'];
$insertPrice = $data['price'];
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