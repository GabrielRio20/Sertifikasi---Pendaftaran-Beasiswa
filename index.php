<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "beasiswa_db");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == "admin@gmail.com" && $password == "admin") {
        $_SESSION['role'] = 'admin';
        header("Location: admin_dashboard.php");
    } else {
        $result = $mysqli->query("SELECT * FROM mahasiswa WHERE email='$email' AND password='$password'");
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['role'] = 'user';
            $_SESSION['user_id'] = $user['id'];
            header("Location: user_dashboard.php");
        } else {
            echo "Login gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 mx-auto" style="width: 300px;">
            <h3 class="text-center">Login</h3>
            <form method="POST" action="index.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
