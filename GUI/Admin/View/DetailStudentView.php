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

$student = new Student("", "", "", "", "", "", "");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $student = AdminBLL::studentByID($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["deleteBtn"])) {
        $id = $_POST["id"];
        AdminBLL::deleteStudent($id);
        header("Location: /QuanLySinhVien/GUI/Admin/View/AllStudentView.php");
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
</style>
<body>
    <div id="nav">
        <i class='bx bx-arrow-back bx-md'></i>
        <p class="title">Detail Student</p>
    </div>
    <div class="main">
        <form action="" method="POST">
            <input  type="hidden"
                    name="id"
                    value="<?php echo $student->getID();?>">

            <div class="field">
                <p class="fieldName">Student Name: </p>
                <input type="text" class="textField" name="studentName" value="<?php echo AdminBLL::getStudentName($student->getID()); ?>" placeholder="Enter student's name" required>
            </div>

            <div class="field">
                <p class="fieldName">Email: </p>
                <input type="text" class="textField" name="studentEmail" value="<?php echo AdminBLL::getStudentEmail($student->getID()); ?>" placeholder="Enter email" required>
            </div>

            <div class="field">
                <p class="fieldName">Gender: </p>
                <select id="gender" class="textField" name="studentGender" value="<?php echo $student->gender; ?>" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>

            <div class="field">
                <p class="fieldName">Address: </p>
                <input type="text" class="textField" placeholder="Enter address" value="<?php echo $student->getAddress(); ?>" name="studentAddress" required>
            </div>

            <div class="field">
                <p class="fieldName">Phone Number: </p>
                <input type="text" class="textField" placeholder="Enter phone number" value="<?php echo $student->getPhoneNumber(); ?>" name="studentPhoneNumber" required>
            </div>

            <div class="field">
                <p class="fieldName">Birthday: </p>
                <input type="date" class="textField" name="studentBirthday" value="<?php echo $student->getBirthDay(); ?>" required>
            </div>

            <div class="field">
                <p class="fieldName">Password: </p>
                <input  type="password" 
                        class="textField" 
                        placeholder="Enter password" 
                        name="studentPassword" 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
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
        window.location.href = "AllStudentView.php";
    }
</script>
</html>