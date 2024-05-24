<?php
session_start();

function navigateIfNeed($role) { 
    if (isset($_SESSION["didLogin"])) {
        if ($_SESSION["didLogin"]) {
            if ($_SESSION["role"] != $role) {
                header("Location: /QuanLySinhVien/index.php");
            }
        } else {
            header("Location: /QuanLySinhVien/index.php");
        }
    } else {
        header("Location: /QuanLySinhVien/index.php");
    }
}
function logout() {
    $_SESSION["didLogin"] = false;
    header("Location: /QuanLySinhVien/index.php");
}
?>