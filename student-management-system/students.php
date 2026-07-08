<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include 'config/db.php';

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$start = ($page - 1) * $limit;

// Search
$where = "";

if(isset($_GET['search']) && $_GET['search']!=""){

    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $where = "WHERE
        name LIKE '%$search%'
        OR email LIKE '%$search%'
        OR phone LIKE '%$search%'
        OR course LIKE '%$search%'";
}

$totalQuery = mysqli_query($conn,"SELECT * FROM students $where");
$totalStudents = mysqli_num_rows($totalQuery);

$result = mysqli_query($conn,"
SELECT * FROM students
$where
ORDER BY id DESC
LIMIT $start,$limit
");

$totalPages = ceil($totalStudents/$limit);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>All Students</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main">

<?php include 'includes/navbar.php'; ?>

<br>

<h2>
<i class="fas fa-users"></i>
All Students (<?php echo $totalStudents; ?>)
</h2>

<br>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Student..."
value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
style="width:300px;display:inline-block;">

<button class="btn btn-blue">
<i class="fas fa-search"></i>
Search
</button>

<a href="students.php" class="btn btn-green">
Reset
</a>

<a href="export_excel.php" class="btn btn-green">
Export Excel
</a>

</form>

<br><br>

<table>

<tr>

<th>ID</th>
<th>Photo</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Course</th>
<th>Action</th>

</tr>

<?php

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<?php

if(!empty($row['photo'])){

?>

<img
src="uploads/<?php echo $row['photo']; ?>"
width="60"
height="60"
style="border-radius:50%;object-fit:cover;">

<?php

}else{

echo "No Photo";

}

?>

</td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['course']; ?></td>

<td>

<a
class="btn btn-green"
href="edit_student.php?id=<?php echo $row['id']; ?>">

Edit

</a>

<a
class="btn btn-red"
href="delete_student.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this student?')">

Delete

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" style="text-align:center;">
No Student Found
</td>

</tr>

<?php } ?>

</table>

<br>

<div style="text-align:center;">

<?php

if($totalPages>1){

for($i=1;$i<=$totalPages;$i++){

if(isset($_GET['search'])){

$link="students.php?page=$i&search=".$_GET['search'];

}else{

$link="students.php?page=$i";

}

if($page==$i){

echo "<span style='padding:10px 15px;background:#0d6efd;color:#fff;border-radius:5px;margin:3px;'>$i</span>";

}else{

echo "<a href='$link' style='padding:10px 15px;background:#eee;text-decoration:none;border-radius:5px;margin:3px;'>$i</a>";

}

}

}

?>

</div>

<?php include 'includes/footer.php'; ?>

</div>

</body>

</html>