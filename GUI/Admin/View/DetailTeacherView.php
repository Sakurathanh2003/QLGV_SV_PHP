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

$teacher = new Teacher("", "", "", "", "", "", "");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $teacher = AdminBLL::teacherByID($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    if (isset($_POST["deleteBtn"])) {
        try {
            AdminBLL::deleteTeacher($id);
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
        $teacherName = $_POST['name'] ?? '';
        $teacherEmail = $_POST['email'] ?? '';
        $teacherGender = $_POST['gender'] ?? '';
        $teacherAddress = $_POST['address'] ?? '';
        $teacherPhoneNumber = $_POST['phoneNumber'] ?? '';
        $teacherBirthday = $_POST['birthday'] ?? '';
        $teacherPassword = $_POST['password'] ?? '';

        try {
            AdminBLL::updateTeacher($id, $teacherName, $teacherEmail, $teacherPassword, $teacherGender, $teacherAddress, $teacherPhoneNumber, $teacherBirthday);
        } catch (Exception $e) {
            echo $e;
        }
    }

    $teacher = AdminBLL::teacherByID($id);
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
        <p class="title">Detail Teacher</p>
    </div>
    <div class="main">
        <form action="" method="POST">
            <input  type="hidden"
                    name="id"
                    value="<?php echo $teacher->getID();?>">

            <div class="field">
                <p class="fieldName">Teacher Name: </p>
                <input type="text" class="textField" name="name" value="<?php echo AdminBLL::getTeacherName($teacher->getID()); ?>" placeholder="Enter student's name" required>
            </div>

            <div class="field">
                <p class="fieldName">Email: </p>
                <input type="text" class="textField" name="email" value="<?php echo AdminBLL::getTeacherEmail($teacher->getID()); ?>" placeholder="Enter email" required>
            </div>

            <div class="field">
                <p class="fieldName">Gender: </p>
                <script>
                    $(document).ready(function() {
                        $('#gender').val('<?php echo $teacher->gender;?>');
                    });
                </script>
                <select id="gender" class="textField" name="gender" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>

            <div class="field">
                <p class="fieldName">Address: </p>
                <input type="text" class="textField" name="address" placeholder="Enter address" value="<?php echo $teacher->getAddress(); ?>"  required>
            </div>

            <div class="field">
                <p class="fieldName">Phone Number: </p>
                <input type="text" class="textField" name="phoneNumber" placeholder="Enter phone number" value="<?php echo $teacher->getPhoneNumber(); ?>"  required>
            </div>

            <div class="field">
                <p class="fieldName">Birthday: </p>
                <input type="date" class="textField" name="birthday" value="<?php echo $teacher->getBirthDay(); ?>" required>
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
                    onclick="return confirm('Bạn có chắc muốn sửa giáo viên này không?')"
                    >Edit</button>
            <button type="submit" 
                    name="deleteBtn" 
                    class="deleteBtn"
                    onclick="return confirm('Bạn có chắc muốn xóa giáo viên này không?')"
                    >Delete</button>
        </form>
    </div>
</body>
<script>
    var element = document.getElementById("nav"); //grab the element
    element.onclick = function() {
        window.location.href = "AllTeacherView.php";
    }
</script>
</html>