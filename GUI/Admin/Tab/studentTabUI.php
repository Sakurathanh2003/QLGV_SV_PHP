<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

* {
    font-family: 'Poppins';
}

.studentTabContent {
    display: flex;
    align-items: top;
    justify-content: space-between;
    padding: 20px;
}

.studentTabContent .table {
    border: 1px solid black;
    border-radius: 20px;
    width: calc((100% - 40px) / 6 * 4);
    height: calc(100%);
    min-height: 500px;
    padding: 10px;
}

.studentTabContent .addView {
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

.addStudentBtn {
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
.studentTable {
    width: 100%;
    height: 100%;
    border-collapse: collapse;
}

.studentTable th {
    text-align: left;
    background-color: black;
    color: white;
    min-width: 20px;
}

.studentTable tr {
    height: 40px;
    border-top: 1px solid black;
    
}

tr:not(:last-child) td{
  border-bottom: 1px solid gray;
}
</style>
<script>
    function viewAllStudent() {
        window.location.href = "../Admin/View/AllStudentView.php";
    }
</script>
<div class="studentTabContent">
    <div class="addView">
        <p class="headerTitle">Add Student</p>

        <div class="main">
            <form action="/QuanLySinhVien/BLL/adminBLL.php" method="POST">
                <input type="hidden" name="addStudentForm" value="yes" >
                <p class="fieldName">Student Name</p>
                <input type="text" class="textField" name="studentName" placeholder="Enter student's name" required>
                <p class="fieldName">Email</p>
                <input type="text" class="textField" name="studentEmail" placeholder="Enter email" required>
                <p class="fieldName">Gender</p>
                <select id="gender" class="textField" name="studentGender" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
                <p class="fieldName">Address</p>
                <input type="text" class="textField" placeholder="Enter address" name="studentAddress" required>
                <p class="fieldName">Phone Number</p>
                <input type="text" class="textField" placeholder="Enter phone number" name="studentPhoneNumber" required>
                <p class="fieldName">Birthday</p>
                <input type="date" class="textField" name="studentBirthday" required>
                <p class="fieldName">Password</p>

                <input  type="password" 
                        class="textField" 
                        placeholder="Enter password" 
                        name="studentPassword" 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        required>
                <br>
                <button type="submit" name="addStudentBtn" class="addStudentBtn" >Add Student</button>
            </form>
        </div>
    </div>

    <div class="table">
        <div class="tableHeader">
            <p class="headerTitle">Students</p>
            <button class="viewAllBtn" onclick="viewAllStudent();">View All</button>
        </div>

        <div class="main">
            <table class="studentTable">
                <tr>
                    <th>StudentID</th>
                    <th>Student's name</th>
                    <th>Student's email</th>
                    <th>Phone Number</th>
                </tr>
                <?php
                    $teachers = AdminBLL::allStudent();
                    foreach ($teachers as $teacher) {
                        echo '
                        <tr>
                            <td style="text-align:center;">'.$teacher->get_id().'</td>
                            <td>'.$teacher->get_name().'</td>
                            <td>'.$teacher->get_email().'</td>
                            <td>'.$teacher->get_phoneNumber().'</td>
                        </tr>
                        ';
                    }
                ?>
            </table>
        </div>
    </div>
</div>