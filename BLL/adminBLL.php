<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
?>