<?php
include '../DAO/ConnectDB.php';
include '../Model/Account.php';

$connection = getConnection();

function getAccount($email, $password): bool {
    global $connection;
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
?>