<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();

if (isset($_SESSION["didLogin"])) {
    if (!$_SESSION["didLogin"]) {
        header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
    }
} else {
    header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
}

function logout() {
    $_SESSION["didLogin"] = false;
    header("Location: /QuanLySinhVien/index.php");
}

if (isset($_GET["logout"])) {
    logout();
}
?>
<body>
    Home
    <form method="get">
        <button name="logout">Logout</button>
    </form>
</body>
</html>