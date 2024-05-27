<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../../../DAO/AccountDAO.php';
require_once '../../../DAO/TeacherDAO.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacherName = $_POST['teacherName'] ?? '';
    $teacherEmail = $_POST['teacherEmail'] ?? '';
    $teacherGender = $_POST['teacherGender'] ?? '';
    $teacherAddress = $_POST['teacherAddress'] ?? '';
    $teacherPhoneNumber = $_POST['teacherPhoneNumber'] ?? '';
    $teacherBirthday = $_POST['teacherBirthday'] ?? '';
    $teacherPassword = $_POST['teacherPassword'] ?? '';
    $_SESSION["currentTab"] = "TeacherTab";

    echo $teacherName."TEACHER";
    addAccount($teacherName, $teacherEmail, $teacherPassword, "teacher");
    addTeacher($teacherName, $teacherEmail, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
    header("Location: /QuanLySinhVien/index.php");
}
?>