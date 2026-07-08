<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

if(isset($_POST['save'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $course = mysqli_real_escape_string($conn,$_POST['course']);

    // Photo Upload
    $photoName = "";

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){

        $photo = $_FILES['photo']['name'];
        $temp = $_FILES['photo']['tmp_name'];

        $photoName = time()."_".$photo;

        move_uploaded_file($temp,"uploads/".$photoName);
    }

    $query = "INSERT INTO students(name,email,phone,course,photo)
              VALUES('$name','$email','$phone','$course','$photoName')";

    if(mysqli_query($conn,$query)){
        $success = "✅ Student Added Successfully!";
    }else{
        $error = "❌ ".$conn->error;
    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Student</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="sidebar">

<div class="logo">
<h2>🎓 Student Hub</h2>
</div>

<ul>

<li><a href="dashboard.php"><i class="fas fa-gauge"></i> Dashboard</a></li>

<li><a href="add_student.php"><i class="fas fa-user-plus"></i> Add Student</a></li>

<li><a href="students.php"><i class="fas fa-users"></i> Students</a></li>

<li><a href="logout.php"><i class="fas fa-right-from-bracket"></i> Logout</a></li>

</ul>

</div>

<div class="main">

<div class="nav">

<h2><i class="fas fa-user-plus"></i> Add Student</h2>

</div>

<br>

<?php if(isset($success)){ ?>

<p style="color:green;font-weight:bold;">
<?php echo $success; ?>
</p>

<?php } ?>

<?php if(isset($error)){ ?>

<p style="color:red;font-weight:bold;">
<?php echo $error; ?>
</p>

<?php } ?>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="name"
placeholder="Student Name"
required>

<input
type="email"
name="email"
placeholder="Email"
required>

<input
type="text"
name="phone"
placeholder="Phone Number"
required>

<input
type="text"
name="course"
placeholder="Course"
required>

<label><b>Student Photo</b></label>

<input
type="file"
name="photo"
accept="image/*"
required>

<br><br>

<button
class="btn btn-blue"
type="submit"
name="save">

<i class="fas fa-floppy-disk"></i>

Save Student

</button>

</form>

</div>

</body>
</html>