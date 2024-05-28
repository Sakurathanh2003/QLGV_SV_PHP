<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'ConnectDB.php';
    include($_SERVER['DOCUMENT_ROOT'].'/QuanLySinhVien/Model/Account.php');
} catch (Exception $e) {
}


function checkAccount($email, $password): bool {
    $connection = getConnection();
    $cipherPassword = sha1($password);
    $query = "select * from Account where email = '$email' and password = '$cipherPassword'";
    $result = $connection->query($query);
    $connection->close();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $item = new Account($row["id"], $row["name"], $row["email"], $row["password"], $row["role"]);
        return true;
    } else {
        return false;
    }
}

function getAccount($email) {
    $connection = getConnection();
    $query = "select * from Account where email = '$email'";
    $result = $connection->query($query);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $item = new Account($row["name"], $row["email"], $row["password"], $row["role"]);
        $connection->close();
        return $item;
    }
}

function addAccount($name,$email,$password,$role) {
    $connection = getConnection();
    $query = "insert into Account(name, email, password, role) values (?,?,?,?)";
    
    try {
        $stmp = $connection->prepare($query);
        $newPassword = sha1($password);
        $stmp->bind_param("ssss", $name, $email, $newPassword, $role);
        $stmp->execute();
        $stmp->close();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry error code
            throw new Exception("Duplicate entry '$email' for key 'PRIMARY'");
        } else {
            throw $e; // Re-throw if it's a different error
        }
    } finally {
        $connection->close();
    }
}

function removeAccount($email) {
    $connection = getConnection();
    $query = 'delete from Account where email = ?';
    $stmp = $connection->prepare($query);
    $stmp->bind_param("s", $email);
    $stmp->execute();

    $stmp->close();
    $connection->close();
} 
?>