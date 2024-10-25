<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: index.php");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$user_id = $_SESSION['user_id'];

$result = $mysqli->query("SELECT * FROM pendaftaran WHERE mahasiswa_id='$user_id' ORDER BY id DESC LIMIT 1");
$pendaftaran = $result->fetch_assoc();

if ($pendaftaran) {
    $mahasiswa = $mysqli->query("SELECT * FROM mahasiswa WHERE id='$user_id'")->fetch_assoc();

    $nama = $mahasiswa['nama'] ?? 'Nama tidak ditemukan';
    $email = $mahasiswa['email'] ?? 'Email tidak ditemukan';
    $no_hp = $pendaftaran['phone'] ?? 'Nomor HP tidak ditemukan';
    $semester = $pendaftaran['semester'] ?? 'Semester tidak ditemukan';
    $ipk = $mahasiswa['ipk'] ?? 'IPK tidak ditemukan';
    $beasiswa = $pendaftaran['beasiswa'] ?? 'Beasiswa tidak ditemukan';
    $file = $pendaftaran['berkas'] ?? '';
    $status_ajuan = "Dalam Proses"; 
} else {
    echo "Data pendaftaran tidak ditemukan.";
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy(); 
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Hasil Pendaftaran Beasiswa</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Hasil Pendaftaran Beasiswa</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                <p><strong>Nomor HP:</strong> <?= htmlspecialchars($no_hp) ?></p>
                <p><strong>Semester:</strong> <?= htmlspecialchars($semester) ?></p>
                <p><strong>IPK Terakhir:</strong> <?= htmlspecialchars($ipk) ?></p>
                <p><strong>Pilihan Beasiswa:</strong> <?= htmlspecialchars($beasiswa) ?></p>
                <p><strong>Status Ajuan:</strong> <?= htmlspecialchars($status_ajuan) ?></p>
                <?php if ($file): ?>
                    <p><strong>File:</strong> <a href="uploads/<?= htmlspecialchars($file) ?>" target="_blank">Lihat Berkas</a></p>
                <?php else: ?>
                    <p>Tidak ada berkas yang diunggah.</p>
                <?php endif; ?>
            </div>
        </div>

        <form method="POST" action="">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
