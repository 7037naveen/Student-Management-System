<?php
include 'config/db.php';

$search = "";

if(isset($_POST['search'])){
    $search = $_POST['name'];

    $query = "SELECT * FROM students 
              WHERE name LIKE '%$search%'";

    $result = mysqli_query($conn,$query);
}
else{
    $query = "SELECT * FROM students";
    $result = mysqli_query($conn,$query);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Search Student</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>🔍 Search Student</h1>

<div class="container">

<form method="POST">

<input type="text" name="name" placeholder="Enter Student Name">

<button name="search">Search</button>

</form>

<br>

<table border="1">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Course</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result)){

?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['course']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>