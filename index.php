<?php
include "./DAO/ConnectDB.php";

session_start();

if (isset($_SESSION["didLogin"])) {
    if ($_SESSION["didLogin"]) {
        switch ($_SESSION["role"]) {
            case "admin":
                header("Location: /QuanLySinhVien/GUI/Admin/adminUI.php");
                break;
            case "teacher":
                header("Location: /QuanLySinhVien/GUI/Teacher/teacherUI.php");
                break;
            case "student":
                header("Location: /QuanLySinhVien/GUI/Student/studentUI.php");
                break;
            default:
                header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
                break;
        }
    } else {
        header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
    }
} else {
    $_SESSION["errorLogin"] = "";
    header("Location: /QuanLySinhVien/GUI/Login/loginUI.php");
}
?>