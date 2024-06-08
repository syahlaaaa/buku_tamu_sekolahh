<?php
session_start(); // Memulai sesi
include 'config.php'; // Menghubungkan ke basis data

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Memeriksa apakah form telah di-submit
    $username = $_POST['username']; // Mengambil input username dari form
    $password = $_POST['password']; // Mengambil input password dari form

    // Menyiapkan statement SQL untuk mengambil data admin berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
    $stmt->bindParam(':username', $username); // Mengikat parameter `username`
    $stmt->execute(); // Menjalankan statement SQL
    $admin = $stmt->fetch(); // Mengambil hasil query

    // Memeriksa apakah username ada dan password benar
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['id']; // Menyimpan ID admin di sesi
        header("Location: admin_dashboard.php"); // Mengarahkan ke dashboard admin
    } else {
        $error = "Invalid username or password"; // Menampilkan pesan kesalahan
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1 class="text-center">Admin Login</h1>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?> <!-- Menampilkan pesan kesalahan jika ada -->
                <form method="post" action="">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Menyertakan Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
