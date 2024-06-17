<?php
session_start();
include("config/conn.php");

$authErr = $username = $password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $hasil = mysqli_query($con, $q);
    if ($hasil->num_rows > 0) {
        $rows = $hasil->fetch_assoc();
        $_SESSION['username'] = $rows['username'];
        $_SESSION['nama'] = $rows['nama'];
        header("Location: index.php");
        exit();
    } else {
        $authErr = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h2>Selamat datang di Sistem Inventori Sekolah!</h2>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="input-group">
                    <input required type="text" name="username" placeholder="Input Username" autocomplete="off">
                </div>
                <div class="input-group">
                    <input required type="password" name="password" placeholder="Input Password" autocomplete="off">
                </div>
                <?php if ($authErr) { ?>
                    <div class="error-message">
                        <?= $authErr; ?>
                    </div>
                <?php } ?>
                <div class="input-group">
                    <button type="submit" name="cek">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>