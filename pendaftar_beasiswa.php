<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: index.php");
$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
$pendaftar = $mysqli->query("SELECT mahasiswa.nama, mahasiswa.email, mahasiswa.ipk, pendaftaran.beasiswa, pendaftaran.semester, pendaftaran.berkas FROM pendaftaran JOIN mahasiswa ON pendaftaran.mahasiswa_id = mahasiswa.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Pendaftar Beasiswa</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>IPK</th>
                    <th>Jenis Beasiswa</th>
                    <th>Semester</th> 
                    <th>Berkas</th>   
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $pendaftar->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['ipk'] ?></td>
                    <td><?= $row['beasiswa'] ?></td>
                    <td><?= $row['semester'] ?></td> <!-- Menampilkan Semester -->
                    <td><a href="uploads/<?= $row['berkas'] ?>" target="_blank">Lihat Berkas</a></td> 
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
