<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query hapus
    $query = "DELETE FROM siswa WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?pesan=hapus_berhasil");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
}
?>