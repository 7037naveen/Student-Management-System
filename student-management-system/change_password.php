<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$message = "";

if(isset($_POST['change'])){

    $username = $_SESSION['admin'];

    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    $check = mysqli_query($conn,
    "SELECT * FROM admin WHERE username='$username' AND password='$old'");

    if(mysqli_num_rows($check) > 0){

        mysqli_query($conn,
        "UPDATE admin SET password='$new' WHERE username='$username'");

        $message = "<p style='color:green;'>Password Changed Successfully.</p>";

    }else{

        $message = "<p style='color:red;'>Old Password is Incorrect.</p>";

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Change Password</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main">

<?php include 'includes/navbar.php'; ?>

<div class="welcome">

<h2><i class="fas fa-key"></i> Change Password</h2>

<br>

<?php echo $message; ?>

<form method="POST">

<input
type="password"
name="old_password"
placeholder="Old Password"
required>

<input
type="password"
name="new_password"
placeholder="New Password"
required>

<button
class="btn btn-blue"
name="change">

<i class="fas fa-save"></i>

Update Password

</button>

</form>

</div>

<?php include 'includes/footer.php'; ?>

</div>

</body>

</html>