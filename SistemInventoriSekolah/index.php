<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <h2>Sistem <span>Inventori</span> Sekolah</h2>
        </div>
    </div>
    <div class="hero">
        <div class=" container">
            <div class="dashboard">
                <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?>!</h2>
                <p>Username Anda: <?= htmlspecialchars($_SESSION['username']); ?></p>
                <div class="nav-menu">
                    <a href="barang.php">Barang</a>
                    <a href="kategori.php">Kategori</a>
                    <a href="merk.php">Merk</a>
                    <a href="ruangan.php">Ruangan</a>
                    <a href="transaksi.php">Transaksi</a>
                </div>
                <a href="?logout" class="logout-button">Logout</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
    </footer>
</body>

</html>