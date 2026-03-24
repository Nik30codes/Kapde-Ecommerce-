<?php
session_start();
include "../config/db.php";
include "../components/header.php";

$id = intval($_GET['id']);

$res = mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($res);

if(!$product){
    echo "Product not found";
    exit();
}

// wishlist check
$user = $_SESSION['user_id'] ?? 0;
$isLiked = false;

if($user){
    $check = mysqli_query($conn,"SELECT * FROM wishlist WHERE user_id=$user AND product_id=$id");
    $isLiked = mysqli_num_rows($check) > 0;
}
?>

<section class="product-page">
<div class="product-container">

<div class="product-image">
<img src="../assets/images/<?php echo $product['image']; ?>">
</div>

<div class="product-details">

<h1><?php echo $product['name']; ?></h1>
<p class="price">₹<?php echo $product['price']; ?></p>

<!-- 🔥 WISHLIST BUTTON -->
<button class="wishlist-btn" data-id="<?php echo $product['id']; ?>" style="font-size:26px;">
<?php echo $isLiked ? "❤️" : "♡"; ?>
</button>

<h4>Select Size</h4>
<div class="sizes">
<button class="size-btn">S</button>
<button class="size-btn">M</button>
<button class="size-btn">L</button>
<button class="size-btn">XL</button>
</div>

<br>

<button class="add-cart-btn" data-id="<?php echo $product['id']; ?>">
Add to Cart
</button>

</div>
</div>
</section>

<?php include "../components/footer.php"; ?>