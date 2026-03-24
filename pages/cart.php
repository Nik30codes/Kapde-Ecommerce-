<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/db.php";
include "../components/header.php";

?>

<section class="cart-page">

<h1>Your Cart</h1>

<div class="cart-container">

<?php

$total = 0;

if(isset($_SESSION['cart'])){

foreach($_SESSION['cart'] as $key => $item){

$id = $item['id'];
$size = $item['size'];
$qty = $item['qty'];

$query = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

$subtotal = $row['price'] * $qty;
$total += $subtotal;

?>

<div class="cart-item">

<img src="../assets/images/<?php echo $row['image']; ?>">

<div class="cart-info">

<h3><?php echo $row['name']; ?></h3>

<p class="cart-size">Size: <?php echo $size; ?></p>

<p class="price">₹<?php echo $row['price']; ?></p>

<div class="qty-control">

<a href="update_cart.php?id=<?php echo $key ?>&action=decrease">
<button>-</button>
</a>

<span><?php echo $qty ?></span>

<a href="update_cart.php?id=<?php echo $key ?>&action=increase">
<button>+</button>
</a>

</div>

<a href="remove_item.php?id=<?php echo $key ?>">
<button class="remove-btn">Remove</button>
</a>

</div>

</div>

<?php

}

}

?>

</div>


<div class="cart-summary">

<h2>Total: ₹<span id="cart-total"><?php echo $total; ?></span></h2>

<a href="checkout.php">
<button class="checkout-btn">Proceed to Checkout</button>
</a>

</div>

</section>

<?php include "../components/footer.php"; ?>