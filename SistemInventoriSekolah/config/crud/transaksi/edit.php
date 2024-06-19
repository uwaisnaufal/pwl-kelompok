<?php
session_start();

include("../../conn.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../../../login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $id_barang = $_POST['id_barang'];
  $jenis = $_POST['jenis'];
  $status = $_POST['status'];
  $jumlah = $_POST['jumlah'];
  $tanggal = $_POST['tanggal'];
  $keterangan = $_POST['keterangan'];

  $sql = "UPDATE transaksi SET id_barang='$id_barang', jenis='$jenis', status='$status', jumlah='$jumlah', tanggal='$tanggal', keterangan='$keterangan'
                WHERE id=$id";

  if (mysqli_query($con, $sql)) {
    header("Location: ../../../transaksi.php");
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}

$q_barang = mysqli_query($con, "SELECT barang.id, barang.nama, ruangan.nama AS nama_ruangan FROM barang LEFT JOIN ruangan ON barang.id_ruangan = ruangan.id");


?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit/Update Record</title>
  <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
</head>

<body>
  <div class="navbar">
    <div class="logo">
      <h2>Sistem <span>Inventori</span> Sekolah</h2>
    </div>
  </div>

  <div class="hero">
    <?php
    $update_id = $_GET['id'];
    $sql = "SELECT transaksi.id, barang.id AS id_barang, barang.nama, transaksi.jenis, transaksi.status, transaksi.jumlah, transaksi.tanggal, transaksi.keterangan FROM transaksi 
INNER JOIN barang ON transaksi.id_barang = barang.id WHERE transaksi.id=$update_id";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    ?>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label>ID:</label>
        <input type="text" name="id" value="<?= $row['id'] ?>" readonly>
        <label>Nama Barang:</label>
        <div class="select-container">
          <select name="id_barang" required>
            <?php while ($barang_row = $q_barang->fetch_assoc()) { ?>
              <option value="<?= $barang_row['id']; ?>" <?= $barang_row['id'] == $row['id_barang'] ? 'selected' : '' ?>>
                <?= $barang_row['id'] . ". " . $barang_row['nama'] . ", Ruangan : " . $barang_row['nama_ruangan'];  ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <label>Jenis Transaksi:</label>
        <div class="select-container">
          <select name="jenis" required>
            <option value="Masuk" <?= $row['jenis'] == 'Masuk' ? 'selected' : '' ?>>Masuk</option>
            <option value="Keluar" <?= $row['jenis'] == 'Keluar' ? 'selected' : '' ?>>Keluar</option>
            <option value="Pinjam" <?= $row['jenis'] == 'Pinjam' ? 'selected' : '' ?>>Pinjam</option>
          </select>
        </div>

        <label>Status Transaksi:</label>
        <div class="select-container">
          <select name="status" required>
            <option value="Selesai" <?= $row['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
            <option value="Belum" <?= $row['status'] == 'Belum' ? 'selected' : '' ?>>Belum</option>
          </select>
        </div>

        <label>Jumlah Barang:</label>
        <input type="number" name="jumlah" value="<?= $row['jumlah'] ?>" required>

        <label>Tanggal Transaksi:</label>
        <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" required>

        <label>Keterangan:</label>
        <input type="text" name="keterangan" value="<?= $row['keterangan'] ?>" required>

        <input type="submit" name="submit" value="Update">
      </form>
    <?php
    } else {
      echo "Record not found.";
    }

    $con->close();
    ?>
  </div>

  <footer class="footer">
    <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
  </footer>
</body>

</html>