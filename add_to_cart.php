<?php

include('config.php');

$userId = $_GET['u_id'];
$prodID = $_GET['p_id'];
$qty =1;

$insertCart = "INSERT INTO cart(c_p_id, c_u_id, c_quantity) VALUES (?, ?, ?)";
$insertCart = $conn->prepare($insertCart);
$insertCart->execute(array($prodID, $userId, $qty));

if($insertCart){
    echo '<script>alert("Item Added to Cart"); window.location.href = "cart.php";</script>';
}else{
    echo '<script>alert("Error While Proccesing"); window.location.href = "index.php";</script>';
}