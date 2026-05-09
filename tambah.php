<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

if (isset($_POST['submit'])) {
    $nis   = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $nilai = mysqli_real_escape_string($conn, $_POST['nilai']);

    $cek_duplikat = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis'");

    if (mysqli_num_rows($cek_duplikat) > 0) {
        echo "<script>
                alert('Gagal! NIS $nis sudah terdaftar. Gunakan NIS lain.');
                window.history.back();
              </script>";
    } else {
        $sql = "INSERT INTO siswa (nis, nama, kelas, nilai) VALUES ('$nis', '$nama', '$kelas', '$nilai')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Data berhasil disimpan!');
                    window.location.href='index.php';
                  </script>";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>body { background-color: #eff6ff; }</style>
</head>
<body class="py-5 tambah-page">
    <div class="container">
        <div class="card card-aesthetic mx-auto p-4 shadow-lg" style="max-width: 500px;">
            <h4 class="text-center mb-4 fw-bold">Input Nilai Baru</h4>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="nis" class="form-control" placeholder="NIS">
                </div>
                <div class="mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Siswa">
                </div>
                <div class="mb-3">
                    <input type="text" name="kelas" class="form-control" placeholder="Kelas">
                </div>
                <div class="mb-3">
                    <input type="number" name="nilai" class="form-control" placeholder="Nilai">
                </div>
                <button type="submit" name="submit" class="btn btn-masuk w-100 py-2 fw-bold shadow-sm">Simpan Data</button>
                <div class="d-flex justify-content-between mt-3">
                    <a href="index.php" style="color: var(--soft-red); text-decoration: none;">Kembali</a>
                    <button type="reset" class="btn btn-sm px-4" style="background-color: var(--soft-green); color: white; border-radius: 8px;">Reset Form</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>