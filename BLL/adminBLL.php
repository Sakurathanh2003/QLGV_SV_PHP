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

class AdminBLL {
    public static function getName() {
        $name = $_SESSION["name"];
        return $name;
    }
    //MARK: - Teacher
    // - GET
    public static function numberOfTeachers() {
        $teachers = TeacherDAO::getAllTeachers();
        return count($teachers);
    }

    public static function allTeachers() {
        return TeacherDAO::getAllTeachers();
    }

    public static function teacherByID($id) {
        return TeacherDAO::getTeacherBy($id);
    }

    public static function getTeacherName($id) {
        $teacher = AdminBLL::teacherByID($id);
        $account = AccountDAO::getAccountByID($teacher->getAccountID());
        return $account->getName();
    }

    public static function getTeacherEmail($id) {
        $teacher = AdminBLL::studentByID($id);
        $account = AccountDAO::getAccountByID($teacher->getAccountID());
        return $account->getEmail();
    }

    // - SET
    public static function deleteTeacher($id) {
        $teacher = TeacherDAO::getTeacherBy($id);
        AccountDAO::removeAccount($teacher->getAccountID());
        TeacherDAO::removeTeacher($id);
    }

    public static function addTeacher($teacherName, $teacherEmail,$teacherPassword, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday) {
        try {
            $accountID = AccountDAO::addAccount($teacherName, $teacherEmail, $teacherPassword, "teacher");
            TeacherDAO::addTeacher($accountID, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function updateTeacher($id, $teacherName, $teacherEmail,$teacherPassword, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday) {
        try {
            AccountDAO::updateEmail($id, $teacherEmail);
            AccountDAO::updateName($id, $teacherName);

            if (isset($teacherPassword)) {
                AccountDAO::updatePassword($id, $teacherPassword);
            }

            TeacherDAO::addTeacher($teacherName, $teacherEmail, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //MARK: - Student
    public static function numberOfStudents() {
        $students = StudentDAO::getAllStudents();
        return count($students);
    }

    public static function allStudent() {
        return StudentDAO::getAllStudents();
    }

    public static function studentByID($id) {
        return StudentDAO::getStudentBy($id);
    }

    public static function getStudentName($id) {
        $student = AdminBLL::studentByID($id);
        $account = AccountDAO::getAccountByID($student->getAccountID());
        return $account->getName();
    }
    public static function getStudentEmail($id) {
        $student = AdminBLL::studentByID($id);
        $account = AccountDAO::getAccountByID($student->getAccountID());
        return $account->getEmail();
    }


    public static function deleteStudent($id) {
        $student = StudentDAO::getStudentBy($id);
        AccountDAO::removeAccount($student->getAccountID());
        StudentDAO::removeStudent($id);
    }

    //MARK: - Class
    public static function numberOfClasses() {
        $classes = ClassDAO::getAllClasses();
        return count($classes);
    }

    public static function allClasses() {
        return ClassDAO::getAllClasses();
    }
    public static function classByID($id) {
        return ClassDAO::getClassBy($id);
    }

    //MARK: - ClassStudent
    public static function numberOfStudentInClass($classID) {
        $list = ClassDetailDAO::getClassDetail($classID);
        return count($list);
    }

    public static function studentsInClass($classID) {
        $list = ClassDetailDAO::getClassDetail($classID);
        $students = [];
        foreach ($list as $item) {
            $student = StudentDAO::getStudentBy($item->getStudentID());
            array_push($students, $student);
        }
    
        return $students;
    }

    public static function studentWithinClass($classID) {
        $allStudent = AdminBLL::allStudent();
        $studentInClass = AdminBLL::studentsInClass($classID);
        $ans = [];
    
        foreach ($allStudent as $student) {
            if (!in_array($student, $studentInClass)) {
                array_push($ans, $student);
            }
        }
    
        return $ans;
    }

    public static function deleteStudentInClass($classID, $studentID) {
        try {
            ClassDetailDAO::removeStudentInClass($classID, $studentID);
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
    }
    
    public static function addStudentInClass($classID, $studentID) {
        try {
            $class = AdminBLL::classByID($classID);
            ClassDetailDAO::addClassDetail($classID, $class->getTeacherID(), $studentID);
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
    }
    
    public static function deleteClass($id) {
        try {
            ClassDetailDAO::removeClassDetailWithClassID($id);
            ClassDAO::removeClass($id);
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
    }

    public static function updateClass($classID, $className, $teacherID) {
        try {
            ClassDAO::updateClass($classID, $className, $teacherID);
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
    }
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

        try {
            AdminBLL::addTeacher($teacherName, $teacherEmail, $teacherPassword, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
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

        try {
            AccountDAO::addAccount($studentName, $studentEmail, $studentPassword, "student");
            StudentDAO::addStudent($studentName, $studentEmail, $studentGender, $studentAddress, $studentPhoneNumber, $studentBirthday);
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

        try {
            ClassDAO::addClass($className, $teacherID);
            header("Location: /QuanLySinhVien/index.php");
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            document.location = "/QuanLySinhVien/index.php"
            </script>';
        }
    }
}
?>