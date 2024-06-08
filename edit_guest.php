<?php
include 'config.php'; // Menghubungkan ke basis data

$id = $_GET['id']; // Mendapatkan ID tamu dari URL

// Menyiapkan statement SQL untuk mengambil data tamu berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM guests WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$guest = $stmt->fetch(); // Mengambil data tamu berdasarkan ID

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Memeriksa apakah form telah di-submit
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $origin = $_POST['origin'];
    $occupation = $_POST['occupation'];
    $purpose = $_POST['purpose'];

    // Menyiapkan statement SQL untuk memperbarui data tamu di tabel `guests`
    $stmt = $conn->prepare("UPDATE guests SET name = :name, email = :email, phone = :phone, origin = :origin, occupation = :occupation, purpose = :purpose WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':origin', $origin);
    $stmt->bindParam(':occupation', $occupation);
    $stmt->bindParam(':purpose', $purpose);
    $stmt->bindParam(':id', $id);
    $stmt->execute(); // Memperbarui data tamu di basis data

    header("Location: admin_dashboard.php"); // Mengarahkan ke dashboard admin
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Guest</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Guest</h1>
        <form method="post" action="">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $guest['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $guest['email']; ?>">
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $guest['phone']; ?>">
            </div>
            <div class="form-group">
                <label>Origin:</label>
                <input type="text" name="origin" class="form-control" value="<?php echo $guest['origin']; ?>" required>
            </div>
            <div class="form-group">
                <label>Occupation:</label>
                <input type="text" name="occupation" class="form-control" value="<?php echo $guest['occupation']; ?>" required>
            </div>
            <div class="form-group">
                <label>Purpose:</label>
                <textarea name="purpose" class="form-control" required><?php echo $guest['purpose']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Guest</button>
        </form>
    </div>
    <!-- Menyertakan Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
