<?php
session_start();
if ($_SESSION['role'] != 'user') header("Location: index.php");
$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
$user_id = $_SESSION['user_id'];
$user = $mysqli->query("SELECT * FROM mahasiswa WHERE id='$user_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Halo, <?= $user['nama'] ?></h2>
        <a href="daftar_beasiswa.php" class="btn btn-primary mt-3">Daftar Beasiswa</a>
    </div>
</body>
</html>
