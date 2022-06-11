<?php
function get_demand_cno(){ // 수요조사에 응답한 c_no 반환
    require_once('utill.php');
    $s_id = $_COOKIE['id'];
    $result = custom_query("SELECT c_no FROM demand WHERE s_id='{$s_id}'");
    $demand_array = array();
    while ($row = mysqli_fetch_row($result)){
        array_push($demand_array, $row[0]);
    }

    return $demand_array;
}
?>