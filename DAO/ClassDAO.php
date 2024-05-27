<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/Class.php');

function getAllClasses() {
    $connection = getConnection();
    $query = "select * from Class";

    $result = $connection->query($query);
    $classes = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $class = new SchoolClass($row["id"], $row["name"], $row["teacherID"]);
            array_push($teachers, $class);
        }
    }

    return $classes;
}
?>