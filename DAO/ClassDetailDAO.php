<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/ClassDetail.php');

// MARK: - Get
function getAllClassDetails() {
    $connection = getConnection();
    $query = "select * from ClassDetail";

    $result = $connection->query($query);
    $details = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $detail = new ClassDetail($row["id"], $row["classID"], $row["teacherID"], $row["studentID"]);
            array_push($details, $detail);
        }
    }

    return $details;
}

function getClassDetail($classID) {
    $connection = getConnection();
    $query = "select * from ClassDetail where classID = ".$classID;

    $result = $connection->query($query);
    $details = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $detail = new ClassDetail($row["id"], $row["classID"], $row["teacherID"], $row["studentID"]);
            array_push($details, $detail);
        }
    }

    return $details;
}

// MARK: - Set
function removeStudentInClass($classID, $studentID) {
    $connection = getConnection();
    $query = 'delete from Class ClassDetail where classID = ? and studentID = ?';
    $stmp = $connection->prepare($query);
    $stmp->bind_param("ii", $classID, $studentID);
    $stmp->execute();

    $stmp->close();
    $connection->close();
}

function removeClassDetailWithClassID($classID) {
    $connection = getConnection();
    $query = 'delete from Class ClassDetail where classID = ?';
    $stmp = $connection->prepare($query);
    $stmp->bind_param("i", $classID);
    $stmp->execute();

    $stmp->close();
    $connection->close();
}

// function addClass($name, $teacherID) {
//     $connection = getConnection();
//     $query = 'insert into Class(name, teacherID) VALUES (?,?)';
//     $stmp = $connection->prepare($query);
//     $stmp->bind_param("si", $name, $teacherID);
//     $stmp->execute();

//     $stmp->close();
//     $connection->close();
// }

// function removeClass($id) {
//     $connection = getConnection();
//     $query = 'delete from Class where id = ?';
//     $stmp = $connection->prepare($query);
//     $stmp->bind_param("i", $id);
//     $stmp->execute();

//     $stmp->close();
//     $connection->close();
// }

// function getClassBy($id) {
//     $connection = getConnection();
//     $query = 'select * from Class where id = '.$id;
//     $result = $connection->query($query);
//     $connection->close();

//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             $item = new SchoolClass($row["id"], $row["name"], $row["teacherID"]);
//             return $item;
//         }
//     }
// }
?>