<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../DAO/AccountDAO.php';

session_start();

// Handle Login Action
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (AccountDAO::isExitsAccount($email)) {
        $account = AccountDAO::getAccount($email);

        $_SESSION["didLogin"] = true;
            $_SESSION["role"] = $account->getRole();
            $_SESSION["name"] = $account->getName();
            $_SESSION["id"] = $account->getID();
    
            $_SESSION["currentTab"] = "dashboardTab";
    
            echo '<script>
            alert("Login succesful")
            document.location = "/QuanLySinhVien/index.php"
            </script>';

        // if ($account->getPassword() == sha1($password)) {
        //     $_SESSION["didLogin"] = true;
        //     $_SESSION["role"] = $account->getRole();
        //     $_SESSION["name"] = $account->getName();
        //     $_SESSION["id"] = $account->getID();
    
        //     $_SESSION["currentTab"] = "dashboardTab";
    
        //     echo '<script>
        //     alert("Login succesful")
        //     document.location = "/QuanLySinhVien/index.php"
        //     </script>';
        // } else {
        //     $error = "Your password is wrong. Please login again!";
        //     echo '<script>
        //     alert("'.$error.'")
        //     document.location = "/QuanLySinhVien/index.php"
        //     </script>'; 
        // }
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