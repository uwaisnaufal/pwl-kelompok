<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("config/conn.php");

if ($con->connect_error) {
    die("Koneksi error: " . $con->connect_error);
}

$authErr = "";
$auth = false;
$q = "SELECT barang.id, barang.nama, barang.jumlah_awal, barang.keterangan, barang.tanggal_masuk, kategori.nama AS nama_kategori,
merk.nama AS nama_merk, ruangan.nama AS nama_ruangan FROM barang 
INNER JOIN kategori ON barang.id_kategori = kategori.id
INNER JOIN merk ON barang.id_merk = merk.id
INNER JOIN ruangan ON barang.id_ruangan = ruangan.id";

$hasil = mysqli_query($con, $q);
if ($hasil->num_rows > 0) {
    $auth = true;
} else {
    $authErr = "Data tidak ditemukan!";
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
        <div class="contable">
            <h1>Data Barang</h1>
            <a href="config/crud/barang/create.php" class="btn">Tambah Barang</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jumlah Awal</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pendataan awal</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Ruangan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$auth) {
                    ?>
                        <tr>
                            <td colspan='8'><?= $authErr; ?></td>
                        </tr>";
                        <?php
                    } else {
                        while ($rows = $hasil->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $rows["id"]; ?></td>
                                <td><?= $rows["nama"]; ?></td>
                                <td><?= $rows["jumlah_awal"]; ?></td>
                                <td><?= $rows["keterangan"]; ?></td>
                                <td><?= $rows["tanggal_masuk"]; ?></td>
                                <td><?= $rows["nama_kategori"]; ?></td>
                                <td><?= $rows["nama_merk"]; ?></td>
                                <td><?= $rows["nama_ruangan"]; ?></td>
                                <td>
                                    <a href='config/crud/barang/edit.php?id=<?= $rows["id"]; ?>' class='btn'>Edit</a>
                                    <a href='config/crud/barang/delete.php?id=<?= $rows["id"]; ?>' class='btn btn-delete' onclick='return confirm("Are you sure?")'>Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="footer">
        <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
    </footer>
</body>

</html>