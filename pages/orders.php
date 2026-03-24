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

$user_id = intval($_SESSION['user_id']);

$query = "SELECT * FROM orders WHERE user_id=$user_id";
$result = mysqli_query($conn,$query);

?>

<section style="padding:60px;">

<h1>My Orders</h1>

<?php if(mysqli_num_rows($result)==0){ ?>

<p>No orders yet.</p>

<?php } else { ?>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>Order ID</th>
<th>Total Price</th>
<th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td>₹<?php echo $row['total_price']; ?></td>
<td><?php echo $row['created_at']; ?></td>

</tr>

<?php } ?>

</table>

<?php } ?>

</section>

<?php include "../components/footer.php"; ?>