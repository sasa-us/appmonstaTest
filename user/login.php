<?php
session_start();
require_once('../mysql_connect.php');
//print_r($_POST);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    //print_r($_POST);
    $email = $_POST['email'];
    //print($email);
   // $password = sha1($_POST['password']);
   $password = $_POST['password'];

   $email = mysqli_real_escape_string($conn, $email);   
   $password = mysqli_real_escape_string($conn, $password);
   $hashFormat = "$2y$10$";
   $salt = "whyyoulookatmypassword";
   $hash_and_salt = $hashFormat . $salt;
   $password = crypt($password, $hash_and_salt);

    $query = "SELECT `email`, `password`, `id`, `username`
              FROM `users` 
              WHERE `email`='{$email}' AND `password`='{$password}'";
    $result = null;
    $output = [
        'success'=> false
    ];
    $result = mysqli_query($conn, $query);
    
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
    
            //print_r($userData);
            $output['user'] = $userData;
            $_SESSION['userID'] = $userData['id'];
           // $_SESSION['username'] = $userData['username'];
    
            $output['success'] = true;
            $_SESSION['valid'] = true;
            //print_r($_SESSION);
            //if member, will go to index page 
            //header('Location: ../index.html');
        } else {
           
            $output['error'] = 'invalide username or password';
            //header('Location: loginInput.php');
        }
    } else {
        $output['error'] = 'you are not regeistered';
    }
    
    $output_string = json_encode($output);
    print($output_string);




?>