<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM siswa WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $nilai = $_POST['nilai'];

    $sql = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas', nilai='$nilai' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?pesan=update_berhasil");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #eff6ff; }
        .card { border-radius: 15px; border: none; }
        .btn-update { background-color: #60a5fa; color: white; }
    </style>
</head>
<body class="py-5 edit-page">
    <div class="container">
        <div class="card card-aesthetic mx-auto p-4 shadow-lg" style="max-width: 500px;">
            <h4 class="text-center mb-4 fw-bold">Edit Data Siswa</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small text-muted">NIS</label>
                    <input type="text" name="nis" class="form-control" value="<?= $data['nis']; ?>" required>
                </div>
                <div class="mb-3">
                        <label class="form-label small text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Kelas</label>
                        <input type="text" name="kelas" class="form-control" value="<?= $data['kelas']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nilai</label>
                        <input type="number" name="nilai" class="form-control" value="<?= $data['nilai']; ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-update w-100">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-link w-100 mt-2 text-decoration-none text-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>