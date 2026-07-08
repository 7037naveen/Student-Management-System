<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}


if(time() - $_SESSION['login_time'] > 900){

    session_destroy();

    header("Location: login.php");
    exit();

}


include 'config/db.php';


$count_query = "SELECT COUNT(*) as total FROM students";
$count_result = mysqli_query($conn,$count_query);
$count = mysqli_fetch_assoc($count_result);


?>


<!DOCTYPE html>
<html>

<head>

<title>Smart Student Management System</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<div class="sidebar">

<div class="logo">
🎓 <span>SMART STUDENT</span><br>
Management System
</div>

<a href="index.php">🏠 Dashboard</a>
<a href="add_student.php">➕ Add Student</a>
<a href="view_students.php">👨‍🎓 Students</a>
<a href="search_student.php">🔍 Search</a>
<a href="logout.php">🚪 Logout</a>

</div>


<div class="main">


<div class="card">

<h2>4</h2>

<p>Features ⚡</p>

</div>



<div class="card">

<h2>PHP + MySQL</h2>

<p>Technology 💻</p>

</div>


</div>




<?php

if($conn){

echo "<h3 style='color:green; text-align:center;'>Database Connected Successfully ✅</h3>";

}

?>



<div class="nav">

<a href="index.php">Home</a>

<a href="add_student.php">Add Student</a>

<a href="view_students.php">View Students</a>

<a href="search_student.php">Search</a>

<a href="logout.php">Logout 🚪</a>

</div>



</body>

</html>
</div>