<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query mencari user
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['admin'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <div class="login-wrapper">
        <div class="login-left">
            <div class="branding-content">
                <img src="logo.png" alt="Logo" class="logo-akademik">
                <h1>AKADEMIK</h1>
                <p>Sistem Informasi Akademik</p>
            </div>
            <div class="footer-copy">© 2026 AKADEMIK</div>
        </div>

        <div class="login-right">
            <div class="login-form-container">
                <h2 style="text-align: center;">Admin Login</h2>
                <p class="text-muted">Silakan masuk untuk melanjutkan ke Sistem Informasi Akademik</p>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-login-submit w-100">Log In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>