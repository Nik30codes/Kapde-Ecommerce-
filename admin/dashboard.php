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

$stmt = $conn->prepare("INSERT INTO products(name,price,image,description,category) VALUES(?,?,?,?,?)");
$stmt->bind_param("sdsss",$name,$price,$image,$description,$category);
$stmt->execute();

header("Location: dashboard.php");
exit();

}

include "../components/header.php";
?>

<section class="admin-form">

<h1>Add Product</h1>

<form method="POST" enctype="multipart/form-data">

<label>Product Name</label>
<input type="text" name="name" required>

<label>Price</label>
<input type="number" name="price" required>

<label>Category</label>
<select name="category">
<option value="men">Men</option>
<option value="women">Women</option>
<option value="shoes">Shoes</option>
</select>

<label>Description</label>
<textarea name="description"></textarea>

<label>Product Image</label>
<input type="file" name="image" required>

<button name="add_product">Add Product</button>

</form>
<h2 style="margin-top:40px;">All Products</h2>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Image</th>
<th>Category</th>
<th>Action</th>
</tr>

<?php

$query = "SELECT * FROM products";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['price']; ?></td>

<td>
<img src="../assets/images/<?php echo $row['image']; ?>" width="60">
</td>

<td><?php echo $row['category']; ?></td>

<td>
<a href="delete_product.php?id=<?php echo $row['id']; ?>" 
onclick="return confirm('Delete this product?')">
<button style="background:red;color:white;border:none;padding:6px 10px;">
Delete
</button>
</a>
</td>

</tr>

<?php } ?>

</table>

</section>

<?php include "../components/footer.php"; ?>