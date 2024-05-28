<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../BLL/adminBLL.php';

?>
<style>
.teacherTable {
    width: 100%;
    height: 100%;
    border-collapse: collapse;
}

.teacherTable th {
    text-align: left;
    background-color: black;
    color: white;
}

.teacherTable tr {
    height: 40px;
    border-top: 1px solid black;
    
}

tr:not(:last-child) td{
  border-bottom: 1px solid gray;
}

#nav {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    padding-bottom: 15px;
}

#nav .title {
    font-size: 30px;
    font-weight: bold;
    padding-left: 30px;
}
</style>
<body>
    <div id="nav">
        <i class='bx bx-arrow-back bx-md'></i>
        <p class="title">Students</p>
    </div>
    <div class="main">
        <table class="teacherTable">
            <tr>
                <th style="text-align: center">StudentID</th>
                <th>Student's name</th>
                <th>Student's email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Birthday</th>
                <th>Action</th>
            </tr>
            <?php
                $students = allStudent();
                foreach ($students as $student) {
                    echo '
                    <tr>
                        <td style="text-align: center">'.$student->get_id().'</td>
                        <td>'.$student->get_name().'</td>
                        <td>'.$student->get_email().'</td>
                        <td>'.$student->get_gender().'</td>
                        <td>'.$student->get_address().'</td>
                        <td>'.$student->get_phoneNumber().'</td>
                        <td>'.$student->get_birthDay().'</td>
                        <td>
                            <form action="DetailStudentView.php" method="get">
                            <input  type="hidden"
                                    name="id"
                                    value="'.$student->get_id().'">

                            <button type="submit">
                                <i class="bx bxs-edit-alt bx-sm" style="color: blue;" ></i>
                            </button>
                        </form>
                        </td>
                    </tr>
                    ';
                }
            ?>
            <td></td>
        </table>
    </div>
</body>
<script>
    var element = document.getElementById("nav"); //grab the element
    element.onclick = function() {
        window.location.href = "../adminUI.php";
    }
</script>
</html>