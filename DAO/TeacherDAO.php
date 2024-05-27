<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/Teacher.php');

function getAllTeachers() {
    $connection = getConnection();
    $query = "select * from Teacher";

    $result = $connection->query($query);
    $teachers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = new Teacher($row["id"], $row["name"], $row["email"], $row["gender"], $row["address"], $row["phoneNumber"], $row["birthday"]);
            array_push($teachers, $item);
        }
    }

    return $teachers;
}
?>