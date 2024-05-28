<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../Common/commonfunction.php';

navigateIfNeed('student');
if (isset($_GET["logout"])) {
    logout();
}
?>
<body>
    Student
    <form method="get">
        <button name="logout">Logout</button>
    </form>
</body>
</html>