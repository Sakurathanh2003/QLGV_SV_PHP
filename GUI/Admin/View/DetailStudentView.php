<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    if (isset($_POST["deleteBtn"])) {
        try {
            AdminBLL::deleteStudent($id);
            echo '<script>
            alert("Xoá thành công!")
            document.location = "/QuanLySinhVien/GUI/Admin/View/AllTeacherView.php"
            </script>';
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            </script>';
        }
    }

    if (isset($_POST["editBtn"])) {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $address = $_POST['address'] ?? '';
        $phoneNumber = $_POST['phoneNumber'] ?? '';
        $birthday = $_POST['birthday'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            AdminBLL::updateStudent($id, $name, $email, $password, $gender, $address, $phoneNumber, $birthday);
            echo '<script>
            alert("Sửa thành công!")
            </script>';
        } catch (Exception $e) {
            echo '<script>
            alert("'.$e->getMessage().'")
            </script>';
        }
    }

    $student = AdminBLL::studentByID($id);
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
                <input type="text" class="textField" name="name" value="<?php echo AdminBLL::getStudentName($student->getID()); ?>" placeholder="Enter name" required>
            </div>

            <div class="field">
                <p class="fieldName">Email: </p>
                <input type="text" class="textField" name="email" value="<?php echo AdminBLL::getStudentEmail($student->getID()); ?>" placeholder="Enter email" required>
            </div>

            <div class="field">
                <p class="fieldName">Gender: </p>
                <script>
                    $(document).ready(function() {
                        $('#gender').val('<?php echo $student->gender;?>');
                    });
                </script>
                <select id="gender" class="textField" name="gender" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>

            <div class="field">
                <p class="fieldName">Address: </p>
                <input type="text" class="textField" name="address" placeholder="Enter address" value="<?php echo $student->getAddress(); ?>"  required>
            </div>

            <div class="field">
                <p class="fieldName">Phone Number: </p>
                <input type="text" class="textField" name="phoneNumber" placeholder="Enter phone number" value="<?php echo $student->getPhoneNumber(); ?>"  required>
            </div>

            <div class="field">
                <p class="fieldName">Birthday: </p>
                <input type="date" class="textField" name="birthday" value="<?php echo $student->getBirthDay(); ?>" required>
            </div>

            <div class="field">
                <p class="fieldName">Password: </p>
                <input  type="password" 
                        class="textField" 
                        placeholder="Enter password" 
                        name="password" 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            </div>
            
            <br>
            <button type="submit" 
                    name="editBtn"
                    class="editBtn" 
                    onclick="return confirm('Bạn có chắc muốn sửa sinh viên này không?')"
                    >Edit</button>
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