<?php
session_start();

if (isset($_SESSION["didLogin"])) {
    if ($_SESSION["didLogin"]) {
        header("Location: /QuanLySinhVien/GUI/Home/homeUI.php");
    } else {
        header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
    }
} else {
    $_SESSION["errorLogin"] = "";
    header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
}
?>