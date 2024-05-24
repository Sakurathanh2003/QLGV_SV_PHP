<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
include '../../Common/commonfunction.php';
session_start();

navigateIfNeed('teacher');
if (isset($_GET["logout"])) {
    logout();
}
?>
<body>
    Teacher
    <form method="get">
        <button name="logout">Logout</button>
    </form>
</body>
</html>