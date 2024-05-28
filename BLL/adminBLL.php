<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/AccountDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/TeacherDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/StudentDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/ClassDAO.php');

function getName() {
    $name = $_SESSION["name"];
    return $name;
}

function numberOfTeachers() {
    $teachers = getAllTeachers();
    return count($teachers);
}

function numberOfStudents() {
    $students = getAllStudents();
    return count($students);
}

function numberOfClasses() {
    $classes = getAllClasses();
    return count($classes);
}

function allTeachers() {
    return getAllTeachers();
}

function allStudent() {
    return getAllStudents();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addTeacherForm"])) {
        $teacherName = $_POST['teacherName'] ?? '';
        $teacherEmail = $_POST['teacherEmail'] ?? '';
        $teacherGender = $_POST['teacherGender'] ?? '';
        $teacherAddress = $_POST['teacherAddress'] ?? '';
        $teacherPhoneNumber = $_POST['teacherPhoneNumber'] ?? '';
        $teacherBirthday = $_POST['teacherBirthday'] ?? '';
        $teacherPassword = $_POST['teacherPassword'] ?? '';
        $_SESSION["currentTab"] = "TeacherTab";

        addAccount($teacherName, $teacherEmail, $teacherPassword, "teacher");
        addTeacher($teacherName, $teacherEmail, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
        header("Location: /QuanLySinhVien/index.php");
    }

    if (isset($_POST["addStudentForm"])) {
        $studentName = $_POST['studentName'] ?? '';
        $studentEmail = $_POST['studentEmail'] ?? '';
        $studentGender = $_POST['studentGender'] ?? '';
        $studentAddress = $_POST['studentAddress'] ?? '';
        $studentPhoneNumber = $_POST['studentPhoneNumber'] ?? '';
        $studentBirthday = $_POST['studentBirthday'] ?? '';
        $studentPassword = $_POST['studentPassword'] ?? '';
        $_SESSION["currentTab"] = "StudentTab";

        addAccount($studentName, $studentEmail, $studentPassword, "student");
        addStudent($studentName, $studentEmail, $studentGender, $studentAddress, $studentPhoneNumber, $studentBirthday);
        header("Location: /QuanLySinhVien/index.php");
    }
}
?>