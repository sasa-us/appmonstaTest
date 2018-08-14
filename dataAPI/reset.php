<?php
require_once('../mysql_connect.php');

// if(!isset($_GET['email']) && !isset($_GET['token'])) {
//     redirect('index');
// }
$email = $_GET['email'];
$token = $_GET['token'];

// print_r($_GET['token']);
// exit();
$query = "SELECT `username`,  `email`, `token` 
            FROM `users` 
            WHERE `token`=?
            ";
        
// $email = 'sharryluh@gmail.com';
// $token = '7dc4b8a3d88d631c78835d9f7e1ae74756ccc7d19171c05b2443c16b70ef934316bef1275e4fcbe00ba46b2fb43ae3bfcd85';
if($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $username, $email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // echo $username;

    // if($_GET['token'] !== $token || $_GET['email'] !== $email) {
    //     redirect('index');
    // }

    if(isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        // echo "they both set";
        if($_POST['password'] === $_POST['confirmPassword']) {
            
            $password = $_POST['password'];
            //hash psw
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
            $updatequery = "UPDATE `users` SET `token`='', `password`='{$hashedPassword}' WHERE `email`=? ";
            
            if($stmt = mysqli_prepare($conn, $updatequery)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) >=1 ) {
                   echo "affected";
                   //if it reset password and update db with new pwd and token.
                   //redirect to login page
                   //redirect('http://localhost:8000/scratchpad/appmonstaAPITest');
                   header("Location: http://localhost:8000/scratchpad/appmonstaAPITest");
                }
                mysqli_stmt_close($stmt);

            } 
        
        
        }
    }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>appmonstaTest</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
        crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">


                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>