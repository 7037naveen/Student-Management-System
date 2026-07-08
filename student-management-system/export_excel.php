<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=students.xls");

echo "ID\tName\tEmail\tPhone\tCourse\n";

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {

    echo $row['id'] . "\t";
    echo $row['name'] . "\t";
    echo $row['email'] . "\t";
    echo $row['phone'] . "\t";
    echo $row['course'] . "\n";
}
?>