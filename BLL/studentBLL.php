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
include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/DAO/ScoreDAO.php');

class StudentBLL {
    public static function getAccountID() {
        return $_SESSION['id'];
    }

    public static function getStudent() {
        $accountID = StudentBLL::getAccountID();
        $student = StudentDAO::getStudentByAccountID($accountID);
        return $student;
    }

    public static function getStudentID() {
        $student = StudentBLL::getStudent();
        return $student->getID();
    }
    //MARK: - Class
    public static function classByID($id) {
        return ClassDAO::getClassBy($id);
    }

    public static function getClass() {
        $studentID = StudentBLL::getStudentID();
        $listClasses = ClassDetailDAO::getClassOfStudent($studentID);

        $classes = [];
        foreach ($listClasses as $class) {
            $item = ClassDAO::getClassBy($class->getClassID());
            array_push($classes, $item);
        }

        return $classes;
    }

    public static function ScoreOfClass($classID) {
        $studentID = StudentBLL::getStudentID();
        $score = ScoreDAO::getScoreOfStudent($classID, $studentID);
        return $score;
    }
}
?>
