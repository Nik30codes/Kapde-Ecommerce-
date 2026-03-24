<?php

session_start();

if(!isset($_GET['id'])){
header("Location: ../index.php");
exit();
}

$id = intval($_GET['id']);

$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : "Default";

if(!isset($_SESSION['cart'])){
$_SESSION['cart'] = [];
}

$key = $id . "-" . $size;

if(isset($_SESSION['cart'][$key])){
$_SESSION['cart'][$key]['qty'] += 1;
}else{
$_SESSION['cart'][$key] = [
'id' => $id,
'size' => $size,
'qty' => 1
];
}

header("Location: cart.php");
exit();

?>