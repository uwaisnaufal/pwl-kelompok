<?php
session_start();

include("../../conn.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../../../login.php");
  exit();
}

if (isset($_SESSION['username']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $id = mysqli_real_escape_string($con, $id);

  $sql = "DELETE FROM merk WHERE id = $id";

  if (mysqli_query($con, $sql)) {
    header("location: ../../../merk.php");
  } else {
    echo "Error deleting record: " . mysqli_error($con);
  }
} else {
  echo "Unauthorized access or invalid data.";
}

mysqli_close($con);
