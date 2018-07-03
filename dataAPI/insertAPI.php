<?php
require_once('mysql_connect.php');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


if(empty($_GET['app_name'])){
	$output['errors'][] = 'No app_name given.';
};
if(empty($_GET['id'])) {
	$output['errors'][] = 'No id given.';
};
if(empty($_GET['genre'])) {
	$output['errors'][] = 'No genre given.';
};

if(empty($_GET['publisher_id'])) {
	$output['errors'][] = 'No publisher_id given.';
};

// if(empty($_GET['publisher_address'])) {
// 	$output['errors'][] = 'No publisher_address given.';
// };


//print_r($_GET);

$insertName = $_GET['app_name'];
$insertID = $_GET['id'];
$inserttype = $_GET['genre'];
$insertPrice = $_GET['price'];

$publisher_id = $_GET['publisher_id'];
$publisher_name = $_GET['publisher_name'];
$publisher_email = $_GET['publisher_email'];
$publisher_address = $_GET['publisher_address'];
$publisher_url = $_GET['publisher_url'];
$release_date = $_GET['release_date'];
$game_app_id = $_GET['game_app_id'];
$description = $_GET['description'];
$translated_description = $_GET['translated_description'];

$icon_url = $_GET['icon_url'];
$video_urls = $_GET['video_urls'];
$screenshot_urls = $_GET['screenshot_urls'];
$whats_new = $_GET['whats_new'];

$bundle_id = $_GET['bundle_id'];
$price = $_GET['price'];
$status = $_GET['status'];

$result = null;

//DELETE FROM tablename;  clear table info
//$query .= "INSERT INTO 
//insert ignore
//insert into ,, count=(select countid from  )

$query = "INSERT INTO 
                `test`(`app_name`, `id`, `genre`, `price`) 
           VALUES 
                ('$insertName', '$insertID', '$inserttype', '$insertPrice')";
checkInsert($conn, $query);


$querypublisher = "INSERT INTO
               `publisher` (`publisher_id`, `publisher_name`, `publisher_email`, `publisher_address`, `publisher_url`, `release_date`, `game_app_id`) 
             VALUES 
               ('$publisher_id', '$publisher_name' , '$publisher_email', '$publisher_address', '$publisher_url', '$release_date', '$game_app_id' )";
checkInsert($conn, $querypublisher);

// $insert_description = "INSERT INTO 
//                         `description`( `description`,  `game_app_id`) 
//                       VALUES 
//                         ('$description','$game_app_id')";
//if delete description the table can be inserted
// $insert_description = "INSERT INTO 
//                         `description`(   `game_app_id`) 
//                       VALUES 
//                         ('$game_app_id')";
//checkInsert($conn, $insert_description);


$queryinsert_video_urls = " INSERT INTO 
                            `video_urls`(`video_urls`, `game_app_id`)
                         VALUES 
                             ('$video_urls','$game_app_id')";
checkInsert($conn, $queryinsert_video_urls);

//$videoID = mysqli_insert_id($conn);
$queryinsert_screenshot_urls = " INSERT INTO 
                                    `screenshot_urls`(`screenshot_urls`, `game_app_id`) 
                                VALUES ('$screenshot_urls','$game_app_id')";

// $insert_expand = " INSERT INTO 
//                         `expand_details`( `icon_url`, `video_urls_id`, `screenshot_urls_id`, `whats_new`, `game_app_id`) 
//                     VALUES 
//                         ('$icon_url',[value-3],[value-4],'$whats_new' ,'$game_app_id')";


// INSERT INTO tab_teacher
//    SET name_teacher = 'Dr. Smith';
// INSERT INTO tab_student 
//    SET name_student = 'Bobby Tables',
//        id_teacher_fk = LAST_INSERT_ID()

//        or
//        INSERT INTO tab_student 
//        SET name_student = 'Bobby Tables',
//            id_teacher_fk = (
//            SELECT id_teacher
//              FROM tab_teacher
//             WHERE name_teacher = 'Dr. Smith')


function checkInsert($conn, $query) {
    $result = mysqli_query($conn, $query);
    global $output;
    if ($result) {
        $output['success'] = true;
        echo "New records insert successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
// $result = mysqli_query($conn, $querypublisher);
// if ($result) {
//     $output['success'] = true;
//     echo "New records insert successfully";
// } else {
//     echo "Error: " . $query . "<br>" . mysqli_error($conn);
// }

//================================
//$result = null;

//send the query to the database, store the result of the query into $result
//$result = mysqli_query($conn, $query);
// if(empty($result)) {
//     $output['error'][] = 'DB error';
// }else {

//     if(mysqli_affected_rows($conn)>0) {

//         $output['success'] = true;
//         $insertnewID = mysqli_insert_id($conn);
//         $output['insertID'] = $insertnewID;
//         echo "insert success";
//     } else {
//         $output['error'][] = 'no data';
//     }
// }

//return back to server.php

// if (mysqli_multi_query($conn, $query)) {
//     $output['success'] = true;
//     echo "New records insert successfully";
// } else {
//     echo "Error: " . $query . "<br>" . mysqli_error($conn);
// }
?>



