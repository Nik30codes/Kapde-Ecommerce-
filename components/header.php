<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Kapdè </title>

<link rel="stylesheet" href="/ecommerce/assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

<nav class="navbar">

<div class="logo">
Kapdè 
</div>

<ul class="nav-menu">
<li><a href="/ecommerce/index.php?category=men">Men</a></li>
<li><a href="/ecommerce/index.php?category=women">Women</a></li>
<li><a href="#">New</a></li>
<li><a href="#">Sale</a></li>

<?php if(isset($_SESSION['user_email']) && $_SESSION['user_email']=="nikunjbhalla30@gmail.com"){ ?>
<li><a href="/ecommerce/admin/dashboard.php">Admin</a></li>
<?php } ?>

</ul>

<div class="search-box">
<input 
type="text" 
id="search-input" 
placeholder="Search for products..."
>
</div>

<div class="nav-icons">

<a href="/ecommerce/pages/wishlist.php">Wishlist</a>
<a href="/ecommerce/pages/cart.php">Cart</a>

<?php if(isset($_SESSION['user_id'])){ ?>

<span>Hello <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
<a href="/ecommerce/pages/logout.php">Logout</a>

<?php } else { ?>

<a href="/ecommerce/pages/login.php">Login</a>
<a href="/ecommerce/pages/register.php">Register</a>

<?php } ?>

</div>

</nav>