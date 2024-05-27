<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'ConnectDB.php';
    include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/Teacher.php');
} catch (Exception $e) {
}

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

    $connection->close();
    return $teachers;
}

function addTeacher($name, $email, $gender,$address, $phoneNumber, $birthDay) {
    $connection = getConnection();
    $query = 'insert into Teacher(name, email, gender, address, phoneNumber, birthday) VALUES (?,?,?,?,?,?)';
    $stmp = $connection->prepare($query);
    $stmp->bind_param("ssisss", $name, $email, $gender, $address, $phoneNumber, $birthDay);
    $stmp->execute();

    $stmp->close();
    $connection->close();
}
?>