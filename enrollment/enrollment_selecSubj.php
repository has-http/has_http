<?php 
require('../view/enroll_top.php');
?>
<div class = "choose_class">
<form id="form_id" action="enrollment_process.php" method="post">
    <table border="2" width="100%" height="230" bordercolor="#000">
    <thead>
        <tr align="center" bgcolor="#298168">
            <th colspan="5"> 
            <?php
                $block_dic = array('4A3' => '월12목67', '4B3' => '월34수56', '4C3' => '월5화7목34', '4D3' => '화12목5금7', '4E3' => '화56금12', '4F3' => '수12금34', '4G3' => '월67수34', '4H3' => '화34금56', '2A3' => '목12', '2B3' => '월67', '2C3' => '수34', '2D3' => '화34', '2E3' => '금56');
                $temp = mysqli_query($conn, "SELECT * FROM course WHERE c_no = '".$_POST['sub_num']."'") or die(mysqli_error($conn));
                $c_name = mysqli_fetch_array($temp)['c_name'];
                echo "$c_name";
            ?>
            </th>
        </tr>
        <tr align="center" bgcolor="#30977a">
            <th class="class_num">분반</th> 
            <th class="time">시간</th>
            <th class="last_num">남은 인원</th>
            <th class="condition">상태</th>
            <th class="summit">신청</th>
        </tr>
    </thead>
    <?php
        $sql = "SELECT * FROM teach WHERE c_no = '".$_POST['sub_num']."'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            $content = array($row['t_no'], $block_dic[$row['t_time']], $row['t_max'], ''
            ,'<input type="radio" name="t_no" value='.$row['t_no'].'>');

            foreach ($content as $i)
            {
            echo "<td> ".$i." </td>";
            }
            echo "</tr>";
        }
    ?>
    </table>
    <input type="hidden" name="c_no" value=<?php echo "'".$_POST['sub_num']."'";?>>
    <input type="hidden" name="c_name" value=<?php echo "'".$c_name."'"; ?>>
    <input id="submit_input" type="submit" value='수강 신청'>
</form>

</div>

<?php 
    require('../view/enroll_bottom.php');
?>