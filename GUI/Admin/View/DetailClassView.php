<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

* {
    font-family: 'Poppins';
}

/* DIALOG ADD */
.dialogAdd {
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    opacity: 0;
    pointer-events: none;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    transition: .3s ease;
}

.dialogAdd.show {
    opacity: 1;
    pointer-events: auto;
}

.modal {
    background-color: white;
    border-radius: 12px;
    padding: 30px 50px;
    width: 600px;
    max-width: 100%;
}

/* MAIN VIEW */
/* Navigation */
#navigation {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
}

#navigation .title {
    font-size: 30px;
    font-weight: bold;
    padding-left: 30px;
}

.mainView {
    padding-left: 60px;
    padding-right: 60px;
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
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../BLL/adminBLL.php';

$class = new SchoolClass("", "", "");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "get";
    $id = $_GET["id"];
    $class = AdminBLL::classByID($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classID = $_POST["classID"];
    $class = AdminBLL::classByID($classID);

    // Delete class
    if (isset($_POST["deleteBtn"])) {
        AdminBLL::deleteClass($classID);
        header("Location: /QuanLySinhVien/GUI/Admin/View/AllClassView.php");
    }

    if (isset($_POST["editBtn"])) {
        $className = $_POST["classNameNew"];
        $teacherID = $_POST["teacherIDNew"];   
        AdminBLL::updateClass($classID, $className, $teacherID);
        $class = AdminBLL::classByID($classID);
    }

    if (isset($_POST["addStudentForm"])) {
        $studentID = $_POST["studentID"];
        AdminBLL::addStudentInClass($classID, $studentID);
    }

    if (isset($_POST["removeStudentForm"])) {
        $studentID = $_POST["removeStudentID"];
        AdminBLL::deleteStudentInClass($class->getId(), $studentID);
    }
}
?>
</style>
<body>
    <div class="mainContainer">
        <div id="navigation">
            <i class='bx bx-arrow-back bx-md'></i>
            <p class="title">Detail Class</p>
        </div>
        <div class="mainView">
            <form action="" method="POST">
            <!-- Information of Class -->
                <input  type="hidden"
                        name="classID"
                        value="<?php echo $class->getId();?>">

                <div class="field">
                    <p class="fieldName">Class Name: </p>
                    <input type="text" class="textField" name="classNameNew" value="<?php echo $class->getName(); ?>" placeholder="Enter class name" required>
                </div>

                <div class="field">
                    <p class="fieldName">Teacher</p>
                    <select id="teacherIDNew" class="textField" name="teacherIDNew" value="<?php echo $class->getTeacherID(); ?>" required>
                        <?php
                            $teachers = AdminBLL::allTeachers();
                            foreach ($teachers as $teacher) {
                                echo '
                                <option value="'.$teacher->get_id().'">'.$teacher->get_name()." (id: ".$teacher->get_id().")".'</option>
                                ';
                            }
                        ?>
                    </select>
                </div>

                <!-- Edit and Delete button -->
                <button type="submit" name="editBtn" class="editBtn" >Edit</button>
                <button type="submit" 
                        name="deleteBtn" 
                        class="deleteBtn"
                        onclick="return confirm('Bạn có chắc muốn xóa lớp này không?')"
                        >Delete</button>
                <br>
            </form>
           <!-- Student Table -->
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
                        $students = AdminBLL::studentsInClass($class->getId());
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
                                        name="removeStudentID"
                                        value="'.$student->get_id().'">
                                        <input  type="hidden"
                                                name="classID"
                                                value="'.$class->getId().'">

                                        <button type="submit" 
                                                name="removeStudentForm"
                                                onclick="return confirm('."'Bạn có chắc muốn xóa sinh viên này không?'".')">
                                            <i class="bx bx-trash bx-sm" style="color: red;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            ';
                        }

                        echo '
                            <tr>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>
                                    <button id="addStudent" style="border: none; background: white;">
                                        <i class="bx bx-plus-circle bx-sm" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>';
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- DIALOG -->
    <div class="dialogAdd" id="dialogAdd">
        <div class="modal">
            <h1>Add Student</h1>
            <form action="" method="post">
                <input  type="hidden"
                        name="classID"
                        value="<?php echo $class->getId();?>">

                <p>Student: </p>
                <select name="studentID" id="">
                    <?php
                         $students = AdminBLL::studentWithinClass($class->getId());

                         foreach ($students as $student) {
                            echo '
                            <option value="'.$student->get_id().'">'.$student->get_name()." (id: ".$student->get_id().")".'</option>
                            ';                         }
                    ?>
                    <option value=""></option>
                </select><br><br>
                <button id="close">Close</button>
                <button name="addStudentForm">Add</button>
            </form>
            
        </div>
    </div>
</body>
<script>
    var element = document.getElementById("navigation"); //grab the element
    element.onclick = function() {
        window.location.href = "AllClassView.php";
    }

    const open = document.getElementById("addStudent");
    const dialog = document.getElementById("dialogAdd");
    const close = document.getElementById("close");

    open.addEventListener('click', () => {
        dialog.classList.add('show');
    })

    close.addEventListener('click', () => {
        dialog.classList.remove('show');
    })
</script>
</html>