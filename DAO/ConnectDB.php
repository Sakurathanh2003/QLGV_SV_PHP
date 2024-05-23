<?php
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $database = "qlsv";
    function getConnection() {
        global $localhost, $username, $password, $database;
        $conn = new mysqli($localhost, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("". $conn->connect_error);
        }
        
        return $conn;
    }
?>