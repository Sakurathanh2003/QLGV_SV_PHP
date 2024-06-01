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


class TeacherBLL {
    public static function getAccountID() {
        return $_SESSION['id'];
    }

    public static function getTeacher() {
        $accountID = TeacherBLL::getAccountID();
        $student = TeacherDAO::getTeacherByAccountID($accountID);
        return $student;
    }

    public static function getTeacherID() {
        $teacher = TeacherBLL::getTeacher();
        return $teacher->getID();
    }

    //MARK: - Class
    public static function classByID($id) {
        return ClassDAO::getClassBy($id);
    }

    public static function getClass() {
        $teacherID = TeacherBLL::getTeacherID();
        $classes = ClassDAO::getClassOfTeacher($teacherID);

        return $classes;
    }

    //MARK: - Class Detail
    public static function studentsInClass($classID) {
        $list = ClassDetailDAO::getClassDetail($classID);
        $students = [];
        foreach ($list as $item) {
            $student = StudentDAO::getStudentBy($item->getStudentID());
            array_push($students, $student);
        }
    
        return $students;
    }

    //MARK: - Score
    public static function ScoreOfStudent($classID, $studentID) {
        return ScoreDAO::getScoreOfStudent($classID, $studentID);
    }

    public static function getStudentName($id) {
        $student = StudentDAO::getStudentBy($id);
        $account = AccountDAO::getAccountByID($student->getAccountID());
        return $account->getName();
    }
    public static function getStudentEmail($id) {
        $student = StudentDAO::getStudentBy($id);
        $account = AccountDAO::getAccountByID($student->getAccountID());
        return $account->getEmail();
    }

    public static function updateScore($scoreID, $score1, $score2, $score3) {
        ScoreDAO::updateScore($scoreID, $score1, $score2, $score3);
    }
}
?>
