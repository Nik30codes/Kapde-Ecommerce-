<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_GET['id'])){
header("Location: cart.php");
exit();
}

$key = $_GET['id'];

if(isset($_SESSION['cart'][$key])){
unset($_SESSION['cart'][$key]);
}

header("Location: cart.php");
exit();

?>