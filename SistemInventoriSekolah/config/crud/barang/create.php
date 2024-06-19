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

$q_kategori = mysqli_query($con, "SELECT id, nama FROM kategori");
$q_merk = mysqli_query($con, "SELECT id, nama FROM merk");
$q_ruangan = mysqli_query($con, "SELECT id, nama FROM ruangan");
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
      <label>Kategori:</label>
      <select name="id_kategori">
        <?php
        while ($kategori_rows = $q_kategori->fetch_assoc()) {
        ?>
          <option value="<?= $kategori_rows['id']; ?>"><?= $kategori_rows['id'] . ". " . $kategori_rows['nama']; ?></option>
        <?php
        }
        ?>
      </select>
      <label>Merk:</label>
      <select name="id_merk">
        <?php
        while ($merk_rows = $q_merk->fetch_assoc()) {
        ?>
          <option value="<?= $merk_rows['id']; ?>"><?= $merk_rows['id'] . ". " . $merk_rows['nama']; ?></option>
        <?php
        }
        ?>
      </select>
      <label>Ruangan:</label>
      <select name="id_ruangan">
        <?php
        while ($ruangan_rows = $q_ruangan->fetch_assoc()) {
        ?>
          <option value="<?= $ruangan_rows['id']; ?>"><?= $ruangan_rows['id'] . ". " . $ruangan_rows['nama']; ?></option>
        <?php
        }
        ?>
      </select>
      <input type="submit" name="submit" value="submit">
    </form>
  </div>

  <footer class="footer">
    <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
  </footer>
</body>

</html>