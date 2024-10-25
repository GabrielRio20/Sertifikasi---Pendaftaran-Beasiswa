<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: index.php");
$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $ipk = $_POST['ipk'];
    $mysqli->query("INSERT INTO mahasiswa (nama, email, ipk) VALUES ('$nama', '$email', '$ipk')");
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Tambah Mahasiswa</h3>
        <form method="POST" action="add_mahasiswa.php">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">IPK</label>
                <input type="text" class="form-control" name="ipk" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>
