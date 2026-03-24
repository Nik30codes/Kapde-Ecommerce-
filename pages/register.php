<?php

include "../config/db.php";
include "../components/header.php";

if(isset($_POST['register'])){

$name = mysqli_real_escape_string($conn, trim($_POST['name']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$password_raw = $_POST['password'];

if(strlen($password_raw) < 6){
echo "Password must be at least 6 characters.";
exit();
}

$check = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$check);
if(mysqli_num_rows($result)>0){
echo "Email already registered.";
exit();
}

$password = password_hash($password_raw, PASSWORD_DEFAULT);

$query = "INSERT INTO users(name,email,password)
VALUES('$name','$email','$password')";

mysqli_query($conn,$query);

header("Location: login.php");
exit();

}
?>
<div class="auth-container">

<div class="auth-card">

<h2>Create Kapde Account</h2>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button name="register">Register</button>

<p class="auth-switch">
Already have an account? 
<a href="login.php">Login</a>
</p>

</form>

</div>

</div>