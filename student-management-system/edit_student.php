<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM students WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $course = mysqli_real_escape_string($conn,$_POST['course']);

    mysqli_query($conn,"UPDATE students SET
        name='$name',
        email='$email',
        phone='$phone',
        course='$course'
        WHERE id='$id'");

    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="main">

<h2>Edit Student</h2>

<form method="POST">

<input type="text" name="name" value="<?php echo $row['name']; ?>" required>

<input type="email" name="email" value="<?php echo $row['email']; ?>" required>

<input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

<input type="text" name="course" value="<?php echo $row['course']; ?>" required>

<button class="btn btn-green" name="update">
Update Student
</button>

</form>

</div>

</body>
</html>