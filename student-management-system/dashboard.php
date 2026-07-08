<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (time() - $_SESSION['login_time'] > 900) {
    session_destroy();
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$totalStudents = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));
$recentStudents = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC LIMIT 5");

// Graph Data
$courseQuery = mysqli_query($conn, "SELECT course, COUNT(*) as total FROM students GROUP BY course");

$courseNames = [];
$courseTotals = [];

while($graph = mysqli_fetch_assoc($courseQuery)){
    $courseNames[] = $graph['course'];
    $courseTotals[] = $graph['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main">

<?php include 'includes/navbar.php'; ?>

<div class="welcome">

<h1>🎓 Student Management System</h1>

<p>Welcome to your Admin Dashboard.</p>

</div>

<div class="cards">

<div class="card">
<h2><i class="fas fa-users"></i> <?php echo $totalStudents; ?></h2>
<p>Total Students</p>
</div>

<div class="card">
<h2><i class="fas fa-book"></i> 10</h2>
<p>Total Courses</p>
</div>

<div class="card">
<h2><i class="fas fa-user-shield"></i> 1</h2>
<p>Total Admin</p>
</div>

<div class="card">
<h2><i class="fas fa-calendar"></i> <?php echo date("d"); ?></h2>
<p><?php echo date("M Y"); ?></p>
</div>

</div>

<br><br>

<div class="chart-box">

<h2>📊 Students By Course</h2>

<canvas id="courseChart"></canvas>

</div>

<br><br>

<h2>Recent Students</h2>

<table>

<tr>
<th>ID</th>
<th>Photo</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Course</th>
</tr>

<?php while($row=mysqli_fetch_assoc($recentStudents)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<?php if(!empty($row['photo'])){ ?>

<img src="uploads/<?php echo $row['photo']; ?>"
width="55"
height="55"
style="border-radius:50%;object-fit:cover;">

<?php } else { ?>

No Photo

<?php } ?>

</td>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['course']; ?></td>

</tr>

<?php } ?>

</table>

<?php include 'includes/footer.php'; ?>

</div>

<script>

const ctx = document.getElementById('courseChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($courseNames); ?>,
        datasets: [{
            label: 'Students',
            data: <?php echo json_encode($courseTotals); ?>,
            backgroundColor: [
                '#4e73df',
                '#1cc88a',
                '#36b9cc',
                '#f6c23e',
                '#e74a3b',
                '#6f42c1',
                '#fd7e14'
            ],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

</script>

</body>
</html>