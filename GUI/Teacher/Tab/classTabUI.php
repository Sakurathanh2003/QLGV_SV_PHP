<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

.classTabContent {
    padding: 20px;
}

.classTabContent table {
  border-collapse: collapse;
  width: 100%;
}

.classTabContent th, td {
  text-align: left;
  padding: 8px;
}

.classTabContent tr:nth-child(even){background-color: #f2f2f2}

.classTabContent th {
  background-color: black;
  color: white;
}

</style>
<div class="classTabContent"> 
    <p>DANH SÁCH ĐIỂM</p>
    <div>
        <table>
            <tr>
                <th>STT</th>
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Action</t>
            </tr>

            <?php
                $classes = TeacherBLL::getClass();

                for ($i = 0; $i < count($classes); $i++) {
                    $class = $classes[$i];

                    echo '
                    <tr>
                        <td>'.($i + 1).'</td>
                        <td>'.$class->getID().'</td>
                        <td>'.$class->getName().'</td>
                        <td>
                            <form action="../Teacher/View/DetailClassView.php" method="get">
                            <input  type="hidden"
                                    name="id"
                                    value="'.$class->getId().'">

                            <button type="submit">
                                <i class="bx bxs-edit-alt bx-sm" style="color: blue;" ></i>
                            </button>
                        </form>
                    </tr>
                    ';
                }
            ?>
        </table>
    </div>
</div>