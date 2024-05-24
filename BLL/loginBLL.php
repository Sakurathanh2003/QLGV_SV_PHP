<?php
include '../DAO/AccountDAO.php';

session_start();

// Handle Login Action
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (checkAccount($email, $password)) {
        $account = getAccount($email);

        $_SESSION["didLogin"] = true;
        $_SESSION["role"] = $account->getRole();

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
    return;
}

header("Location: /QuanLySinhVien/index.php");
?>