<?php
session_start();
require_once('../mysql_connect.php');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);

$password = mysqli_real_escape_string($conn, $password);
$hashFormat = "$2y$10$";
$salt = "whyyoulookatmypassword";
$hash_and_salt = $hashFormat . $salt;
$password = crypt($password, $hash_and_salt);

$query = "INSERT INTO 
                `users`(`username`, `email`, `password`) 
           VALUES 
                ('$username', '$email', '$password')";
checkInsert($conn, $query);


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





?>