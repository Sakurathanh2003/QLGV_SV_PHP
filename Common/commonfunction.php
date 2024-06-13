<?php
session_start();

function navigateIfNeed($role) { 
    if (isset($_SESSION["didLogin"])) {
        if ($_SESSION["didLogin"]) {
            if ($_SESSION["role"] != $role) {
                header("Location: /QuanLySinhVien/index.php");
            }
        } else {
            header("Location: /QuanLySinhVien/index.php");
        }
    } else {
        header("Location: /QuanLySinhVien/index.php");
    }
}

function logout() {
    session_unset();
    header("Location: /QuanLySinhVien/index.php");
}

//MARK:- Validate
function checkEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function checkName($name) {
    return !containsSpecialChars($name);
}

function checkPhoneNumber($sdt) {
    return ctype_digit($sdt);
}

function checkAddress($address) {
    return !containsSpecialChars($address);
}

function containsSpecialChars($str) {
    return preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $str) > 0;
}
?>