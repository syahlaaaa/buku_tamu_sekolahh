<?php
include 'config.php'; // Menghubungkan ke basis data

$id = $_GET['id']; // Mendapatkan ID tamu dari URL

// Menyiapkan statement SQL untuk menghapus data tamu berdasarkan ID
$stmt = $conn->prepare("DELETE FROM guests WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute(); // Menghapus data tamu berdasarkan ID

header("Location: admin_dashboard.php"); // Mengarahkan ke dashboard admin
?>
