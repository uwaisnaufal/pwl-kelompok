<?php
session_start();

include("config/conn.php");

if (isset($_SESSION['username']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $id = mysqli_real_escape_string($con, $id);

  $sql = "DELETE FROM barang WHERE id = $id";

  if (mysqli_query($con, $sql)) {
    header("location: ibarang.php"); // Redirect after successful deletion
  } else {
    echo "Error deleting record: " . mysqli_error($con);
  }
} else {
  echo "Unauthorized access or invalid data.";
}

mysqli_close($con);
?>