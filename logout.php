<?php
session_start(); // Memulai sesi
session_destroy(); // Menghancurkan sesi
header("Location: login.php"); // Mengarahkan ke halaman login
exit;
?>
