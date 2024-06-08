<?php
session_start(); // Memulai sesi
include 'config.php'; // Menghubungkan ke basis data

if (!isset($_SESSION['admin'])) { // Memeriksa apakah admin sudah login
    header("Location: login.php");
    exit;
}

// Menyiapkan statement SQL untuk mengambil semua data tamu
$stmt = $conn->prepare("SELECT * FROM guests");
$stmt->execute();
$guests = $stmt->fetchAll(); // Mengambil semua data tamu
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Admin Dashboard</h1>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a> <!-- Tautan logout -->
        <h2>Guest List</h2>
        <a href="guest_form.php" class="btn btn-success mb-3">Add New Guest</a> <!-- Tautan untuk menambah tamu baru -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Origin</th>
                    <th>Occupation</th>
                    <th>Purpose</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($guests as $guest): ?>
                <tr>
                    <td><?php echo $guest['id']; ?></td>
                    <td><?php echo $guest['name']; ?></td>
                    <td><?php echo $guest['email']; ?></td>
                    <td><?php echo $guest['phone']; ?></td>
                    <td><?php echo $guest['origin']; ?></td>
                    <td><?php echo $guest['occupation']; ?></td>
                    <td><?php echo $guest['purpose']; ?></td>
                    <td>
                        <a href="edit_guest.php?id=<?php echo $guest['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_guest.php?id=<?php echo $guest['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Menyertakan Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
