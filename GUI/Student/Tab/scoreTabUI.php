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
                <th>Tên lớp</th>
                <th>Điểm thường xuyên</t>
                <th>Điểm giữa kì</th>
                <th>Điểm cuối kì</th>
                <th>Trung bình môn</th>
                <th>Điểm chữ</th>
            </tr>

            <?php
                $classes = StudentBLL::getClass();

                for ($i = 0; $i < count($classes); $i++) {
                    $class = $classes[$i];
                    $score = StudentBLL::ScoreOfClass($class->getID());
                    echo '
                    <tr>
                        <td>'.($i + 1).'</td>
                        <td>'.$class->getName().'</td>
                        <td>'.$score->getScore1().'</td>
                        <td>'.$score->getScore2().'</td>
                        <td>'.$score->getScore3().'</td>
                        <td>'.$score->getTotal().'</td>
                        <td>'.$score->getScoreWord().'</td>
                    </tr>
                    ';
                }
            ?>
        </table>
    </div>
</div>