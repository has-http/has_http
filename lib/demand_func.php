<?php
function get_teach_dict(){ 
    /*확률 계산 시 쿼리 중복을 피하기 위한 teach_dict 생성
    teach_dict[$c_no][$t_no] = (t_dem, t_max)
    */
    require_once('utill.php');
    $result = custom_query("SELECT c_no, t_no, t_dem, t_max FROM teach");
    $teach_dict = array();
    while ($row = mysqli_fetch_row($result)){
        $c_no = $row[0];
        $t_no = $row[1];
        $t_dem = $row[2];
        $t_max = $row[3];

        if (!isset($teach_dict[$c_no])){
            $teach_dict[$c_no] = array();
        }
        $teach_dict[$c_no][$t_no] = array($t_dem, $t_max);
    }
    return $teach_dict;
}

function get_probality($teach_dict, $demand_arr){
    require_once('utill.php');
    $proballity = 1;
    foreach ($demand_arr as $c_no => $t_no){
        $temp = $teach_dict[$c_no][$t_no];
        $t_dem = $temp[0];
        $t_max = $temp[1];
        if ($t_max < $t_dem){
            $proballity *= $t_max / $t_dem;
        }
    }
    echo $proballity;
}
?>