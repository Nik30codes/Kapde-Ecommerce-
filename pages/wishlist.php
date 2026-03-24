<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../config/db.php";
include "../components/header.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user = intval($_SESSION['user_id']);

$query = "
SELECT products.* 
FROM wishlist 
JOIN products 
ON wishlist.product_id = products.id
WHERE wishlist.user_id=$user
";

$result = mysqli_query($conn,$query);

?>

<section class="products">

<h1 style="padding:40px;">My Wishlist</h1>

<?php if(mysqli_num_rows($result)==0){ ?>

<p style="padding:40px;">Your wishlist is empty.</p>

<?php } ?>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="product-card">

<img src="../assets/images/<?php echo htmlspecialchars($row['image']); ?>">

<div class="product-info">

<h4>
<a href="product.php?id=<?php echo $row['id']; ?>">
<?php echo htmlspecialchars($row['name']); ?>
</a>
</h4>

<p class="price">₹<?php echo $row['price']; ?></p>

<a href="add_to_cart.php?id=<?php echo $row['id']; ?>">
<button>Add to Cart</button>
</a>

</div>

</div>

<?php } ?>

</section>

<?php include "../components/footer.php"; ?>