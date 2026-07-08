<?php
session_start();
include 'config/db.php';

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['admin'] = $username;
        $_SESSION['login_time'] = time();

        header("Location: dashboard.php");
        exit();

    }else{

        $error = "Invalid Username or Password!";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Hub | Admin Login</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>


<body class="login-body">


<div class="login-box">


<div class="login-logo">

<i class="fas fa-graduation-cap"></i>

<h2>Student Hub</h2>

<p>Admin Panel Login</p>

</div>



<?php if(isset($error)){ ?>

<p class="error">
<i class="fas fa-circle-exclamation"></i>
<?php echo $error; ?>
</p>

<?php } ?>



<form method="POST">


<div class="input-box">

<i class="fas fa-user"></i>

<input 
type="text"
name="username"
placeholder="Enter Username"
required>

</div>



<div class="input-box">

<i class="fas fa-lock"></i>

<input 
type="password"
name="password"
placeholder="Enter Password"
required>

</div>



<button type="submit" name="login">

<i class="fas fa-right-to-bracket"></i>
Login

</button>


</form>


<p class="copyright">

© <?php echo date("Y"); ?> Student Management System

</p>


</div>


</body>

</html>