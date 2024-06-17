<?php
session_start();

include("../../conn.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../../../login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = htmlspecialchars($_POST['nama']);
  $jumlah_awal = $_POST['jumlah_awal'];
  $keterangan = $_POST['keterangan'];
  $id_kategori = $_POST['id_kategori'];
  $id_merk = $_POST['id_merk'];
  $id_ruangan = $_POST['id_ruangan'];

  $sql = "INSERT INTO barang (nama, jumlah_awal, keterangan, id_kategori, id_merk, id_ruangan)
            VALUES ('$nama', '$jumlah_awal', '$keterangan', '$id_kategori', '$id_merk', '$id_ruangan')";

  if (mysqli_query($con, $sql)) {
    header("location: ../../../barang.php");
  } else {
    echo "Error: " . mysqli_error($con);
  }
}
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
      <label>Nama:</label>
      <input type="text" name="nama" required>
      <label>Jumlah Awal:</label>
      <input type="number" name="jumlah_awal" required>
      <label>Keterangan:</label>
      <input type="text" name="keterangan" required>
      <label>ID Kategori:</label>
      <input type="number" name="id_kategori" required>
      <label>ID Merk:</label>
      <input type="number" name="id_merk" required>
      <label>ID Ruangan:</label>
      <input type="number" name="id_ruangan" required>
      <input type="submit" name="submit" value="submit">
    </form>
  </div>

  <footer class="footer">
    <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
  </footer>
</body>

</html>