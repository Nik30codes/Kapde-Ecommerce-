<?php

session_start();

if(!isset($_GET['id']) || !isset($_GET['action'])){
header("Location: cart.php");
exit();
}

$key = $_GET['id'];
$action = $_GET['action'];

if(isset($_SESSION['cart'][$key])){

if($action === "increase"){

$_SESSION['cart'][$key]['qty']++;

}

elseif($action === "decrease"){

if($_SESSION['cart'][$key]['qty'] > 1){
$_SESSION['cart'][$key]['qty']--;
}

}

}

header("Location: cart.php");
exit();

?>