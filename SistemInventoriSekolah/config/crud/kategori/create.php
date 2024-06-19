<?php
session_start();

include("../../conn.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../../../login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = htmlspecialchars($_POST['nama']);
  $keterangan = $_POST['keterangan'];

  $sql = "INSERT INTO kategori (nama, keterangan)
            VALUES ('$nama', '$keterangan')";

  if (mysqli_query($con, $sql)) {
    header("location: ../../../kategori.php");
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