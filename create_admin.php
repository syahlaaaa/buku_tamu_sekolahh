<?php
include 'config.php'; // Menghubungkan ke basis data

$username = "admin"; // Username admin yang akan dibuat
$password = "admin123"; // Password admin yang akan dibuat

// Hash password sebelum menyimpannya ke basis data
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // Menyiapkan statement SQL untuk menyisipkan data admin ke tabel `admins`
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username); // Mengikat parameter `username`
    $stmt->bindParam(':password', $hashed_password); // Mengikat parameter `password`
    $stmt->execute(); // Menjalankan statement SQL
    echo "Admin created successfully."; // Menampilkan pesan berhasil
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // Menampilkan pesan error jika terjadi kesalahan
}
?>
