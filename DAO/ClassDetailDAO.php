<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/ClassDetail.php');

class ClassDetailDAO {
    public static function getAllClassDetails() {
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
    public static function getClassDetail($classID) {
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
    public static function removeStudentInClass($classID, $studentID) {
        $connection = getConnection();
        $query = 'delete from ClassDetail where classID = ? and studentID = ?';
        
        try {
            $stmp = $connection->prepare($query);
            $stmp->bind_param("ii", $classID, $studentID);
            $stmp->execute();
            $stmp->close();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } finally {
            $connection->close();
        }
    }

    public static function removeClassDetailWithClassID($classID) {
        $connection = getConnection();
        $query = 'delete from ClassDetail where classID = ?';
        
        try {
            $stmp = $connection->prepare($query);
            $stmp->bind_param("i", $classID);
            $stmp->execute();
            $stmp->close();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } finally {
            $connection->close();
        }
    }

    public static function addClassDetail($classID, $teacherID, $studentID) {
        $connection = getConnection();
        $query = 'insert into ClassDetail(classID, teacherID, studentID) VALUES (?,?, ?)';
        
        try {
            $stmp = $connection->prepare($query);
            $stmp->bind_param("iii", $classID, $teacherID, $studentID);
            $stmp->execute();
            $stmp->close();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } finally {
            $connection->close();
        }
    }

    public static function updateClassDetail($classID, $teacherID) {
        $connection = getConnection();
        $query = 'update ClassDetail set teacherID = ? where classID = ?';
        try {
            $stmp = $connection->prepare($query);
            $stmp->bind_param("ii", $teacherID, $classID);
            $stmp->execute();
            $stmp->close();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } finally {
            $connection->close();
        }
    }
}
?>