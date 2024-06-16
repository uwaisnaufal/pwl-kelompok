<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="cbarang.php" class="btn">Tambah Barang</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jumlah Awal</th>
                        <th>Keterangan</th>
                        <th>ID Kategori</th>
                        <th>ID Merk</th>
                        <th>ID Ruangan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("config/conn.php");

                        // Check connection
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }

                        $sql = "SELECT id, nama, jumlah_awal, keterangan, id_kategori, id_merk, id_ruangan FROM barang";
                        $hasil = mysqli_query($con, $sql);

                        if ($hasil->num_rows > 0) {
                            while ($row = $hasil->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["jumlah_awal"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["keterangan"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["id_kategori"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["id_merk"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["id_ruangan"]) . "</td>";
                                echo "<td>
                                    <a href='ubarang.php?id=" . htmlspecialchars($row["id"]) . "' class='btn'>Edit</a>
                                    <a href='dbarang.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No data found</td></tr>";
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
