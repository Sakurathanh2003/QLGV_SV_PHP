<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

* {
    font-family: 'Poppins';
}

.teacherTabContent {
    display: flex;
    align-items: top;
    justify-content: space-between;
    padding: 20px;
}

.teacherTabContent .table {
    border: 1px solid black;
    border-radius: 20px;
    width: calc((100% - 40px) / 6 * 4);
    height: calc(100%);
    min-height: 500px;
    padding: 10px;
}

.teacherTabContent .addView {
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

.addTeacherBtn {
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
    border-bottom: 1px solid black;
}

</style>
<script>
    function viewAllTeacher() {
        window.location.href = "../Admin/View/AllTeacherView.php";
    }
</script>
<div class="teacherTabContent">
    <div class="table">
        <div class="tableHeader">
            <p class="headerTitle">Teachers</p>
            <button class="viewAllBtn" onclick="viewAllTeacher();">View All</button>
        </div>

        <div class="main">
            <table class="teacherTable">
                <tr>
                    <th style="text-align: center; border-radius: 10px 0px 0px 0px;">TeacherID</th>
                    <th style="text-align: center;">Teacher's name</th>
                    <th style="text-align: center;">Teacher's email</th>
                    <th style="text-align: center; border-radius: 0px 10px 0px 0px;">Phone Number</th>
                </tr>
                <?php
                    $teachers = AdminBLL::allTeachers();
                    foreach ($teachers as $teacher) {
                        echo '
                        <tr>
                            <td>'.$teacher->getID().'</td>
                            <td>'.AdminBLL::getTeacherName($teacher->getID()).'</td>
                            <td>'.AdminBLL::getTeacherEmail($teacher->getID()).'</td>
                            <td>'.$teacher->getPhoneNumber().'</td>
                        </tr>
                        ';
                    }
                ?>
            </table>
        </div>
    </div>

    <div class="addView">
        <p class="headerTitle">Add Teachers</p>

        <div class="main">
            <form action="/QuanLySinhVien/BLL/adminBLL.php" method="POST">
                <input type="hidden" name="addTeacherForm" value="yes" >
                <!-- Name -->
                <p class="fieldName">Teacher Name</p>
                <input type="text" class="textField" name="teacherName" placeholder="Enter teacher's name" required>
                
                <!-- Email -->
                <p class="fieldName">Email</p>
                <input type="text" class="textField" name="teacherEmail" placeholder="Enter email" required>
                
                <!-- Gender -->
                <p class="fieldName">Gender</p>
                <select class="textField" name="teacherGender" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>

                <!-- Address -->
                <p class="fieldName">Address</p>
                <input type="text" class="textField" placeholder="Enter address" name="teacherAddress" required>
                
                <!-- Phone -->
                <p class="fieldName">Phone Number</p>
                <input type="text" class="textField" placeholder="Enter phone number" name="teacherPhoneNumber" required>
                
                <!-- Birthday -->
                <p class="fieldName">Birthday</p>
                <input type="date" class="textField" name="teacherBirthday" required>
                
                <!-- Password -->
                <p class="fieldName">Password</p>
                <input  type="password" 
                        class="textField" 
                        placeholder="Enter password" 
                        name="teacherPassword" 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        required>
                <br>
                <button type="submit" name="addTeacherBtn" class="addTeacherBtn" >Add Teacher</button>
            </form>
        </div>
    </div>
</div>