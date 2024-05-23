<?php
include '../DAO/AccountDAO.php';

session_start();

// Handle Login Action
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (checkAccount($email, $password)) {
        $_SESSION["didLogin"] = true;
        echo '<script>
        alert("Login succesful")
        document.location = "/QuanLySinhVien/index.php"
        </script>';
    } else {
        $error = "Your password or email is wrong. Please login again!";
        echo '<script>
        alert("'.$error.'")
        document.location = "/QuanLySinhVien/index.php"
        </script>'; 
    }
} else {
    header("Location: /QuanLySinhVien/index.php");
}
?>