<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/Major.php');

class MajorDAO {

    //MARK: - Get
    public static function getAllMajor() {
        $connection = getConnection();
        $query = "select * from Major";
    
        $result = $connection->query($query);
        $classes = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $class = new Major($row["id"], $row["name"]);
                array_push($classes, $class);
            }
        }
    
        return $classes;
    }

    public static function getMajorBy($id) {
        $connection = getConnection();
        $query = 'select * from Major where id = '.$id;
        $result = $connection->query($query);
        $connection->close();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Major($row["id"], $row["name"]);
                return $item;
            }
        }
    }

    //MARK: - Add
    public static function addMajor($name) {
        $connection = getConnection();
        $query = 'insert into Major(name) VALUES (?)';
        $stmp = $connection->prepare($query);
        $stmp->bind_param("s", $name);
        $stmp->execute();
    
        $stmp->close();
        $connection->close();
    }

    //MARK: - Remove
    public static function removeMajor($id) {
        $connection = getConnection();
        $query = 'delete from Major where id = ?';
        $stmp = $connection->prepare($query);

        try {
            $stmp->bind_param("i", $id);
            $stmp->execute();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } finally {
            $stmp->close();
            $connection->close();
        }
    }

    
    //MARK: - Update
    public static function updateMajor($id, $name) {
        $connection = getConnection();
        $query = 'update Major set name = ? where id = ?';
        try {
            $stmp = $connection->prepare($query);
            $stmp->bind_param("si", $name, $id);
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