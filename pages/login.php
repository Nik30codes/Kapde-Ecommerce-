<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/db.php";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$query);

$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];

header("Location: ../index.php");

}else{

$error = "Invalid email or password";

}

}

?>

<?php include "../components/header.php"; ?>

<div class="auth-container">

<div class="auth-card">

<h2>Login to Kapde</h2>

<?php if(isset($error)){ ?>
<p class="auth-error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

<p class="auth-switch">
Don't have an account? 
<a href="register.php">Register</a>
</p>

</form>

</div>

</div>

<?php include "../components/footer.php"; ?>