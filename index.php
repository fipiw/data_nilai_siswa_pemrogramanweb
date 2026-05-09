<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

// Cek apakah ada kata kunci pencarian
if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['cari']);
    // Query dengan filter pencarian
    $query = mysqli_query($conn, "SELECT * FROM siswa WHERE 
                nama LIKE '%$keyword%' OR 
                nis LIKE '%$keyword%' OR 
                kelas LIKE '%$keyword%'
                ORDER BY nama ASC");
} else {
    // Query standar jika tidak ada pencarian
    $query = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama ASC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Nilai Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-page">
    <div class="container py-4">
        <div class="card card-aesthetic p-3 mb-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center px-3">
                <h4 class="m-0 fw-bold text-primary">Sistem Nilai Siswa</h4>
                <a href="logout.php" class="btn btn-sm px-4" style="background-color: var(--soft-red); color: white; border-radius: 10px;">Logout</a>
            </div>
        </div>

        <div class="card card-aesthetic p-4">
            <div class="d-flex justify-content-between mb-4">
                <h4 class="fw-bold">Daftar Nilai Siswa</h4>
                <a href="tambah.php" class="btn btn-tambah px-4">+ Tambah Siswa</a>
            </div>
            
            <form action="index.php" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="cari" class="form-control" placeholder="Cari Nama atau NIS..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                    <?php if(isset($_GET['cari'])): ?>
                        <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                    <?php endif; ?>
                </div>
            </form>

            <div class="table-container"> 
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Nilai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)) : ?>
                            <tr>
                                <td><?= $row['nis']; ?></td>
                                <td class="fw-bold"><?= $row['nama']; ?></td>
                                <td><?= $row['kelas']; ?></td>
                                <td>
                                    <span class="badge-nilai"><?= $row['nilai']; ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm px-3" style="background-color: #95bd9d; color: white; border-radius: 8px;">Edit</a>
                                    <a href="hapus.php?id=<?= $row['id']; ?>" 
                                    class="btn btn-sm px-3" 
                                    style="background-color: #e57373; color: white; border-radius: 8px;"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>