<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: index.php");
$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
$mahasiswa = $mysqli->query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="add_mahasiswa.php">Tambah Mahasiswa</a>
                <a class="nav-link" href="pendaftar_beasiswa.php">Pendaftar Beasiswa</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Daftar Mahasiswa</h3>
        <table class="table table-striped">
            <thead>
                <tr><th>Nama</th><th>Email</th><th>IPK</th></tr>
            </thead>
            <tbody>
                <?php while ($row = $mahasiswa->fetch_assoc()) { ?>
                <tr><td><?= $row['nama'] ?></td><td><?= $row['email'] ?></td><td><?= $row['ipk'] ?></td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
