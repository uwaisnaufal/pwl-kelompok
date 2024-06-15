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
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
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
</body>

</html>