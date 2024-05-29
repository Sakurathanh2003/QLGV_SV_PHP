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

$class = new SchoolClass("", "", "");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $class = classByID($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete class
    if (isset($_POST["deleteBtn"])) {
        $id = $_POST["id"];
        deleteClass($id);
        header("Location: /QuanLySinhVien/GUI/Admin/View/AllClassView.php");
    }

    // Delete Student in class 
    if (isset($_POST["removeStudent"])) {
        $id = $_POST["id"];
        deleteStudentInClass($class->getId(), $id);
    }
}
?>
<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

* {
    font-family: 'Poppins';
}

#nav {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
}

#nav .title {
    font-size: 30px;
    font-weight: bold;
    padding-left: 30px;
}

.main {
    padding-left: 60px;
    padding-top: 10px;
}

.fieldName {
    font-size: 20px;
    width: 200px;
}

.field {
    display: flex;
    align-items: center;
}

.textField {
    height: 40px;
    width: 250px;
}

.editBtn {
    background: blue;
    font-size: 20px;
    font-weight: bold;
    color: white;
    height: 50px;
    width: 100px;
    border-radius: 10px;
}

.deleteBtn {
    background: red;
    font-size: 20px;
    font-weight: bold;
    color: white;
    height: 50px;
    width: 100px;
    border-radius: 10px;
}

.studentTable {
    width: 100%;
    height: 100%;
    border-collapse: collapse;
}

.studentTable th {
    text-align: center;
    background-color: black;
    color: white;
}

.studentTable tr {
    height: 40px;
    border-bottom: 1px solid black;
}

tr:not(:last-child) td{
  border-bottom: 1px solid gray;
}

td {
    text-align: center;
}
</style>
<body>
    <div id="nav">
        <i class='bx bx-arrow-back bx-md'></i>
        <p class="title">Detail Class</p>
    </div>
    <div class="main">
        <form action="" method="POST">
            <input  type="hidden"
                    name="id"
                    value="<?php echo $class->getId();?>">

            <div class="field">
                <p class="fieldName">Class Name: </p>
                <input type="text" class="textField" name="studentName" value="<?php echo $class->getName(); ?>" placeholder="Enter class name" required>
            </div>

            <div class="field">
                <p class="fieldName">Teacher</p>
                <select id="gender" class="textField" name="teacherID" value="<?php echo $class->getTeacherID(); ?>" required>
                    <?php
                        $teachers = allTeachers();
                        foreach ($teachers as $teacher) {
                            echo '
                            <option value="'.$teacher->get_id().'">'.$teacher->get_name()." (id: ".$teacher->get_id().")".'</option>
                            ';
                        }
                    ?>
                </select>
            </div>
            
            <div class="allStudent">
                <p class="fieldName">All Students</p>
                <table class="studentTable">
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
                        $students = studentsInClass($class->getId());
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
                                    <form action="" method="post">
                                    <input  type="hidden"
                                            name="id"
                                            value="'.$student->get_id().'">

                                    <button type="submit" name="removeStudent">
                                        <i class="bx bx-trash bx-sm" style="color: red;"></i>
                                    </button>
                                </form>
                                </td>
                            </tr>
                            ';
                        }

                        if (count($students) == 0) {
                            echo '
                            <tr>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                            </tr>';
                        }
                    ?>
            </table>
            </div>
            <br>
            <button type="submit" name="editBtn" class="editBtn" >Edit</button>
            <button type="submit" 
                    name="deleteBtn" 
                    class="deleteBtn"
                    onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?')"
                    >Delete</button>
        </form>
    </div>
</body>
<script>
    var element = document.getElementById("nav"); //grab the element
    element.onclick = function() {
        window.location.href = "AllClassView.php";
    }
</script>
</html>