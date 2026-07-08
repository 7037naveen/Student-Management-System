<?php
include 'config/db.php';

$query = "SELECT * FROM students";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>🎓 Student List</h1>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result)){

?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
        <a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="delete_student.php?id=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>

<?php
}

?>

</table>

</body>
</html>