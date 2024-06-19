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

  $sql = "INSERT INTO transaksi (id, id_barang, jenis, status, jumlah, tanggal, keterangan)
            VALUES ('$id', '$id_barang', '$jenis', '$status', '$jumlah', '$tanggal', '$keterangan')";

  if (mysqli_query($con, $sql)) {
    header("location: ../../../transaksi.php");
  } else {
    echo "Error: " . mysqli_error($con);
  }
}

$q_barang = mysqli_query($con, "SELECT barang.id, barang.nama, ruangan.nama AS nama_ruangan FROM barang LEFT JOIN ruangan ON barang.id_ruangan = ruangan.id");

?>

<!DOCTYPE html>
<html>

<head>
  <title>Create Record</title>
  <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
</head>

<body>
  <div class="navbar">
    <div class="logo">
      <h2>Sistem <span>Inventori</span> Sekolah</h2>
    </div>
  </div>
  <div class="hero">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <label>ID:</label>
      <input type="text" name="id" placeholder="Using Format : Txxx. Example, T001" required>
      <label>Barang:</label>
      <div class="select-container">
        <select name="id_barang" required>
          <?php
          while ($barang_row = $q_barang->fetch_assoc()) {
          ?>
            <option value="<?= $barang_row['id']; ?>"><?= $barang_row['id'] . ". " . $barang_row['nama'] .
                                                        ", Ruangan : " . $barang_row['nama_ruangan']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <label>Jenis Transaksi:</label>
      <div class="select-container">
        <select name="jenis" required>
          <option value="Masuk">Masuk</option>
          <option value="Keluar">Keluar</option>
          <option value="Pinjam">Pinjam</option>
        </select>
      </div>
      <label>Status Transaksi:</label>
      <div class="select-container">
        <select name="status" required>
          <option value="Selesai">Selesai</option>
          <option value="Belum">Belum</option>
        </select>
      </div>
      <label>Jumlah Barang:</label>
      <input type="number" name="jumlah" required>
      <label>Tanggal Transaksi:</label>
      <input type="date" name="tanggal" required>
      <label>Keterangan:</label>
      <input type="text" name="keterangan" required>
      <input type="submit" name="submit" value="submit">
    </form>
  </div>

  <footer class="footer">
    <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
  </footer>
</body>

</html>