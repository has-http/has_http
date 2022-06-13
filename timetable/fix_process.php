<?php
require_once('../lib/utill.php');
require_once('../lib/member_func.php');
verify_id();

$conn = mysql_connect();
if (!isset($_POST['subj'])){
    echo "<script>alert('잘못된 접근입니다.');window.location = 'make_timetable.php';</script>";
}
$arr = $_POST['subj'];
$cno_arr = get_demand_cno();
$length = count($cno_arr);
$s_id = $_SESSION['user_id'];
for($i=0;$i<$length;$i++){
    $t_no = $arr[$i];
    $t_no = mysqli_real_escape_string($conn, $t_no);
    $c_no = $cno_arr[$i];
    if ($t_no == '0'){
        $sql = "UPDATE fix_subj SET t_no = null WHERE s_id = '{$s_id}' AND c_no = {$c_no}";
        query_conn($conn, $sql);
        continue;
    }
    

    $sql = "UPDATE fix_subj SET t_no = {$t_no} WHERE s_id = '{$s_id}' AND c_no = {$c_no}";
    query_conn($conn, $sql);
    
}
echo "<script>alert('고정되었습니다.');window.location = 'make_timetable.php';</script>";
?>