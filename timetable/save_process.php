<?php
require_once('../lib/enroll_func.php');
require_once('../lib/member_func.php');
verify_id();
$sub_array = get_demand_cno();
$list = get_all_case_server($sub_array);
try{
$index = $_POST['index'];
$target = $list[$index];
}
catch(Exception $e){
    echo "<script>alert('indexing error'); window.location = 'make_timetable.php';</script>";
}


$id = $_SESSION['user_id'];
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

foreach($ct_array as $c_no => $t_no){
    $sql = "UPDATE demand SET t_no={$t_no} WHERE s_id='{$id}' AND c_no={$c_no}";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}


echo "<script>alert('성공적으로 저장하였습니다.');";


echo "window.location = 'make_timetable.php';</script>";

?>