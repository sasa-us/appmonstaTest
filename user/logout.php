<?php
session_start();

// 
// print_r($_SESSION);  ---> [userID] => 3  [username] => sa  [valid] => 1
unset($_SESSION['userID']);
unset($_SESSION['username']);
unset($_SESSION['valid']);
session_destroy();
session_commit();

$output = [
    'success' => true
];

$output_string = json_encode($output);
print($output_string);
?>