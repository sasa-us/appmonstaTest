<?php
session_start();

require_once('../mysql_connect.php');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//print_r($_POST);//  [game_id] => com.nine54.ArmyHero   [user_id] => 3
//print_r($_SESSION['userID']);
$game_id = $_POST['game_id'];
$user_id = $_POST['user_id'];
$genre = $_POST['genre'];
$platform = $_POST['platform'];
$price_value = $_POST['price_value'];


$query = "INSERT INTO 
                `user_game`(`user_id`, `game_id`, `wizard_answer_genre`, `wizard_answer_platform`, `wizard_answer_price_value`) 
           VALUES 
                ('$user_id', '$game_id', '$genre', '$platform', '$price_value')
           ON DUPLICATE KEY UPDATE `user_id`='$user_id', `game_id` = '$game_id'   
        ";
checkInsert($conn, $query);

function checkInsert($conn, $query) {
    print $query;
    $result = mysqli_query($conn, $query);
    global $output;
    if ($result) {
        $output['success'] = true;
        echo "New records insert successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>