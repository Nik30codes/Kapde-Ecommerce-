<?php
session_start();

if(!isset($_SESSION['user_email']) || $_SESSION['user_email'] != "nikunjbhalla30@gmail.com"){
header("Location: ../index.php");
exit();
}

include "../config/db.php";

if(isset($_POST['add_product'])){

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"../assets/images/".$image);

$query = "INSERT INTO products(name,price,image,description,category)
VALUES('$name','$price','$image','$description','$category')";

mysqli_query($conn,$query);

header("Location: dashboard.php");
exit();

}
?>