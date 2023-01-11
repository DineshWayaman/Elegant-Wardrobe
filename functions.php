<?php

session_start();

include('config.php');


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
            $_SESSION['success_msg'] = "Registration Successfully Completed. You can log in now.";
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