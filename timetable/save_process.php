<?php
require_once('../lib/enroll_func.php');
$sub_array = array(3001, 3004, 3007, 3019, 3021, 3026, 3027, 3023, 3036);
$list = get_all_case($sub_array, 'server');
$target = $list[$_POST['index']];

if (!isset($_COOKIE['id'])) {
    echo "<script>alert('로그인 해주세요');";
    echo "window.location.href = make_timetable.php;</script>";
}

$id = $_COOKIE['id'];
$ct_array = array();
for ($i=0; $i<7; $i++){
    for ($j=0; $j<5; $j++){
        $temp = $target[$i][$j];
        if (isset($temp)){
            $ct_array[$temp[0]] = $temp[1];
        }
    }
}

require_once('../lib/utill.php');
$conn = mysql_connect();
$flag = true;
foreach($ct_array as $c_no => $t_no){
    $sql = "SELECT EXISTS (SELECT * FROM demand WHERE s_id='{$id}' AND c_no={$c_no});";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_row($result);

    if ($row[0] == 0) {
        $flag = false;
        break;
    } 
}
if ($flag){
    foreach($ct_array as $c_no => $t_no){
        $sql = "UPDATE demand SET t_no={$t_no} WHERE s_id='{$id}' AND c_no={$c_no}";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    echo "<script>alert('성공적으로 저장하였습니다.');";
}
else{
    echo "<script>alert('먼저 과목 추가를 해주세요');";
}
echo "window.location = 'make_timetable.php';</script>";

?>