<?php
$servername = "localhost"; // Nama server basis data
$username = "root"; // Username untuk koneksi ke basis data
$password = ""; // Password untuk koneksi ke basis data
$dbname = "guestbook_db"; // Nama basis data

try {
    // Membuat koneksi baru ke basis data menggunakan PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mengatur mode error untuk PDO
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); // Menampilkan pesan error jika koneksi gagal
}
?>
