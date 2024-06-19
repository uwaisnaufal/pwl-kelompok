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
$q = "SELECT id, nama, keterangan FROM ruangan";

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
    <title>Form Ruangan</title>
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
            <h1>Data Ruangan</h1>
            <div class="button-container">
                <a href="config/crud/ruangan/create.php" class="btn">Tambah Ruangan</a>
                <a href="index.php" class="btn btn-delete">Kembali ke Dashboard</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$auth) {
                    ?>
                        <tr>
                            <td colspan='4'><?= $authErr; ?></td>
                        </tr>
                        <?php
                    } else {
                        while ($rows = $hasil->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $rows["id"]; ?></td>
                                <td><?= $rows["nama"]; ?></td>
                                <td><?= $rows["keterangan"]; ?></td>
                                <td>
                                    <a href='config/crud/ruangan/edit.php?id=<?= $rows["id"]; ?>' class='btn'>Edit</a>
                                    <a href='config/crud/ruangan/delete.php?id=<?= $rows["id"]; ?>' class='btn btn-delete' onclick='return confirm("Are you sure?")'>Delete</a>
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