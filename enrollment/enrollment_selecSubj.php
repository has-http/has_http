<?php
require_once('../lib/utill.php');
$conn = mysql_connect(); 
if (isset($_POST['sub_num'])){
    $_POST['sub_num'] = mysqli_real_escape_string($conn, $_POST['sub_num']);
}
else{
    header("Location: enrollment.php");
    exit;
}
require('../view/enroll_top.php');
?>

<div class = "choose_class">
<form id="form_id" action="enrollment_process.php" method="post">
    <table border="2" width="100%" height="230" bordercolor="#000">
    <thead>
        <tr align="center" bgcolor="#298168">
            <th colspan="5"> 
            <?php
                $temp = mysqli_query($conn, "SELECT * FROM course WHERE c_no = '".$_POST['sub_num']."'") or die(mysqli_error($conn));
                $c_name = mysqli_fetch_array($temp)['c_name'];
                echo $c_name;
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
        require("../lib/enroll_func.php");
        require_once("../lib/sub_list.php");
        $block_dic = get_blockDicionary();

        $sql = "SELECT * FROM teach WHERE c_no = '".$_POST['sub_num']."'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $block = get_block($_SESSION['user_id']);
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            $msg_array = get_condition($_SESSION['user_id'],$_POST['sub_num'], $row['t_no'], $block);

            
            $msg_index = array_search('과목 중복', $msg_array); // 장바구니 아닐땐 과목 중복 필요 없음
            if ($msg_index !== false){
                array_splice($msg_array, $msg_index, 1);
            }
            

            $content = array($row['t_no'], $block_dic[$row['t_time']], $row['t_max'], 
            join(' ', $msg_array),null);

            $content[4] = get_radio($msg_array, $row['t_no']);
                        
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
    <input id="submit_input" name="submit_input"  type="submit" value='수강 신청'>
    <input id="submit_input" name="submit_input"  type="submit" value='신청 취소'>
</form>

</div>

<?php 
    require('../view/enroll_bottom.php');
?>