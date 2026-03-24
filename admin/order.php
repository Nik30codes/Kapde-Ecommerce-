<?php
session_start();

if(!isset($_SESSION['user_email'])){
header("Location: ../login.php");
exit();
}

include "../config/db.php";
include "../components/header.php";

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE user_id='$user_id'";
$result = mysqli_query($conn,$query);
?>

<section style="padding:60px;">

<h1>My Orders</h1>

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

</section>

<?php include "../components/footer.php"; ?>