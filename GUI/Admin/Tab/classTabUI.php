<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

* {
    font-family: 'Poppins';
}

.classTabContent {
    display: flex;
    align-items: top;
    justify-content: space-between;
    padding: 20px;
}

.classTabContent .table {
    border: 1px solid black;
    border-radius: 20px;
    width: calc((100% - 40px) / 6 * 4);
    height: calc(100%);
    min-height: 500px;
    padding: 10px;
}

.classTabContent .addView {
    border: 1px solid black;
    border-radius: 20px;
    width: calc((100% - 40px) / 6 * 2);
    height: 100%;
    padding: 10px;
}

.headerTitle {
    font-size: 25px;
    font-weight: bolder;
}

.addView .main {
    padding: 10px;
}

.textField {
    display: flex;
    width: 100%;
    height: 35px;
}

.fieldName {
    padding-top: 10px;
    padding-bottom: 5px;
}

.addClasstBtn {
    width: 100%;
    height: 40px;
    background-color: black;
    color: white;
    border-radius: 10px;
}

.tableHeader {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 20px;
}

.viewAllBtn {
    width: 100px;
    height: 30px;
    background-color: black;
    color: white;
    border-radius: 5px;
}

/* TABLE */
.classTable {
    width: 100%;
    height: 100%;
    border-collapse: collapse;
}

.classTable th {
    text-align: center;
    background-color: black;
    color: white;
    min-width: 20px;

}

.classTable tr {
    height: 40px;
    border-top: 1px solid black;
    text-align: center;
}

tr:not(:last-child) td{
  border-bottom: 1px solid gray;
}

</style>
<script>
    function viewAllClasses() {
        window.location.href = "../Admin/View/AllClassView.php";
    }
</script>
<div class="classTabContent">
    <div class="addView">
        <p class="headerTitle">Add Class</p>

        <div class="main">
            <form action="/QuanLySinhVien/BLL/adminBLL.php" method="POST">
                <input type="hidden" name="addClassForm" value="yes" >
                <p class="fieldName">Class Name</p>
                <input type="text" class="textField" name="className" placeholder="Enter name" required>
                <p class="fieldName">Teacher</p>
                <select id="gender" class="textField" name="teacherID" required>
                    <?php
                        $teachers = AdminBLL::allTeachers();
                        foreach ($teachers as $teacher) {
                            echo '
                            <option value="'.$teacher->get_id().'">'.$teacher->get_name()." (id: ".$teacher->get_id().")".'</option>
                            ';
                        }
                    ?>
                </select><br>
                <button type="submit" name="addClasstBtn" class="addClasstBtn" >Add Class</button>
            </form>
        </div>
    </div>

    <div class="table">
        <div class="tableHeader">
            <p class="headerTitle">Classes</p>
            <button class="viewAllBtn" onclick="viewAllClasses();">View All</button>
        </div>

        <div class="main">
            <table class="classTable">
                <tr>
                    <th>ClassID</th>
                    <th>Class name</th>
                    <th>Teacher</th>
                    <th>Number Of Student</th>
                </tr>
                <?php
                    $classes = AdminBLL::allClasses();
                    foreach ($classes as $class) {
                        echo '
                        <tr>
                            <td>'.$class->getId().'</td>
                            <td>'.$class->getName().'</td>
                            <td>'.AdminBLL::getTeacherName($class->getTeacherID()).'</td>
                            <td>'.AdminBLL::numberOfStudentInClass($class->getId()).'</td>
                        </tr>
                        ';
                    }
                ?>
            </table>
        </div>
    </div>
</div>