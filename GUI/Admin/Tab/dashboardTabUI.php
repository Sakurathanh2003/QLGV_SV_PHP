<style>
.top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
}

.top .card {
    background-color: white;
    border-radius: 20px;
    border: 1px solid black;
    width: calc((100% - 20px * 5) / 4);
    height: 130px;
    padding: 25px;
    display: flex;
	align-items: center;
    justify-content: space-between;
}

.top .card .main .number {
    font-size: 25px;
    font-weight: bold;
}
</style>
<div>
    <div class="top">
        <div class="card">
            <div class="main">
                <p class="number">
                    <?php 
                        echo AdminBLL::numberOfStudents();
                    ?>
                </p>
                <p class="title">Student</p>
            </div>
            <i class='bx bxs-graduation bx-md'></i>
        </div>
        <div class="card">
            <div class="main">
                <p class="number">
                    <?php 
                        echo AdminBLL::numberOfTeachers();
                    ?>
                </p>
                <p class="title">Teacher</p>
            </div>
            <i class='bx bx-body bx-md'></i>
        </div>
        <div class="card">
            <div class="main">
                <p class="number">
                    <?php 
                        echo AdminBLL::numberOfClasses();
                    ?>
                </p>
                <p class="title">Class</p>
            </div>
            <i class='bx bx-door-open bx-md'></i>
        </div>
        <div class="card">
            <div class="main">
                <p class="number">2</p>
                <p class="title">Teacher</p>
            </div>
            <i class='bx bx-door-open bx-md'></i>
        </div>
    </div>
</div>