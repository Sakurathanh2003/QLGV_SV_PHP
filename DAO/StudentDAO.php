<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'ConnectDB.php';
    include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/Student.php');
} catch (Exception $e) {
}

class StudentDAO {
    //MARK: - Get
    public static function getAllStudents() {
        $connection = getConnection();
        $query = "select * from Student";
    
        $result = $connection->query($query);
        $students = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Student($row["id"], $row["accountID"], $row["gender"], $row["address"], $row["phoneNumber"], $row["birthday"]);
                array_push($students, $item);
            }
        }
        $connection->close();
        return $students;
    }

    public static function getStudentBy($id) {
        $connection = getConnection();
        $query = 'select * from Student where id = '.$id;
        $result = $connection->query($query);
        $connection->close();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Student($row["id"], $row["accountID"], $row["gender"], $row["address"], $row["phoneNumber"], $row["birthday"]);
                return $item;
            }
        }
    }

    //MARK: - Add
    public static function addStudent($accountID, $gender,$address, $phoneNumber, $birthDay) {
        $connection = getConnection();
        $query = 'insert into Student(accountID, gender, address, phoneNumber, birthday) VALUES (?,?,?,?,?)';
        $stmp = $connection->prepare($query);
        $stmp->bind_param("iissss", $accountID, $gender, $address, $phoneNumber, $birthDay);
        $stmp->execute();
    
        $stmp->close();
        $connection->close();
    }

    //MARK: - Delete
    public static function removeStudent($id) {
        $connection = getConnection();
        $query = 'delete from Student where id = ?';
        $stmp = $connection->prepare($query);
        $stmp->bind_param("i", $id);
        $stmp->execute();
    
        $stmp->close();
        $connection->close();
    }
}
?>