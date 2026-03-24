<?php
session_start();

if(!isset($_SESSION['user_email']) || $_SESSION['user_email'] != "nikunjbhalla30@gmail.com"){
header("Location: ../index.php");
exit();
}

include "../config/db.php";

$id = intval($_GET['id']);

$query = "DELETE FROM products WHERE id=$id";

mysqli_query($conn,$query);

header("Location: dashboard.php");
exit();
?>