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
                WHERE id=$id";

  if (mysqli_query($con, $sql)) {
    header("Location: ../../../barang.php");
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Update Record</title>
  <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
</head>

<body>
  <div class="navbar">
    <div class="logo">
      <h2>Sistem <span>Inventori</span> Sekolah</h2>
    </div>
  </div>

  <?php
  // Assuming you have a way to get the ID of the record to be updated (e.g., from a URL parameter)
  $update_id = $_GET['id']; // Get the ID from URL parameter (replace with your logic)
  $sql = "SELECT * FROM barang WHERE id=$update_id";
  $result = mysqli_query($con, $sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Pre-fill the form with existing data
    echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post">';
    echo '<label>ID:</label>';
    echo '<input type="number" name="id" value="' . $row['id'] . '" readonly>'; // Set ID as readonly
    echo '<label>Nama:</label>';
    echo '<input type="text" name="nama" value="' . $row['nama'] . '" required>';
    echo '<label>Jumlah Awal:</label>';
    echo '<input type="number" name="jumlah_awal" value="' . $row['jumlah_awal'] . '" required>';
    echo '<label>Keterangan:</label>';
    echo '<input type="text" name="keterangan" value="' . $row['keterangan'] . '" required>';
    echo '<label>ID Kategori:</label>';
    echo '<input type="number" name="id_kategori" value="' . $row['id_kategori'] . '" required>';
    echo '<label>ID Merk:</label>';
    echo '<input type="number" name="id_merk" value="' . $row['id_merk'] . '" required>';
    echo '<label>ID Ruangan:</label>';
    echo '<input type="number" name="id_ruangan" value="' . $row['id_ruangan'] . '" required>';
    echo '<input type="submit" name="submit" value="Update">';
    echo '</form>';
  } else {
    echo "Record not found.";
  }

  $con->close();
  ?>

  <footer class="footer">
    <p>Created by -Balfaz Alawy- -Feri Ananda Setiawan- -Uwais Naufal Kusuma-</p>
  </footer>
</body>

</html>