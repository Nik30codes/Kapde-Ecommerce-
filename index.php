<?php include "components/header.php"; ?>

<section class="hero">
<img id="hero-img" src="assets/images/banner1.jpg">
</section>


<div class="category-filter">

<button class="cat-btn" data-cat="all">All</button>
<button class="cat-btn" data-cat="men">Men</button>
<button class="cat-btn" data-cat="women">Women</button>
<button class="cat-btn" data-cat="shoes">Shoes</button>

</div>


<?php include "config/db.php"; ?>


<h2 style="padding:40px;">Featured Products</h2>

<section class="products">

<?php

$query = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="product-card">

<button 
class="wishlist-btn"
data-id="<?php echo $row['id']; ?>"
>
❤️
</button>

<a href="pages/product.php?id=<?php echo $row['id']; ?>">
<img src="assets/images/<?php echo $row['image']; ?>">
</a>

<div class="product-info">

<h4>

<a href="pages/product.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;color:black;">
<?php echo $row['name']; ?>
</a>

</h4>

<p class="price">₹<?php echo $row['price']; ?></p>

<a href="pages/add_to_cart.php?id=<?php echo $row['id']; ?>">
<button>Add to Cart</button>
</a>

</div>

</div>

<?php } ?>

</section>



<h2 style="padding:40px;">Trending Now</h2>

<section class="products">

<?php

$query = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="product-card">

<button 
class="wishlist-btn"
data-id="<?php echo $row['id']; ?>"
>
❤️
</button>

<a href="pages/product.php?id=<?php echo $row['id']; ?>">
<img src="assets/images/<?php echo $row['image']; ?>">
</a>

<div class="product-info">

<h4>

<a href="pages/product.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;color:black;">
<?php echo $row['name']; ?>
</a>

</h4>

<p class="price">₹<?php echo $row['price']; ?></p>

<a href="pages/add_to_cart.php?id=<?php echo $row['id']; ?>">
<button>Add to Cart</button>
</a>

</div>

</div>

<?php } ?>

</section>



<h2 style="padding:40px;">All Products</h2>

<section class="products">

<?php

$query = "SELECT * FROM products";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="product-card" data-category="<?php echo $row['category']; ?>">

<button 
class="wishlist-btn"
data-id="<?php echo $row['id']; ?>"
>
❤️
</button>

<a href="pages/product.php?id=<?php echo $row['id']; ?>">
<img src="assets/images/<?php echo $row['image']; ?>">
</a>

<div class="product-info">

<h4>

<a href="pages/product.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;color:black;">
<?php echo $row['name']; ?>
</a>

</h4>

<p class="price">₹<?php echo $row['price']; ?></p>

<a href="pages/add_to_cart.php?id=<?php echo $row['id']; ?>">
<button>Add to Cart</button>
</a>

</div>

</div>

<?php } ?>

</section>


<?php include "components/footer.php"; ?>