<?php
session_start();
if ($_SESSION['role'] != 'user') header("Location: index.php");
$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
$user_id = $_SESSION['user_id'];
$user = $mysqli->query("SELECT * FROM mahasiswa WHERE id='$user_id'")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $beasiswa = $_POST['beasiswa'];
    $no_hp = $user['phone'];
    $semester = $_POST['semester']; // Ambil semester dari form
    $berkas = $_FILES['berkas']['name'];
    $upload_dir = 'uploads/';

    if (move_uploaded_file($_FILES['berkas']['tmp_name'], $upload_dir . $berkas)) {
        $mysqli->query("INSERT INTO pendaftaran (mahasiswa_id, beasiswa, berkas, phone, semester) VALUES ('$user_id', '$beasiswa', '$berkas', '$no_hp', '$semester')");
        header("Location: hasil.php"); // Arahkan ke halaman hasil setelah pendaftaran berhasil
        exit();
    } else {
        echo "Gagal mengunggah berkas.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Form Pendaftaran Beasiswa</h3>
        <form method="POST" action="daftar_beasiswa.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="<?= $user['nama'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= $user['email'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">IPK</label>
                <input type="text" class="form-control" value="<?= $user['ipk'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" class="form-control" name="phone" value="<?= $user['phone'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Semester</label>
                <select class="form-select" name="semester" required>
                    <option value="" selected>Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Beasiswa</label>
                <select class="form-select" name="beasiswa" id="beasiswa" required>
                    <option value="" selected>Pilih Jenis Beasiswa</option>
                    <option value="akademik">Beasiswa Akademik</option>
                    <option value="non-akademik">Beasiswa Non-Akademik</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Berkas</label>
                <input type="file" class="form-control" name="berkas" id="berkas" accept=".pdf,.jpg,.zip" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submit">Daftar</button>
        </form>
    </div>

    <script>
        window.onload = function() {
            const ipk = <?= $user['ipk'] ?>; // Ambil nilai IPK dari PHP
            const beasiswaSelect = document.getElementById("beasiswa");
            const berkasInput = document.getElementById("berkas");
            const submitButton = document.getElementById("submit");

            if (ipk < 3) {
                beasiswaSelect.disabled = true;
                berkasInput.disabled = true;
                submitButton.disabled = true;
            } else {
                beasiswaSelect.focus(); // Fokuskan kursor pada dropdown pilihan beasiswa
            }
        };
    </script>
</body>
</html>
