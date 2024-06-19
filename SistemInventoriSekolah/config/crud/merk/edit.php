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
  $keterangan = $_POST['keterangan'];

  $sql = "UPDATE merk SET nama='$nama', keterangan='$keterangan' WHERE id=$id";

  if (mysqli_query($con, $sql)) {
    header("Location: ../../../merk.php");
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}
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
    $sql = "SELECT * FROM merk WHERE id=$update_id";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    ?>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <label>ID:</label>
        <input type="number" name="id" value="<?= $row['id'] ?>" readonly>
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
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