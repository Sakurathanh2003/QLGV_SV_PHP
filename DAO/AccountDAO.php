<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'ConnectDB.php';
include '../Model/Account.php';

function checkAccount($email, $password): bool {
    $connection = getConnection();
    $cipherPassword = sha1($password);
    $query = "select * from Account where email = '$email' and password = '$cipherPassword'";
    $result = $connection->query($query);
    
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
        $item = new Account($row["id"], $row["name"], $row["email"], $row["password"], $row["role"]);
        return $item;
    }
}
?>