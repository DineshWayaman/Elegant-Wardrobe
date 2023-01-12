<?php

session_start();

include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);


if(isset($_POST['reguser'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $user = "User";

    $serchUser = "SELECT * FROM users WHERE u_email=?";
    $serchUserEx = $conn->prepare($serchUser);
    $serchUserEx->execute(array($email));
    $searchRow = $serchUserEx->rowCount();

    if($searchRow > 0){
        $_SESSION['error'] = "You allready Have an account.Please send an email for more details. dineshwayaman@gmail.com.";
        header('location: index.php');
    }else{


        $insertUser = "INSERT INTO users(u_name, u_email, u_pass, u_type, u_city, u_address) VALUES (?, ?, ?, ?, ?, ?)";
        $queryEx = $conn->prepare($insertUser);
        $queryEx->execute(array($name, $email, $password, $user, $city, $address));
    
        if($queryEx){

            $mail->setFrom('system@prudentialhost.com', 'From Clothing Store');
            $mail->addAddress($email, $name);
            // $mail->addAddress('ellen@example.com');
            $mail->addReplyTo('developer@pslship.com', 'Dinesh Wayaman');

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Welcome To Elegant Wardrobe';
            $mail->Body    = '<!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Document</title>
            </head>
            <body>
              <h2 style="text-align: center;">Elegant Wardrobe</h2>
              <p style="text-align: center;">Your account created sucessfully. This is the confirmation of your account activation.</p>
              <p style="text-align: center;" ><a href="">Elegant Wardrobe.</a> All right reserved.</p>
              <p style="text-align: center;">Developed By <a href="https://www.facebook.com/dwayaman">Dinesh Wayaman</a></p>
            </body>
            </html>';
            $mail->send();

            $_SESSION['success_msg'] = "Registration Successfully Completed. We have sent you an email.";
            header('location: index.php');
        }else{
            $_SESSION['error'] = "Error while proccessing. Please try again.";
             header('location: index.php');
        }

    
    }

 



}


if(isset($_POST['logUser'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $checkUser = "SELECT * FROM users WHERE u_email=? AND u_pass=?";
    $checkUserEx = $conn->prepare($checkUser);
    $checkUserEx->execute(array($email, $password));
    $checkUserRow = $checkUserEx->rowCount();
    $checkUserFetch = $checkUserEx->fetch();

    if($checkUserRow > 0){
        $_SESSION['u_id'] = $checkUserFetch['u_id'];
        $_SESSION['u_name'] = $checkUserFetch['u_name'];
        $_SESSION['u_type'] = $checkUserFetch['u_type'];

        if($checkUserFetch['u_type'] == "User"){
            $_SESSION['success_msg'] = "You are In.";
            header('location: index.php');
        }else{
            header('location: admin/index.php'); 
        }
    }else{
        $_SESSION['error'] = "Please check your email/password and Try Again.";
        header('location: index.php');
    }


}


if(isset($_GET['logout'])){
    unset($_SESSION['u_id']);
    unset($_SESSION['u_name']);
    unset($_SESSION['u_type']);

    $_SESSION['success_msg'] = "You are Logged Out.";
            header('location: index.php');
}