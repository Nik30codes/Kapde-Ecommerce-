<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../config/db.php";
include "../components/header.php";

// ✅ Check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// ✅ Check cart empty
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "<h2 style='padding:40px;'>Your cart is empty</h2>";
    exit();
}

$total = 0;
$products = [];

// ✅ Calculate total
foreach($_SESSION['cart'] as $item){

    $id = intval($item['id']);
    $qty = $item['qty'];
    $size = $item['size'];

    $query = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn,$query);
    $product = mysqli_fetch_assoc($result);

    if(!$product){
        continue;
    }

    $subtotal = $product['price'] * $qty;
    $total += $subtotal;

    $products[] = [
        'id' => $id,
        'name' => $product['name'],
        'price' => $product['price'],
        'qty' => $qty,
        'size' => $size
    ];
}


// ✅ Place order
if(isset($_POST['place_order'])){

    $user_id = intval($_SESSION['user_id']);

    // Insert into orders table
    mysqli_query($conn,"
    INSERT INTO orders(user_id,total_price)
    VALUES('$user_id','$total')
    ");

    $order_id = mysqli_insert_id($conn);

    // Insert order items
    foreach($products as $item){

        mysqli_query($conn,"
        INSERT INTO order_items(order_id,product_id,price,quantity,size)
        VALUES(
            '$order_id',
            '".$item['id']."',
            '".$item['price']."',
            '".$item['qty']."',
            '".$item['size']."'
        )
        ");

    }

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to orders page
    header("Location: orders.php");
    exit();
}

?>

<section style="padding:60px;">

<h1>Checkout</h1>

<table border="1" width="100%" cellpadding="10" style="margin-top:20px;">

<tr>
<th>Product</th>
<th>Size</th>
<th>Price</th>
<th>Quantity</th>
<th>Subtotal</th>
</tr>

<?php foreach($products as $item){ ?>

<tr>
<td><?php echo htmlspecialchars($item['name']); ?></td>
<td><?php echo $item['size']; ?></td>
<td>₹<?php echo $item['price']; ?></td>
<td><?php echo $item['qty']; ?></td>
<td>₹<?php echo $item['price'] * $item['qty']; ?></td>
</tr>

<?php } ?>

</table>

<h2 style="margin-top:20px;">Total: ₹<?php echo $total; ?></h2>

<form method="POST">

<button name="place_order" 
style="margin-top:20px;padding:14px 25px;background:#ff3f6c;color:white;border:none;">
Place Order
</button>

</form>

</section>

<?php include "../components/footer.php"; ?>