<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Profile</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main">

<?php include 'includes/navbar.php'; ?>

<div class="welcome">

<h1><i class="fas fa-user-circle"></i> Admin Profile</h1>

<br>

<table style="width:100%;">

<tr>
<td><b>Username</b></td>
<td><?php echo $_SESSION['admin']; ?></td>
</tr>

<tr>
<td><b>Login Time</b></td>
<td><?php echo date("d M Y h:i A", $_SESSION['login_time']); ?></td>
</tr>

<tr>
<td><b>Current Date</b></td>
<td><?php echo date("d M Y"); ?></td>
</tr>

<tr>
<td><b>Status</b></td>
<td style="color:green;">● Online</td>
</tr>

</table>

<br><br>

<a href="change_password.php" class="btn btn-blue">

<i class="fas fa-key"></i>

Change Password

</a>

</div>

<?php include 'includes/footer.php'; ?>

</div>

</body>

</html>