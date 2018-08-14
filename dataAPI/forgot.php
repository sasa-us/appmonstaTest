<?php
require '../vendor/autoload.php';
require './classes/Config.php';
require_once('../mysql_connect.php');


$conn =mysqli_connect("localhost", "root", "root", "testgame");

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function confirmQuery($result) {  
    global $conn;
    if(!$result ) { 
          die("QUERY FAILED ." . mysqli_error($conn));    
      }
}

function email_exists($email){
    global $conn;
    $query = "SELECT `email` FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

if(ifItIsMethod('POST')) {
    global $conn;
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
// echo "email is ";
// echo $email;
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if(email_exists($email)) {
            // echo "it has";
            $stmt = mysqli_prepare($conn, "UPDATE `users` SET `token`='{$token}' WHERE `email`= ?");
            // if($stmt = mysqli_prepare($conn, "UPDATE `users` SET `token`='{$token}' WHERE `email`= ?")){
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


                 // config phpmailer  ============================================================
                   //check require is work for phpmailer. put below two line on top and comment all other php file. 
                   //need install phpmailer5.2 other wise class PHP mailer not found
                $mail = new PHPMailer();
                //echo get_class($mail);

                //copy from php mailer github, NEED change value
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = Config::SMTP_HOST;  // Specify main and backup SMTP servers
                $mail->Username = Config::SMTP_USER;                 // SMTP username
                $mail->Password = Config::SMTP_PASSWORD;                           // SMTP password
                $mail->Port = Config::SMTP_PORT;  
                $mail->SMTPSecure = 'tls';   
                $mail->SMTPAuth = true;
                $mail->isHTML(true); 
                $mail->CharSet = 'UTF-8';  //used to let other language work  
                
                //recipients  the registered user email will be receiver
                $mail->setFrom('bb', 'sharry');
                $mail->addAddress($email);//the submitted email add.
                //so it will automatically sent sth to this email addr

                $mail->Subject = 'test email';
                $mail->Body = '<p>Please click link to reset password.
                <a href="http://localhost:8000/scratchpad/appmonstaAPITest/dataAPI/reset.php?email='.$email.'&token='.$token.' ">http://localhost:8000/scratchpad/appmonstaAPITest/dataAPI/reset.php?email='.$email.'&token='.$token.'</a>
                
                </p>';
                //$mail->Body = '<h1>测试中文</h1>';

                if($mail->send()) {
                    // echo "email sent !!!";
                    $emailSent = true;
                } else {
                    echo 'not sent email !!!';
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

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
    <?php if(!isset( $emailSent )): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
<?php else: ?>
<h2>Please check your email</h2>
<?php endIf; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

</div> 
</body>
</html>