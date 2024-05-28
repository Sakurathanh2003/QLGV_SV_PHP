<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Common/commonfunction.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/AccountDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/TeacherDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/StudentDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/ClassDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/ClassDetailDAO.php');


function getName() {
    $name = $_SESSION["name"];
    return $name;
}

// MARK: - Teacher
function numberOfTeachers() {
    $teachers = getAllTeachers();
    return count($teachers);
}

function allTeachers() {
    return getAllTeachers();
}

function deleteTeacher($id) {
    $teacher = getTeacherBy($id);
    removeTeacher($id);
    removeAccount($teacher->get_email());
}

function teacherByID($id) {
    return getTeacherBy($id);
}

// MARK: - Student
function numberOfStudents() {
    $students = getAllStudents();
    return count($students);
}

function allStudent() {
    return getAllStudents();
}

function studentByID($id) {
    return getStudentBy($id);
}

function deleteStudent($id) {
    $student = getStudentBy($id);
    removeStudent($id);
    removeAccount($student->get_email());
}

// MARK: - Class
function numberOfClasses() {
    $classes = getAllClasses();
    return count($classes);
}

function allClasses() {
    return getAllClasses();
}

function numberOfStudentInClass($classID) {
    $list = getClassDetail($classID);
    return count($list);
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

        try {
            addAccount($teacherName, $teacherEmail, $teacherPassword, "teacher");
            addTeacher($teacherName, $teacherEmail, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
            header("Location: /QuanLySinhVien/index.php");
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
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

        try {
            addAccount($studentName, $studentEmail, $studentPassword, "student");
            addStudent($studentName, $studentEmail, $studentGender, $studentAddress, $studentPhoneNumber, $studentBirthday);
            header("Location: /QuanLySinhVien/index.php");
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
    }

    if (isset($_POST["addClassForm"])) {
        $className = $_POST['className'] ?? '';
        $teacherID = $_POST['teacherID'] ?? '';
        $_SESSION["currentTab"] = "ClassTab";

        // try {
        //     addClass($className, $teacherID);
        //     header("Location: /QuanLySinhVien/index.php");
        // } catch (Exception $e) {
        //     echo '<script>
        //     alert("'.$e->getMessage().'")
        //     document.location = "/QuanLySinhVien/index.php"
        //     </script>';
        // }
    }
}
?>