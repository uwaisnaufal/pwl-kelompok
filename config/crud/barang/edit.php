<?php
session_start();

include("../../conn.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../../../login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $nama = htmlspecialchars($_POST['nama']);
  $jumlah_awal = $_POST['jumlah_awal'];
  $keterangan = $_POST['keterangan'];
  $id_kategori = $_POST['id_kategori'];
  $id_merk = $_POST['id_merk'];
  $id_ruangan = $_POST['id_ruangan'];

  $sql = "UPDATE barang SET nama='$nama', jumlah_awal='$jumlah_awal', keterangan='$keterangan', 
                id_kategori='$id_kategori', id_merk='$id_merk', id_ruangan='$id_ruangan' 
                WHERE id='$id'";

  if (mysqli_query($con, $sql)) {
    header("Location: ../../../barang.php");
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}

$q_kategori = mysqli_query($con, "SELECT id, nama FROM kategori");
$q_merk = mysqli_query($con, "SELECT id, nama FROM merk");
$q_ruangan = mysqli_query($con, "SELECT id, nama FROM ruangan");

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
    $sql = "SELECT * FROM barang WHERE id='$update_id'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    ?>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label>ID:</label>
        <input type="text" name="id" value="<?= $row['id'] ?>" readonly>
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
        <label>Jumlah Awal:</label>
        <input type="number" name="jumlah_awal" value="<?= $row['jumlah_awal'] ?>" required>
        <label>Keterangan:</label>
        <input type="text" name="keterangan" value="<?= $row['keterangan'] ?>" required>

        <label>Kategori:</label>
        <div class="select-container">
          <select name="id_kategori" required>
            <?php
            while ($kategori_row = $q_kategori->fetch_assoc()) {
              $selected = $kategori_row['id'] == $row['id_kategori'] ? 'selected' : '';
              echo "<option value='{$kategori_row['id']}' $selected>{$kategori_row['nama']}</option>";
            }
            ?>
          </select>
        </div>

        <label>Merk:</label>
        <div class="select-container">
          <select name="id_merk" required>
            <?php
            while ($merk_row = $q_merk->fetch_assoc()) {
              $selected = $merk_row['id'] == $row['id_merk'] ? 'selected' : '';
              echo "<option value='{$merk_row['id']}' $selected>{$merk_row['nama']}</option>";
            }
            ?>
          </select>
        </div>

        <label>Ruangan:</label>
        <div class="select-container">
          <select name="id_ruangan" required>
            <?php
            while ($ruangan_row = $q_ruangan->fetch_assoc()) {
              $selected = $ruangan_row['id'] == $row['id_ruangan'] ? 'selected' : '';
              echo "<option value='{$ruangan_row['id']}' $selected>{$ruangan_row['nama']}</option>";
            }
            ?>
          </select>
        </div>

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