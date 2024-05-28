<style>
.classTabContent {
    padding: 20px;
}

.classInput {
    width: 200px;
    margin-bottom: 10px;
}
.classTabContent .addItem {
    width: calc(100% / 2);
    padding: 20px;
    border: 1px dashed black;
    border-radius: 20px;
}

.classTabContent .addItem .title {
    font-size: 25px;
    font-weight: bold;
}

</style>
<div class="classTabContent">
    <div class="addItem">
        <p class="title">Add Class</p>
        <p>Class Name</p>
        <input type="text" name="className" class="classInput">
        <p>Teacher</p>
        <select name="teacherID" class="classInput">
            <?php
                $teachers = allTeachers();
                foreach ($teachers as $teacher) {
                    echo '
                    <option value="'.$teacher->get_id().'">'.$teacher->get_name()." (id: ".$teacher->get_id().")".'</option>
                    ';
                }
            ?>
            <option value=""></option>
        </select><br>
        <button type="submit" name="addClassBtn" class="addClassBtn">Add Class</button>
    </div>
</div>