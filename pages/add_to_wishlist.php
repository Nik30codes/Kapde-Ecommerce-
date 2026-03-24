<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    echo "login_required";
    exit();
}

$user = intval($_SESSION['user_id']);
$product = intval($_GET['id']);

// check item if already in wishlsit
$check = mysqli_query($conn,"SELECT * FROM wishlist WHERE user_id=$user AND product_id=$product");

if(mysqli_num_rows($check) > 0){
    mysqli_query($conn,"DELETE FROM wishlist WHERE user_id=$user AND product_id=$product");
    echo "removed";
}else{
    mysqli_query($conn,"INSERT INTO wishlist(user_id,product_id) VALUES($user,$product)");
    echo "added";
}